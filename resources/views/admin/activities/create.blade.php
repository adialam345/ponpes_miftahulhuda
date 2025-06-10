@extends('layouts.admin')

@section('title', 'Tambah Kegiatan Baru')

@push('styles')
<style>
    .drag-drop-area {
        transition: all 0.3s ease;
        border: 2px dashed #d1d5db;
    }

    .drag-drop-area.dragover {
        border-color: #10b981;
        background-color: #f0fdf4;
    }

    .image-preview-item {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .image-preview-item:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .remove-image-btn {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 1.5rem;
        height: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-preview-item:hover .remove-image-btn {
        opacity: 1;
    }

    .form-section {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .section-header {
        background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .input-icon {
        position: absolute;
        left: 0.75rem;
        top: 2.25rem;
        color: #6b7280;
        z-index: 10;
    }

    .input-with-icon {
        padding-left: 2.5rem;
    }

    .file-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-upload-area:hover {
        border-color: #10b981;
        background-color: #f9fafb;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let selectedFiles = [];
    let thumbnailFile = null;

    // Fungsi untuk menangani perubahan file thumbnail
    function handleThumbnailChange(input) {
        const preview = document.getElementById('thumbnailPreview');
        const fileName = document.getElementById('thumbnail-file-name');

        if (!input.files || input.files.length === 0) {
            fileName.textContent = 'Tidak ada file yang dipilih';
            preview.innerHTML = '';
            thumbnailFile = null;
            return;
        }

        const file = input.files[0];
        thumbnailFile = file;

        // Validasi ukuran file (10MB)
        if (file.size > 10 * 1024 * 1024) {
            showAlert('error', 'Ukuran file terlalu besar. Maksimal 10MB.');
            input.value = '';
            fileName.textContent = 'Tidak ada file yang dipilih';
            preview.innerHTML = '';
            return;
        }

        // Validasi tipe file
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            showAlert('error', 'Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
            input.value = '';
            fileName.textContent = 'Tidak ada file yang dipilih';
            preview.innerHTML = '';
            return;
        }

        fileName.innerHTML = `
            <div class="flex items-center text-emerald-600">
                <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                ${file.name}
            </div>
        `;

        // Preview thumbnail
        preview.innerHTML = '';
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="relative inline-block">
                    <img src="${e.target.result}" class="h-32 w-auto object-cover rounded-lg shadow-md">
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 rounded-b-lg">
                        ${file.name}
                    </div>
                </div>
            `;
        };
        reader.readAsDataURL(file);

        showAlert('success', 'Thumbnail berhasil dipilih');
        lucide.createIcons();
    }

    // Fungsi untuk menangani perubahan multiple files
    function handleImagesChange(input) {
        const files = Array.from(input.files);

        if (files.length === 0) {
            updateImagesDisplay();
            return;
        }

        // Validasi setiap file
        const validFiles = [];
        for (const file of files) {
            // Validasi ukuran file (10MB)
            if (file.size > 10 * 1024 * 1024) {
                showAlert('error', `File ${file.name} terlalu besar. Maksimal 10MB.`);
                continue;
            }

            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                showAlert('error', `Format file ${file.name} tidak didukung.`);
                continue;
            }

            validFiles.push(file);
        }

        // Tambahkan file valid ke array
        selectedFiles = [...selectedFiles, ...validFiles];

        // Batasi maksimal 20 file
        if (selectedFiles.length > 20) {
            selectedFiles = selectedFiles.slice(0, 20);
            showAlert('warning', 'Maksimal 20 foto dapat diunggah.');
        }

        updateImagesDisplay();

        if (validFiles.length > 0) {
            showAlert('success', `${validFiles.length} foto berhasil ditambahkan`);
        }
    }

    // Fungsi untuk memperbarui tampilan gambar
    function updateImagesDisplay() {
        const container = document.getElementById('image-preview-container');
        const counter = document.getElementById('images-counter');

        if (selectedFiles.length === 0) {
            counter.textContent = 'Tidak ada file yang dipilih';
            container.innerHTML = '';
            return;
        }

        counter.innerHTML = `
            <div class="flex items-center text-emerald-600">
                <i data-lucide="images" class="w-4 h-4 mr-2"></i>
                ${selectedFiles.length} foto dipilih
            </div>
        `;

        container.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'image-preview-item fade-in';
                div.innerHTML = `
                    <img src="${e.target.result}" class="h-24 w-full object-cover">
                    <button type="button" class="remove-image-btn" onclick="removeImage(${index})">
                        <i data-lucide="x" class="w-3 h-3"></i>
                    </button>
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 truncate">
                        ${file.name}
                    </div>
                `;
                container.appendChild(div);
                lucide.createIcons();
            };
            reader.readAsDataURL(file);
        });
    }

    // Fungsi untuk menghapus gambar
    function removeImage(index) {
        selectedFiles.splice(index, 1);
        updateImagesDisplay();
        updateFileInput();
        showAlert('info', 'Foto berhasil dihapus');
    }

    // Fungsi untuk memperbarui input file
    function updateFileInput() {
        const input = document.getElementById('images');
        const dt = new DataTransfer();

        selectedFiles.forEach(file => {
            dt.items.add(file);
        });

        input.files = dt.files;
    }

    // Drag and drop functionality
    function setupDragAndDrop() {
        const dropAreas = document.querySelectorAll('.drag-drop-area');

        dropAreas.forEach(area => {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                area.addEventListener(eventName, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                area.addEventListener(eventName, () => area.classList.add('dragover'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                area.addEventListener(eventName, () => area.classList.remove('dragover'), false);
            });

            area.addEventListener('drop', handleDrop, false);
        });
    }

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (e.target.closest('#thumbnail-drop-area')) {
            document.getElementById('thumbnail').files = files;
            handleThumbnailChange(document.getElementById('thumbnail'));
        } else if (e.target.closest('#images-drop-area')) {
            const input = document.getElementById('images');
            input.files = files;
            handleImagesChange(input);
        }
    }

    // Form validation
    function validateForm() {
        const title = document.getElementById('title').value.trim();
        const thumbnail = document.getElementById('thumbnail').files[0];

        if (!title) {
            showAlert('error', 'Judul kegiatan harus diisi');
            return false;
        }

        if (!thumbnail) {
            showAlert('error', 'Thumbnail harus dipilih');
            return false;
        }

        return true;
    }

    // Alert function
    function showAlert(type, message) {
        const icons = {
            success: 'success',
            error: 'error',
            warning: 'warning',
            info: 'info'
        };

        Swal.fire({
            icon: icons[type],
            title: type === 'success' ? 'Berhasil!' : type === 'error' ? 'Error!' : 'Informasi',
            text: message,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
        setupDragAndDrop();

        // Event listeners
        document.getElementById('thumbnail').addEventListener('change', function() {
            handleThumbnailChange(this);
        });

        document.getElementById('images').addEventListener('change', function() {
            handleImagesChange(this);
        });

        // Form submit validation
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            } else {
                // Show loading
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Sedang menyimpan kegiatan baru',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });

        // Auto-generate alt text from title
        document.getElementById('title').addEventListener('input', function() {
            const altText = document.getElementById('alt_text');
            if (!altText.value) {
                altText.value = this.value;
            }
        });
    });
</script>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                            <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
                        </div>
                        Tambah Kegiatan Baru
                    </h1>
                    <p class="text-slate-600 mt-1">Buat kegiatan baru dan tambahkan foto-fotonya</p>
                </div>
                <a href="{{ route('admin.activities.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information Section -->
            <div class="form-section fade-in">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="info" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Informasi Dasar
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Masukkan detail kegiatan</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="input-group md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="type" class="w-4 h-4 inline mr-1"></i>
                                Judul Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('title') border-red-500 @enderror"
                                   value="{{ old('title') }}"
                                   placeholder="Masukkan judul kegiatan"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Activity Date -->
                        <div class="input-group">
                            <label for="activity_date" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="calendar" class="w-4 h-4 inline mr-1"></i>
                                Tanggal Kegiatan
                            </label>
                            <input type="date"
                                   name="activity_date"
                                   id="activity_date"
                                   class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('activity_date') border-red-500 @enderror"
                                   value="{{ old('activity_date') }}">
                            @error('activity_date')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Alt Text -->
                        <div class="input-group">
                            <label for="alt_text" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="accessibility" class="w-4 h-4 inline mr-1"></i>
                                Teks Alternatif
                            </label>
                            <input type="text"
                                   name="alt_text"
                                   id="alt_text"
                                   class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('alt_text') border-red-500 @enderror"
                                   value="{{ old('alt_text') }}"
                                   placeholder="Deskripsi singkat untuk aksesibilitas">
                            <p class="mt-1 text-xs text-slate-500">Akan otomatis terisi dari judul jika kosong</p>
                            @error('alt_text')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="input-group md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="file-text" class="w-4 h-4 inline mr-1"></i>
                                Deskripsi
                            </label>
                            <textarea name="description"
                                      id="description"
                                      rows="4"
                                      class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('description') border-red-500 @enderror"
                                      placeholder="Masukkan deskripsi kegiatan (opsional)">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Section -->
            <div class="form-section fade-in" style="animation-delay: 0.1s;">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="image" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Thumbnail Kegiatan
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Upload gambar utama untuk kegiatan</p>
                </div>
                <div class="p-6">
                    <div class="file-upload-area drag-drop-area" id="thumbnail-drop-area">
                        <div class="text-center">
                            <i data-lucide="upload-cloud" class="w-12 h-12 text-slate-400 mx-auto mb-4"></i>
                            <div class="flex flex-col items-center gap-3">
                                <label for="thumbnail" class="relative cursor-pointer bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                                    <span>Pilih Thumbnail</span>
                                    <input type="file"
                                           accept="image/jpeg,image/png,image/gif"
                                           class="sr-only"
                                           id="thumbnail"
                                           name="thumbnail"
                                           required>
                                </label>
                                <p class="text-sm text-slate-600">atau drag & drop file di sini</p>
                            </div>
                            <p class="text-xs text-slate-500 mt-2">Format: JPG, PNG, GIF. Maksimal: 10MB</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div id="thumbnail-file-name" class="text-sm text-slate-600">Tidak ada file yang dipilih</div>
                        <div id="thumbnailPreview" class="mt-3"></div>
                    </div>

                    @error('thumbnail')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Images Section -->
            <div class="form-section fade-in" style="animation-delay: 0.2s;">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="images" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Foto-foto Kegiatan
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Upload beberapa foto kegiatan (opsional)</p>
                </div>
                <div class="p-6">
                    <div class="file-upload-area drag-drop-area" id="images-drop-area">
                        <div class="text-center">
                            <i data-lucide="images" class="w-12 h-12 text-slate-400 mx-auto mb-4"></i>
                            <div class="flex flex-col items-center gap-3">
                                <label for="images" class="relative cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <span>Pilih Foto-foto</span>
                                    <input type="file"
                                           accept="image/jpeg,image/png,image/gif"
                                           class="sr-only"
                                           id="images"
                                           name="images[]"
                                           multiple>
                                </label>
                                <p class="text-sm text-slate-600">atau drag & drop file di sini</p>
                            </div>
                            <p class="text-xs text-slate-500 mt-2">Format: JPG, PNG, GIF. Maksimal: 10MB per foto, 20 foto total</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div id="images-counter" class="text-sm text-slate-600">Tidak ada file yang dipilih</div>
                        <div id="image-preview-container" class="preview-grid mt-3"></div>
                    </div>

                    @error('images.*')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Settings Section -->
            <div class="form-section fade-in" style="animation-delay: 0.3s;">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="settings" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Pengaturan
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Atur status dan visibilitas kegiatan</p>
                </div>
                <div class="p-6">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_active"
                                   name="is_active"
                                   type="checkbox"
                                   class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-slate-300 rounded"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   value="1">
                        </div>
                        <div class="ml-3">
                            <label for="is_active" class="text-sm font-medium text-slate-700 flex items-center">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                Aktifkan Kegiatan
                            </label>
                            <p class="text-sm text-slate-500">Kegiatan akan ditampilkan di website jika diaktifkan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 fade-in" style="animation-delay: 0.4s;">
                <a href="{{ route('admin.activities.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                    <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-emerald-600 to-blue-600 hover:from-emerald-700 hover:to-blue-700 hover:shadow-lg transition-all duration-200">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
