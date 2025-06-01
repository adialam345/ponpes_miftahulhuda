@extends('layouts.admin')

@section('title', 'Detail Kegiatan')

@push('styles')
<style>
    .gallery-item {
        position: relative;
        transition: all 0.3s ease;
        cursor: grab;
    }

    .gallery-item:active {
        cursor: grabbing;
    }

    .gallery-item.sortable-ghost {
        opacity: 0.5;
        transform: scale(0.95);
    }

    .gallery-item.sortable-chosen {
        transform: scale(1.05);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .gallery-overlay {
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
        border-radius: 0.5rem;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .drag-handle {
        position: absolute;
        top: 0.5rem;
        left: 0.5rem;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.25rem;
        border-radius: 0.25rem;
        cursor: grab;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .drag-handle {
        opacity: 1;
    }

    .info-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .section-header {
        background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .thumbnail-container {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .thumbnail-container:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .upload-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: rgba(16, 185, 129, 0.2);
        overflow: hidden;
    }

    .upload-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #059669);
        transition: width 0.3s ease;
        width: 0%;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .empty-gallery {
        background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
        border-radius: 1rem;
        padding: 3rem 2rem;
        text-align: center;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: white;
        border-radius: 1rem;
        max-width: 90vw;
        max-height: 90vh;
        overflow: auto;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal-content {
        transform: scale(1);
    }

    .upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .upload-area:hover,
    .upload-area.dragover {
        border-color: #10b981;
        background-color: #f0fdf4;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .preview-item {
        position: relative;
        aspect-ratio: 1;
        border-radius: 0.5rem;
        overflow: hidden;
        background: #f3f4f6;
    }

    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .remove-preview {
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
        font-size: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    let selectedFiles = [];
    let uploadProgress = {};

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
        initSortable();
        setupFileUpload();

        // Show success message if exists
        @if(session('success'))
            showAlert('success', "{{ session('success') }}");
        @endif

        @if(session('error'))
            showAlert('error', "{{ session('error') }}");
        @endif
    });

    // Initialize sortable gallery
    function initSortable() {
        const gallery = document.getElementById('sortable-gallery');
        if (gallery) {
            new Sortable(gallery, {
                handle: '.drag-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                onEnd: function(evt) {
                    updateGalleryOrder();
                }
            });
        }
    }

    // Setup file upload
    function setupFileUpload() {
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('file-input');

        // Drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => uploadArea.classList.add('dragover'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => uploadArea.classList.remove('dragover'), false);
        });

        uploadArea.addEventListener('drop', handleDrop, false);
        uploadArea.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', handleFileSelect);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        function handleFileSelect(e) {
            const files = e.target.files;
            handleFiles(files);
        }

        function handleFiles(files) {
            const validFiles = [];

            for (let file of files) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    showAlert('error', `File ${file.name} bukan gambar yang valid`);
                    continue;
                }

                // Validate file size (10MB)
                if (file.size > 10 * 1024 * 1024) {
                    showAlert('error', `File ${file.name} terlalu besar. Maksimal 10MB`);
                    continue;
                }

                validFiles.push(file);
            }

            if (validFiles.length > 0) {
                selectedFiles = [...selectedFiles, ...validFiles];
                updatePreview();

                if (selectedFiles.length > 20) {
                    selectedFiles = selectedFiles.slice(0, 20);
                    showAlert('warning', 'Maksimal 20 foto dapat diunggah sekaligus');
                }
            }
        }
    }

    // Update preview
    function updatePreview() {
        const container = document.getElementById('preview-container');
        const counter = document.getElementById('file-counter');

        container.innerHTML = '';
        counter.textContent = `${selectedFiles.length} foto dipilih`;

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="remove-preview" onclick="removeFile(${index})">
                        <i data-lucide="x" class="w-3 h-3"></i>
                    </button>
                    <div class="upload-progress" id="progress-${index}">
                        <div class="upload-progress-bar"></div>
                    </div>
                `;
                container.appendChild(div);
                lucide.createIcons();
            };
            reader.readAsDataURL(file);
        });
    }

    // Remove file from selection
    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updatePreview();
    }

    // Upload files
    async function uploadFiles() {
        if (selectedFiles.length === 0) {
            showAlert('error', 'Pilih foto terlebih dahulu');
            return;
        }

        const formData = new FormData();
        selectedFiles.forEach((file, index) => {
            formData.append('images[]', file);
        });
        formData.append('_token', '{{ csrf_token() }}');

        try {
            // Show loading
            Swal.fire({
                title: 'Mengunggah...',
                text: `Sedang mengunggah ${selectedFiles.length} foto`,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const response = await fetch('{{ route("admin.activities.add-images", $activity->id) }}', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            Swal.close();

            if (response.ok && data.success) {
                showAlert('success', `${data.uploaded_count} foto berhasil diunggah`);
                closeModal('addPhotosModal');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showAlert('error', data.message || 'Gagal mengunggah foto');
            }
        } catch (error) {
            Swal.close();
            showAlert('error', 'Terjadi kesalahan saat mengunggah foto');
            console.error('Upload error:', error);
        }
    }

    // Update gallery order
    function updateGalleryOrder() {
        const items = document.querySelectorAll('.gallery-item');
        const orderData = [];

        items.forEach((item, index) => {
            orderData.push({
                id: item.getAttribute('data-id'),
                order: index + 1
            });
        });

        // Show loading
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang menyimpan urutan foto',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('{{ route("admin.galleries.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ items: orderData })
        })
        .then(response => response.json())
        .then(data => {
            Swal.close();
            if (data.success) {
                // Update order display
                items.forEach((item, index) => {
                    const orderElement = item.querySelector('.order-number');
                    if (orderElement) {
                        orderElement.textContent = index + 1;
                    }
                });

                showAlert('success', 'Urutan foto berhasil diperbarui');
            } else {
                showAlert('error', 'Gagal memperbarui urutan foto');
            }
        })
        .catch(error => {
            Swal.close();
            showAlert('error', 'Terjadi kesalahan saat memperbarui urutan');
            console.error('Error:', error);
        });
    }

    // View image in modal
    function viewImage(src, title, description) {
        Swal.fire({
            html: `
                <div class="text-center">
                    <img src="${src}" alt="${title}" class="max-h-[70vh] max-w-full mx-auto rounded-lg">
                    ${title ? `<h3 class="text-lg font-semibold mt-4">${title}</h3>` : ''}
                    ${description ? `<p class="text-slate-600 mt-2">${description}</p>` : ''}
                </div>
            `,
            showConfirmButton: false,
            width: 'auto',
            padding: '1rem',
            background: '#ffffff',
            showCloseButton: true
        });
    }

    // Delete image
    function deleteImage(id, title) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `Apakah Anda yakin ingin menghapus foto <strong>"${title}"</strong>?<br><br>Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Sedang menghapus foto',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit delete form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/galleries') }}/${id}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Modal functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('active');
        document.body.style.overflow = '';

        // Reset form if it's upload modal
        if (modalId === 'addPhotosModal') {
            selectedFiles = [];
            updatePreview();
        }
    }

    // Show alert
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
</script>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-slate-900 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                            <i data-lucide="eye" class="w-5 h-5 text-white"></i>
                        </div>
                        Detail Kegiatan
                    </h1>
                    <p class="text-slate-600 mt-1">Kelola informasi dan galeri foto kegiatan</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.activities.edit', $activity->id) }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg shadow-sm hover:from-blue-700 hover:to-purple-700 hover:shadow-md transition-all duration-200">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                        Edit Kegiatan
                    </a>
                    <a href="{{ route('admin.activities.index') }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Activity Information -->
        <div class="info-card fade-in">
            <div class="section-header">
                <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                    <i data-lucide="info" class="w-5 h-5 mr-2 text-emerald-600"></i>
                    Informasi Kegiatan
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Information Column -->
                    <div class="lg:col-span-2">
                        <dl class="space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <dt class="text-sm font-medium text-slate-500 w-32 flex items-center">
                                    <i data-lucide="type" class="w-4 h-4 mr-2"></i>
                                    Judul
                                </dt>
                                <dd class="text-sm text-slate-900 font-medium mt-1 sm:mt-0">{{ $activity->title }}</dd>
                            </div>

                            @if($activity->description)
                            <div class="flex flex-col sm:flex-row">
                                <dt class="text-sm font-medium text-slate-500 w-32 flex items-center">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    Deskripsi
                                </dt>
                                <dd class="text-sm text-slate-900 mt-1 sm:mt-0">{!! nl2br(e($activity->description)) !!}</dd>
                            </div>
                            @endif

                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <dt class="text-sm font-medium text-slate-500 w-32 flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                    Tanggal
                                </dt>
                                <dd class="text-sm text-slate-900 mt-1 sm:mt-0">
                                    {{ $activity->activity_date ? $activity->activity_date->format('d F Y') : 'Tidak ada tanggal' }}
                                </dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <dt class="text-sm font-medium text-slate-500 w-32 flex items-center">
                                    <i data-lucide="toggle-left" class="w-4 h-4 mr-2"></i>
                                    Status
                                </dt>
                                <dd class="mt-1 sm:mt-0">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $activity->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                        <i data-lucide="{{ $activity->is_active ? 'check-circle' : 'x-circle' }}" class="w-3 h-3 mr-1"></i>
                                        {{ $activity->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <dt class="text-sm font-medium text-slate-500 w-32 flex items-center">
                                    <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                                    Dibuat
                                </dt>
                                <dd class="text-sm text-slate-900 mt-1 sm:mt-0">{{ $activity->created_at->format('d F Y, H:i') }}</dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <dt class="text-sm font-medium text-slate-500 w-32 flex items-center">
                                    <i data-lucide="refresh-cw" class="w-4 h-4 mr-2"></i>
                                    Diperbarui
                                </dt>
                                <dd class="text-sm text-slate-900 mt-1 sm:mt-0">{{ $activity->updated_at->format('d F Y, H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Thumbnail Column -->
                    <div class="lg:col-span-1">
                        <h4 class="text-sm font-medium text-slate-700 mb-3 flex items-center">
                            <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                            Thumbnail
                        </h4>
                        @if($activity->thumbnail)
                            <div class="thumbnail-container cursor-pointer" onclick="viewImage('{{ asset('storage/'.$activity->thumbnail) }}', '{{ $activity->title }}', '{{ $activity->alt_text }}')">
                                <img src="{{ asset('storage/'.$activity->thumbnail) }}"
                                     alt="{{ $activity->alt_text }}"
                                     class="w-full h-auto rounded-lg">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300 rounded-lg">
                                    <i data-lucide="zoom-in" class="w-6 h-6 text-white"></i>
                                </div>
                            </div>
                            @if($activity->alt_text)
                                <p class="mt-2 text-xs text-slate-500">{{ $activity->alt_text }}</p>
                            @endif
                        @else
                            <div class="border-2 border-dashed border-slate-300 rounded-lg p-8 text-center text-slate-400">
                                <i data-lucide="image-off" class="w-12 h-12 mx-auto mb-2"></i>
                                <p class="text-sm">Tidak ada thumbnail</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <div class="info-card fade-in" style="animation-delay: 0.1s;">
            <div class="section-header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="images" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Galeri Foto
                        <span class="ml-2 bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full text-xs font-medium">
                            {{ $activity->galleries->count() }} foto
                        </span>
                    </h3>
                    <button
                        onclick="openModal('addPhotosModal')"
                        class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-emerald-600 to-blue-600 text-white font-medium rounded-lg shadow-sm hover:from-emerald-700 hover:to-blue-700 transition-all duration-200"
                    >
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Tambah Foto
                    </button>
                </div>
            </div>
            <div class="p-6">
                @if($activity->galleries->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4" id="sortable-gallery">
                        @foreach($activity->galleries->sortBy('order') as $gallery)
                            <div class="gallery-item" data-id="{{ $gallery->id }}">
                                <div class="relative aspect-square bg-slate-200 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/'.$gallery->image) }}"
                                         alt="{{ $gallery->alt_text }}"
                                         class="w-full h-full object-cover">

                                    <!-- Drag Handle -->
                                    <div class="drag-handle">
                                        <i data-lucide="grip-vertical" class="w-3 h-3"></i>
                                    </div>

                                    <!-- Order Number -->
                                    <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white text-xs px-1.5 py-0.5 rounded">
                                        <span class="order-number">{{ $gallery->order }}</span>
                                    </div>

                                    <!-- Overlay -->
                                    <div class="gallery-overlay">
                                        <div class="flex space-x-2">
                                            <button
                                                onclick="viewImage('{{ asset('storage/'.$gallery->image) }}', '{{ $gallery->title }}', '{{ $gallery->description }}')"
                                                class="p-2 bg-white rounded-full text-slate-700 hover:text-blue-600 transition-colors duration-200"
                                            >
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </button>
                                            <button
                                                onclick="deleteImage('{{ $gallery->id }}', '{{ $gallery->title ?: 'Foto' }}')"
                                                class="p-2 bg-white rounded-full text-slate-700 hover:text-red-600 transition-colors duration-200"
                                            >
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @if($gallery->title)
                                    <div class="mt-2 text-sm text-slate-700 truncate">{{ $gallery->title }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <i data-lucide="info" class="w-5 h-5 text-blue-600 mr-2 mt-0.5"></i>
                            <div class="text-sm text-blue-800">
                                <p class="font-medium">Tips Mengelola Galeri:</p>
                                <ul class="mt-1 list-disc list-inside space-y-1">
                                    <li>Drag dan drop foto untuk mengatur urutan</li>
                                    <li>Klik ikon mata untuk melihat foto dalam ukuran penuh</li>
                                    <li>Klik ikon sampah untuk menghapus foto</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-gallery">
                        <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="images" class="w-8 h-8 text-slate-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900 mb-1">Belum Ada Foto</h3>
                        <p class="text-slate-500 mb-4">Belum ada foto di galeri kegiatan ini.</p>
                        <button
                            onclick="openModal('addPhotosModal')"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-blue-600 text-white font-medium rounded-lg shadow-sm hover:from-emerald-700 hover:to-blue-700 transition-all duration-200"
                        >
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                            Tambah Foto Pertama
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Add Photos Modal -->
<div id="addPhotosModal" class="modal-overlay" onclick="if(event.target === this) closeModal('addPhotosModal')">
    <div class="modal-content w-full max-w-4xl mx-4">
        <div class="p-6 border-b border-slate-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                    <i data-lucide="upload" class="w-5 h-5 mr-2 text-emerald-600"></i>
                    Tambah Foto ke Galeri
                </h3>
                <button onclick="closeModal('addPhotosModal')" class="text-slate-400 hover:text-slate-600 transition-colors duration-200">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Upload Area -->
            <div id="upload-area" class="upload-area">
                <div class="text-center">
                    <i data-lucide="upload-cloud" class="w-12 h-12 text-slate-400 mx-auto mb-4"></i>
                    <div class="text-lg font-medium text-slate-900 mb-2">
                        Drag & drop foto di sini atau klik untuk memilih
                    </div>
                    <p class="text-sm text-slate-500">
                        Format: JPG, PNG, GIF. Maksimal: 10MB per foto, 20 foto sekaligus
                    </p>
                </div>
                <input type="file" id="file-input" multiple accept="image/*" class="hidden">
            </div>

            <!-- File Counter -->
            <div class="mt-4 text-sm text-slate-600">
                <span id="file-counter">0 foto dipilih</span>
            </div>

            <!-- Preview Container -->
            <div id="preview-container" class="preview-grid"></div>
        </div>

        <div class="p-6 border-t border-slate-200 flex justify-end space-x-3">
            <button
                onclick="closeModal('addPhotosModal')"
                class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors duration-200"
            >
                Batal
            </button>
            <button
                onclick="uploadFiles()"
                class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-blue-600 text-white rounded-lg hover:from-emerald-700 hover:to-blue-700 transition-all duration-200"
            >
                Upload Foto
            </button>
        </div>
    </div>
</div>
@endsection
