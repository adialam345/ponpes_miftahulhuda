@extends('layouts.admin')

@section('title', 'Edit Kegiatan')

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
        background: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .image-preview-item:hover {
        transform: scale(1.02);
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
        z-index: 10;
    }

    .image-preview-item:hover .remove-image-btn {
        opacity: 1;
    }

    .existing-image-item {
        position: relative;
        background: white;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .existing-image-item:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .existing-image-item.marked-for-deletion {
        opacity: 0.5;
        transform: scale(0.95);
    }

    .existing-image-item.marked-for-deletion::after {
        content: 'Akan Dihapus';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(239, 68, 68, 0.9);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 600;
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

    .current-thumbnail {
        position: relative;
        display: inline-block;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .thumbnail-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .current-thumbnail:hover .thumbnail-overlay {
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let selectedFiles = [];
    let thumbnailFile = null;
    let imagesToDelete = [];

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
                <div class="relative inline-block mt-3">
                    <img src="${e.target.result}" class="h-32 w-auto object-cover rounded-lg shadow-md">
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 rounded-b-lg">
                        Thumbnail Baru: ${file.name}
                    </div>
                </div>
            `;
        };
        reader.readAsDataURL(file);

        showAlert('success', 'Thumbnail baru berhasil dipilih');
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
            showAlert('success', `${validFiles.length} foto baru berhasil ditambahkan`);
        }
    }

    // Fungsi untuk memperbarui tampilan gambar baru
    function updateImagesDisplay() {
        const container = document.getElementById('new-image-preview-container');
        const counter = document.getElementById('new-images-counter');

        if (selectedFiles.length === 0) {
            counter.textContent = 'Tidak ada file baru yang dipilih';
            container.innerHTML = '';
            return;
        }

        counter.innerHTML = `
            <div class="flex items-center text-emerald-600">
                <i data-lucide="images" class="w-4 h-4 mr-2"></i>
                ${selectedFiles.length} foto baru dipilih
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
                    <button type="button" class="remove-image-btn" onclick="removeNewImage(${index})">
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

    // Fungsi untuk menghapus gambar baru
    function removeNewImage(index) {
        selectedFiles.splice(index, 1);
        updateImagesDisplay();
        updateFileInput();
        showAlert('info', 'Foto baru berhasil dihapus');
    }

    // Fungsi untuk menandai gambar existing untuk dihapus
    function toggleDeleteExistingImage(imageId) {
        const imageElement = document.getElementById(`existing-image-${imageId}`);
        const index = imagesToDelete.indexOf(imageId);

        if (index > -1) {
            // Remove from delete list
            imagesToDelete.splice(index, 1);
            imageElement.classList.remove('marked-for-deletion');
            showAlert('info', 'Foto dibatalkan untuk dihapus');
        } else {
            // Add to delete list
            imagesToDelete.push(imageId);
            imageElement.classList.add('marked-for-deletion');
            showAlert('warning', 'Foto ditandai untuk dihapus');
        }

        updateDeleteInput();
    }

    // Fungsi untuk memperbarui input hidden untuk gambar yang akan dihapus
    function updateDeleteInput() {
        let deleteInput = document.getElementById('images-to-delete');
        if (!deleteInput) {
            deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'images_to_delete';
            deleteInput.id = 'images-to-delete';
            document.querySelector('form').appendChild(deleteInput);
        }
        deleteInput.value = imagesToDelete.join(',');
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

        if (!title) {
            showAlert('error', 'Judul kegiatan harus diisi');
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
                    text: 'Sedang menyimpan perubahan kegiatan',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });

        // Auto-generate alt text from title if empty
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
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mr-3">
                            <i data-lucide="edit" class="w-5 h-5 text-white"></i>
                        </div>
                        Edit Kegiatan
                    </h1>
                    <p class="text-slate-600 mt-1">Perbarui informasi kegiatan "{{ $activity->title }}"</p>
                </div>
                <a href="{{ route('admin.activities.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <form action="{{ route('admin.activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <div class="form-section fade-in">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="info" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Informasi Dasar
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Perbarui detail kegiatan</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="type" class="w-4 h-4 inline mr-1"></i>
                                Judul Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('title') border-red-500 @enderror"
                                   value="{{ old('title', $activity->title) }}"
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
                        <div>
                            <label for="activity_date" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="calendar" class="w-4 h-4 inline mr-1"></i>
                                Tanggal Kegiatan
                            </label>
                            <input type="date"
                                   name="activity_date"
                                   id="activity_date"
                                   class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('activity_date') border-red-500 @enderror"
                                   value="{{ old('activity_date', $activity->activity_date ? $activity->activity_date->format('Y-m-d') : '') }}">
                            @error('activity_date')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Alt Text -->
                        <div>
                            <label for="alt_text" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="accessibility" class="w-4 h-4 inline mr-1"></i>
                                Teks Alternatif
                            </label>
                            <input type="text"
                                   name="alt_text"
                                   id="alt_text"
                                   class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('alt_text') border-red-500 @enderror"
                                   value="{{ old('alt_text', $activity->alt_text) }}"
                                   placeholder="Deskripsi singkat untuk aksesibilitas">
                            @error('alt_text')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="file-text" class="w-4 h-4 inline mr-1"></i>
                                Deskripsi
                            </label>
                            <textarea name="description"
                                      id="description"
                                      rows="4"
                                      class="block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('description') border-red-500 @enderror"
                                      placeholder="Masukkan deskripsi kegiatan (opsional)">{{ old('description', $activity->description) }}</textarea>
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

            <!-- Current Thumbnail Section -->
            <div class="form-section fade-in" style="animation-delay: 0.1s;">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="image" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Thumbnail Kegiatan
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Gambar utama untuk kegiatan</p>
                </div>
                <div class="p-6">
                    @if($activity->thumbnail)
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-slate-700 mb-3 flex items-center">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                Thumbnail Saat Ini
                            </h4>
                            <div class="current-thumbnail">
                                <img src="{{ asset('storage/' . $activity->thumbnail) }}"
                                     alt="{{ $activity->alt_text }}"
                                     class="h-48 w-auto object-cover">
                                <div class="thumbnail-overlay">
                                    <span class="text-white text-sm font-medium">Thumbnail Aktif</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="file-upload-area drag-drop-area" id="thumbnail-drop-area">
                        <div class="text-center">
                            <i data-lucide="upload-cloud" class="w-12 h-12 text-slate-400 mx-auto mb-4"></i>
                            <div class="text-sm text-slate-600 mb-2">
                                <label for="thumbnail" class="relative cursor-pointer bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                                    <span>{{ $activity->thumbnail ? 'Ganti Thumbnail' : 'Pilih Thumbnail' }}</span>
                                    <input type="file"
                                           accept="image/jpeg,image/png,image/gif"
                                           class="sr-only"
                                           id="thumbnail"
                                           name="thumbnail">
                                </label>
                                atau drag & drop file di sini
                            </div>
                            <p class="text-xs text-slate-500">Format: JPG, PNG, GIF. Maksimal: 10MB</p>
                            @if($activity->thumbnail)
                                <p class="text-xs text-amber-600 mt-1">Biarkan kosong jika tidak ingin mengubah thumbnail</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4">
                        <div id="thumbnail-file-name" class="text-sm text-slate-600">Tidak ada file yang dipilih</div>
                        <div id="thumbnailPreview"></div>
                    </div>

                    @error('thumbnail')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Existing Images Section -->
            @if($activity->images && $activity->images->count() > 0)
            <div class="form-section fade-in" style="animation-delay: 0.2s;">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="images" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Foto-foto Kegiatan Saat Ini
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Klik foto untuk menandai penghapusan</p>
                </div>
                <div class="p-6">
                    <div class="preview-grid">
                        @foreach($activity->images as $image)
                            <div class="existing-image-item"
                                 id="existing-image-{{ $image->id }}"
                                 onclick="toggleDeleteExistingImage({{ $image->id }})">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     alt="{{ $image->alt_text }}"
                                     class="h-24 w-full object-cover cursor-pointer">
                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 truncate">
                                    {{ basename($image->image_path) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-slate-500 mt-3 flex items-center">
                        <i data-lucide="info" class="w-3 h-3 mr-1"></i>
                        Klik pada foto untuk menandai/membatalkan penghapusan
                    </p>
                </div>
            </div>
            @endif

            <!-- New Images Section -->
            <div class="form-section fade-in" style="animation-delay: 0.3s;">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="plus-circle" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Tambah Foto Baru
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">Upload foto-foto baru untuk kegiatan</p>
                </div>
                <div class="p-6">
                    <div class="file-upload-area drag-drop-area" id="images-drop-area">
                        <div class="text-center">
                            <i data-lucide="images" class="w-12 h-12 text-slate-400 mx-auto mb-4"></i>
                            <div class="text-sm text-slate-600 mb-2">
                                <label for="images" class="relative cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <span>Pilih Foto-foto Baru</span>
                                    <input type="file"
                                           accept="image/jpeg,image/png,image/gif"
                                           class="sr-only"
                                           id="images"
                                           name="images[]"
                                           multiple>
                                </label>
                                atau drag & drop file di sini
                            </div>
                            <p class="text-xs text-slate-500">Format: JPG, PNG, GIF. Maksimal: 10MB per foto, 20 foto total</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div id="new-images-counter" class="text-sm text-slate-600">Tidak ada file baru yang dipilih</div>
                        <div id="new-image-preview-container" class="preview-grid mt-3"></div>
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
            <div class="form-section fade-in" style="animation-delay: 0.4s;">
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
                                   {{ old('is_active', $activity->is_active) ? 'checked' : '' }}
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
            <div class="flex justify-end space-x-3 fade-in" style="animation-delay: 0.5s;">
                <a href="{{ route('admin.activities.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                    <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 hover:shadow-lg transition-all duration-200">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
