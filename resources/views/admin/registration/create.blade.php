@extends('layouts.admin')

@section('title', 'Tambah Halaman Pendaftaran - Admin')

@push('styles')
<style>
.editor-toolbar {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 1px solid #e2e8f0;
    border-radius: 0.75rem 0.75rem 0 0;
}

.editor-btn {
    transition: all 0.2s ease;
    border-radius: 0.375rem;
}

.editor-btn:hover {
    background-color: #e2e8f0;
    transform: translateY(-1px);
}

.editor-btn.active {
    background-color: #059669;
    color: white;
}

.editor-content {
    min-height: 400px;
    max-height: 600px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    line-height: 1.6;
    border-radius: 0 0 0.75rem 0.75rem;
}

.editor-content:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.color-picker {
    display: grid;
    grid-template-columns: repeat(8, 1fr);
    gap: 0.25rem;
    padding: 0.75rem;
}

.color-btn {
    width: 2rem;
    height: 2rem;
    border-radius: 0.375rem;
    border: 2px solid transparent;
    transition: all 0.2s ease;
    cursor: pointer;
}

.color-btn:hover {
    transform: scale(1.1);
    border-color: #64748b;
}

.template-item {
    transition: all 0.2s ease;
    border-radius: 0.5rem;
}

.template-item:hover {
    background-color: #ecfdf5;
    transform: translateX(4px);
}

.form-section {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.section-header {
    background: linear-gradient(135deg, #ecfdf5 0%, #e0f2fe 100%);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.input-field {
    transition: all 0.3s ease;
}

.input-field:focus {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background: linear-gradient(90deg, #059669, #0891b2);
    color: white;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(90deg, #047857, #0e7490);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(8, 145, 178, 0.5);
}

.btn-secondary {
    background: white;
    color: #64748b;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #f8fafc;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.page-type-card {
    border: 2px solid #e5e7eb;
    border-radius: 0.75rem;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.page-type-card:hover {
    border-color: #059669;
    background: #ecfdf5;
    transform: translateY(-2px);
}

.page-type-card.selected {
    border-color: #059669;
    background: #ecfdf5;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.info-card {
    background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
    border: 1px solid #f59e0b;
    border-radius: 0.75rem;
    padding: 1rem;
}

.resizable-image {
    position: relative;
    display: inline-block;
    margin: 0.5rem;
    border: 2px dashed transparent;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.resizable-image:hover {
    border-color: #059669;
}

.resizable-image img {
    max-width: 100%;
    height: auto;
    border-radius: 0.375rem;
    cursor: move;
}

.resize-handle {
    position: absolute;
    width: 10px;
    height: 10px;
    background: #059669;
    border: 2px solid white;
    border-radius: 50%;
    cursor: nw-resize;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.resizable-image:hover .resize-handle {
    opacity: 1;
}

.resize-handle.nw { top: -5px; left: -5px; cursor: nw-resize; }
.resize-handle.ne { top: -5px; right: -5px; cursor: ne-resize; }
.resize-handle.sw { bottom: -5px; left: -5px; cursor: sw-resize; }
.resize-handle.se { bottom: -5px; right: -5px; cursor: se-resize; }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let editor, hiddenContent;

document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
    initializeEditor();
    setupPageTypeSelection();
    setupFormValidation();

    // Show success message if exists
    @if(session('success'))
        showAlert('success', "{{ session('success') }}");
    @endif

    @if(session('error'))
        showAlert('error', "{{ session('error') }}");
    @endif
});

function initializeEditor() {
    editor = document.getElementById('editor-content');
    hiddenContent = document.getElementById('hidden-content');

    if (!editor || !hiddenContent) return;

    // Initialize content
    hiddenContent.value = editor.innerHTML;

    // Update hidden field on content change
    editor.addEventListener('input', function() {
        hiddenContent.value = editor.innerHTML;
    });

    // Setup toolbar buttons
    setupToolbarButtons();
    setupColorPickers();
    setupImageUpload();
    setupKeyboardShortcuts();
}

function setupPageTypeSelection() {
    const pageTypeCards = document.querySelectorAll('.page-type-card');
    const hiddenInput = document.getElementById('page_type_hidden');

    pageTypeCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            pageTypeCards.forEach(c => c.classList.remove('selected'));

            // Add selected class to clicked card
            this.classList.add('selected');

            // Update hidden input value
            const value = this.getAttribute('data-value');
            hiddenInput.value = value;

            // Update title placeholder based on selection
            const titleInput = document.getElementById('title');
            if (value === 'pondok') {
                titleInput.placeholder = 'Contoh: Pendaftaran Santri Baru Pondok Pesantren 2024/2025';
            } else if (value === 'smp') {
                titleInput.placeholder = 'Contoh: Pendaftaran Siswa Baru SMP 2024/2025';
            }
        });
    });
}

function setupToolbarButtons() {
    // Font family
    document.getElementById('font-family')?.addEventListener('change', function() {
        document.execCommand('fontName', false, this.value);
        editor.focus();
    });

    // Font size
    document.getElementById('font-size')?.addEventListener('change', function() {
        document.execCommand('fontSize', false, this.value);
        editor.focus();
    });

    // Formatting buttons
    const formatButtons = [
        { id: 'bold-btn', command: 'bold' },
        { id: 'italic-btn', command: 'italic' },
        { id: 'underline-btn', command: 'underline' },
        { id: 'strikethrough-btn', command: 'strikeThrough' },
        { id: 'align-left-btn', command: 'justifyLeft' },
        { id: 'align-center-btn', command: 'justifyCenter' },
        { id: 'align-right-btn', command: 'justifyRight' },
        { id: 'align-justify-btn', command: 'justifyFull' },
        { id: 'list-ul-btn', command: 'insertUnorderedList' },
        { id: 'list-ol-btn', command: 'insertOrderedList' },
        { id: 'indent-btn', command: 'indent' },
        { id: 'outdent-btn', command: 'outdent' }
    ];

    formatButtons.forEach(btn => {
        const element = document.getElementById(btn.id);
        if (element) {
            element.addEventListener('click', function() {
                document.execCommand(btn.command, false, null);
                updateButtonStates();
                editor.focus();
            });
        }
    });

    // Link buttons
    document.getElementById('link-btn')?.addEventListener('click', function() {
        const url = prompt('Masukkan URL:');
        if (url) {
            document.execCommand('createLink', false, url);
            editor.focus();
        }
    });

    document.getElementById('unlink-btn')?.addEventListener('click', function() {
        document.execCommand('unlink', false, null);
        editor.focus();
    });
}

function setupColorPickers() {
    // Text color picker
    const textColorBtn = document.getElementById('text-color-btn');
    const textColorDropdown = document.getElementById('text-color-dropdown');

    if (textColorBtn && textColorDropdown) {
        textColorBtn.addEventListener('click', function() {
            textColorDropdown.classList.toggle('hidden');
            document.getElementById('bg-color-dropdown')?.classList.add('hidden');
        });

        textColorDropdown.querySelectorAll('.color-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const color = this.getAttribute('data-color');
                document.execCommand('foreColor', false, color);
                textColorDropdown.classList.add('hidden');
                editor.focus();
            });
        });
    }

    // Background color picker
    const bgColorBtn = document.getElementById('bg-color-btn');
    const bgColorDropdown = document.getElementById('bg-color-dropdown');

    if (bgColorBtn && bgColorDropdown) {
        bgColorBtn.addEventListener('click', function() {
            bgColorDropdown.classList.toggle('hidden');
            document.getElementById('text-color-dropdown')?.classList.add('hidden');
        });

        bgColorDropdown.querySelectorAll('.color-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const color = this.getAttribute('data-color');
                document.execCommand('hiliteColor', false, color);
                bgColorDropdown.classList.add('hidden');
                editor.focus();
            });
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!textColorBtn?.contains(e.target) && !textColorDropdown?.contains(e.target)) {
            textColorDropdown?.classList.add('hidden');
        }
        if (!bgColorBtn?.contains(e.target) && !bgColorDropdown?.contains(e.target)) {
            bgColorDropdown?.classList.add('hidden');
        }
    });
}

function setupImageUpload() {
    const imageUpload = document.getElementById('image-upload');

    if (imageUpload) {
        imageUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.indexOf('image') !== -1) {
                const formData = new FormData();
                formData.append('file', file);
                fetch('{{ route('admin.upload-image') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.url) {
                        const img = document.createElement('img');
                        img.src = data.url;
                        img.style.maxWidth = '100%';
                        insertImageAtCursor(img);
                    } else {
                        showAlert('error', 'Gagal upload gambar');
                    }
                })
                .catch(() => {
                    showAlert('error', 'Gagal upload gambar');
                });
            }
            e.target.value = '';
        });
    }
}

function setupKeyboardShortcuts() {
    editor.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 'b':
                    e.preventDefault();
                    document.execCommand('bold', false, null);
                    break;
                case 'i':
                    e.preventDefault();
                    document.execCommand('italic', false, null);
                    break;
                case 'u':
                    e.preventDefault();
                    document.execCommand('underline', false, null);
                    break;
            }
            updateButtonStates();
        }
    });
}

function updateButtonStates() {
    const buttons = [
        { id: 'bold-btn', command: 'bold' },
        { id: 'italic-btn', command: 'italic' },
        { id: 'underline-btn', command: 'underline' }
    ];

    buttons.forEach(btn => {
        const element = document.getElementById(btn.id);
        if (element) {
            if (document.queryCommandState(btn.command)) {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }
        }
    });
}

function setupFormValidation() {
    const form = document.querySelector('form');

    if (form) {
        form.addEventListener('submit', function(e) {
            // Update hidden content field
            if (editor && hiddenContent) {
                hiddenContent.value = editor.innerHTML;
            }

            // Validate required fields
            const pageType = document.getElementById('page_type_hidden').value;
            const title = document.getElementById('title').value.trim();
            const content = hiddenContent.value.trim();

            if (!pageType) {
                e.preventDefault();
                showAlert('error', 'Silahkan pilih tipe halaman pendaftaran');
                return;
            }

            if (!title) {
                e.preventDefault();
                showAlert('error', 'Judul halaman harus diisi');
                return;
            }

            if (!content || content === '<br>' || content === '<div><br></div>') {
                e.preventDefault();
                showAlert('error', 'Konten halaman harus diisi');
                return;
            }

            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Sedang menyimpan halaman pendaftaran',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    }
}

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

editor.addEventListener('paste', function(e) {
    const items = (e.clipboardData || e.originalEvent.clipboardData).items;
    for (let i = 0; i < items.length; i++) {
        if (items[i].type.indexOf('image') !== -1) {
            const file = items[i].getAsFile();
            const formData = new FormData();
            formData.append('file', file);

            fetch('{{ route('admin.upload-image') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    const img = document.createElement('img');
                    img.src = data.url;
                    img.style.maxWidth = '100%';
                    insertImageAtCursor(img);
                }
            });
            e.preventDefault();
        }
    }
});

function insertImageAtCursor(img) {
    // Bungkus gambar dengan span resizable
    const wrapper = document.createElement('span');
    wrapper.className = 'resizable-image';
    wrapper.contentEditable = false;

    // Tambahkan handle sudut
    ['nw', 'ne', 'sw', 'se'].forEach(pos => {
        const handle = document.createElement('span');
        handle.className = 'resize-handle ' + pos;
        wrapper.appendChild(handle);
    });

    img.style.maxWidth = '100%';
    img.style.height = 'auto';
    wrapper.appendChild(img);

    let sel = window.getSelection();
    let isInEditor = false;

    if (sel && sel.rangeCount) {
        let range = sel.getRangeAt(0);
        let currentNode = range.commonAncestorContainer;
        while (currentNode) {
            if (currentNode === editor) {
                isInEditor = true;
                break;
            }
            currentNode = currentNode.parentNode;
        }

        if (isInEditor) {
            range.deleteContents();
            range.insertNode(wrapper);
            range.setStartAfter(wrapper);
            range.collapse(true);
            sel.removeAllRanges();
            sel.addRange(range);
            initResizable(wrapper);
            return;
        }
    }
    editor.appendChild(wrapper);
    editor.scrollTop = editor.scrollHeight;
    initResizable(wrapper);
}

function initResizable(wrapper) {
    const img = wrapper.querySelector('img');
    let startX, startY, startWidth, startHeight, handle;

    wrapper.querySelectorAll('.resize-handle').forEach(h => {
        h.addEventListener('mousedown', function(e) {
            e.preventDefault();
            handle = h;
            startX = e.clientX;
            startY = e.clientY;
            startWidth = img.offsetWidth;
            startHeight = img.offsetHeight;
            document.addEventListener('mousemove', resize);
            document.addEventListener('mouseup', stopResize);
        });
    });

    function resize(e) {
        let dx = e.clientX - startX;
        let dy = e.clientY - startY;
        if (handle.classList.contains('se')) {
            img.style.width = (startWidth + dx) + 'px';
            img.style.height = (startHeight + dy) + 'px';
        } else if (handle.classList.contains('sw')) {
            img.style.width = (startWidth - dx) + 'px';
            img.style.height = (startHeight + dy) + 'px';
        } else if (handle.classList.contains('ne')) {
            img.style.width = (startWidth + dx) + 'px';
            img.style.height = (startHeight - dy) + 'px';
        } else if (handle.classList.contains('nw')) {
            img.style.width = (startWidth - dx) + 'px';
            img.style.height = (startHeight - dy) + 'px';
        }
    }

    function stopResize() {
        document.removeEventListener('mousemove', resize);
        document.removeEventListener('mouseup', stopResize);
    }
}

// Drag & Drop Image
editor.addEventListener('dragover', function(e) {
    e.preventDefault();
});
editor.addEventListener('drop', function(e) {
    e.preventDefault();
    const files = e.dataTransfer.files;
    for (let i = 0; i < files.length; i++) {
        if (files[i].type.indexOf('image') !== -1) {
            const formData = new FormData();
            formData.append('file', files[i]);
            fetch('{{ route('admin.upload-image') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    const img = document.createElement('img');
                    img.src = data.url;
                    img.style.maxWidth = '100%';
                    insertImageAtCursor(img);
                }
            });
        }
    }
});
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
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-cyan-600 rounded-xl flex items-center justify-center mr-3">
                        <i data-lucide="user-plus" class="w-5 h-5 text-white"></i>
                    </div>
                    Tambah Halaman Pendaftaran
                </h1>
                <p class="text-slate-600 mt-1">Buat halaman pendaftaran baru untuk santri atau siswa</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.registration.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.registration.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Page Type Selection -->
                <div class="form-section fade-in">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                            <i data-lucide="layers" class="w-5 h-5 mr-2 text-emerald-600"></i>
                            Tipe Halaman Pendaftaran
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="page-type-card {{ old('page_type', $type ?? '') == 'pondok' ? 'selected' : '' }}" data-value="pondok">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mr-4">
                                        <i data-lucide="home" class="w-6 h-6 text-emerald-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Pendaftaran Pondok</h4>
                                        <p class="text-sm text-slate-600">Untuk pendaftaran santri pondok pesantren</p>
                                    </div>
                                </div>
                            </div>

                            <div class="page-type-card {{ old('page_type', $type ?? '') == 'smp' ? 'selected' : '' }}" data-value="smp">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mr-4">
                                        <i data-lucide="graduation-cap" class="w-6 h-6 text-cyan-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Pendaftaran SMP</h4>
                                        <p class="text-sm text-slate-600">Untuk pendaftaran siswa SMP</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="page_type" id="page_type_hidden" value="{{ old('page_type', $type ?? '') }}" required>

                        @error('page_type')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Basic Information -->
                <div class="form-section fade-in" style="animation-delay: 0.1s;">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                            <i data-lucide="info" class="w-5 h-5 mr-2 text-emerald-600"></i>
                            Informasi Dasar
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-2">
                                <i data-lucide="type" class="w-4 h-4 inline mr-1"></i>
                                Judul Halaman
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title') }}"
                                required
                                class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                placeholder="Masukkan judul halaman pendaftaran..."
                            >
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="registration_start" class="block text-sm font-medium text-slate-700 mb-2">
                                    <i data-lucide="calendar-plus" class="w-4 h-4 inline mr-1"></i>
                                    Tanggal Mulai Pendaftaran
                                </label>
                                <input
                                    type="date"
                                    name="registration_start"
                                    id="registration_start"
                                    value="{{ old('registration_start') }}"
                                    class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                >
                                @error('registration_start')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="registration_end" class="block text-sm font-medium text-slate-700 mb-2">
                                    <i data-lucide="calendar-x" class="w-4 h-4 inline mr-1"></i>
                                    Tanggal Akhir Pendaftaran
                                </label>
                                <input
                                    type="date"
                                    name="registration_end"
                                    id="registration_end"
                                    value="{{ old('registration_end') }}"
                                    class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                >
                                @error('registration_end')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Editor -->
                <div class="form-section fade-in" style="animation-delay: 0.2s;">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                            <i data-lucide="file-text" class="w-5 h-5 mr-2 text-emerald-600"></i>
                            Konten Halaman
                            <span class="text-red-500 ml-1">*</span>
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="border border-slate-300 rounded-xl overflow-hidden shadow-sm">
                            <!-- Editor Toolbar -->
                            <div class="editor-toolbar p-3">
                                <div class="flex flex-wrap items-center gap-1">
                                    <!-- Font Controls -->
                                    <div class="flex items-center border-r border-slate-300 pr-3 mr-3">
                                        <select id="font-family" class="text-sm border border-slate-300 rounded mr-2 px-2 py-1 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                            <option value="Inter, sans-serif">Inter</option>
                                            <option value="Arial, sans-serif">Arial</option>
                                            <option value="'Times New Roman', serif">Times New Roman</option>
                                            <option value="Georgia, serif">Georgia</option>
                                            <option value="Verdana, sans-serif">Verdana</option>
                                        </select>
                                        <select id="font-size" class="text-sm border border-slate-300 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                            <option value="1">8pt</option>
                                            <option value="2">10pt</option>
                                            <option value="3" selected>12pt</option>
                                            <option value="4">14pt</option>
                                            <option value="5">18pt</option>
                                            <option value="6">24pt</option>
                                            <option value="7">36pt</option>
                                        </select>
                                    </div>

                                    <!-- Text Formatting -->
                                    <div class="flex items-center border-r border-slate-300 pr-3 mr-3">
                                        <button type="button" id="bold-btn" class="editor-btn p-2" title="Bold (Ctrl+B)">
                                            <i data-lucide="bold" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="italic-btn" class="editor-btn p-2" title="Italic (Ctrl+I)">
                                            <i data-lucide="italic" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="underline-btn" class="editor-btn p-2" title="Underline (Ctrl+U)">
                                            <i data-lucide="underline" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="strikethrough-btn" class="editor-btn p-2" title="Strikethrough">
                                            <i data-lucide="strikethrough" class="w-4 h-4"></i>
                                        </button>
                                    </div>

                                    <!-- Colors -->
                                    <div class="flex items-center border-r border-slate-300 pr-3 mr-3">
                                        <div class="relative">
                                            <button type="button" id="text-color-btn" class="editor-btn p-2 flex items-center" title="Text Color">
                                                <i data-lucide="type" class="w-4 h-4"></i>
                                                <div class="w-2 h-2 bg-black rounded-full ml-1"></div>
                                            </button>
                                            <div id="text-color-dropdown" class="absolute hidden z-10 mt-1 bg-white shadow-lg rounded-lg border border-slate-200">
                                                <div class="color-picker">
                                                    <button type="button" class="color-btn bg-black" data-color="#000000"></button>
                                                    <button type="button" class="color-btn bg-red-600" data-color="#dc2626"></button>
                                                    <button type="button" class="color-btn bg-blue-600" data-color="#2563eb"></button>
                                                    <button type="button" class="color-btn bg-green-600" data-color="#16a34a"></button>
                                                    <button type="button" class="color-btn bg-yellow-500" data-color="#eab308"></button>
                                                    <button type="button" class="color-btn bg-purple-600" data-color="#9333ea"></button>
                                                    <button type="button" class="color-btn bg-pink-600" data-color="#db2777"></button>
                                                    <button type="button" class="color-btn bg-gray-600" data-color="#4b5563"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="relative ml-1">
                                            <button type="button" id="bg-color-btn" class="editor-btn p-2" title="Background Color">
                                                <i data-lucide="paintbrush" class="w-4 h-4"></i>
                                            </button>
                                            <div id="bg-color-dropdown" class="absolute hidden z-10 mt-1 bg-white shadow-lg rounded-lg border border-slate-200">
                                                <div class="color-picker">
                                                    <button type="button" class="color-btn bg-yellow-100" data-color="#fef9c3"></button>
                                                    <button type="button" class="color-btn bg-green-100" data-color="#dcfce7"></button>
                                                    <button type="button" class="color-btn bg-blue-100" data-color="#dbeafe"></button>
                                                    <button type="button" class="color-btn bg-red-100" data-color="#fee2e2"></button>
                                                    <button type="button" class="color-btn bg-purple-100" data-color="#f3e8ff"></button>
                                                    <button type="button" class="color-btn bg-gray-100" data-color="#f3f4f6"></button>
                                                    <button type="button" class="color-btn bg-pink-100" data-color="#fce7f3"></button>
                                                    <button type="button" class="color-btn bg-white border border-gray-300" data-color="#ffffff"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alignment -->
                                    <div class="flex items-center border-r border-slate-300 pr-3 mr-3">
                                        <button type="button" id="align-left-btn" class="editor-btn p-2" title="Align Left">
                                            <i data-lucide="align-left" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="align-center-btn" class="editor-btn p-2" title="Align Center">
                                            <i data-lucide="align-center" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="align-right-btn" class="editor-btn p-2" title="Align Right">
                                            <i data-lucide="align-right" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="align-justify-btn" class="editor-btn p-2" title="Justify">
                                            <i data-lucide="align-justify" class="w-4 h-4"></i>
                                        </button>
                                    </div>

                                    <!-- Lists -->
                                    <div class="flex items-center border-r border-slate-300 pr-3 mr-3">
                                        <button type="button" id="list-ul-btn" class="editor-btn p-2" title="Bullet List">
                                            <i data-lucide="list" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="list-ol-btn" class="editor-btn p-2" title="Numbered List">
                                            <i data-lucide="list-ordered" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="indent-btn" class="editor-btn p-2" title="Increase Indent">
                                            <i data-lucide="indent" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="outdent-btn" class="editor-btn p-2" title="Decrease Indent">
                                            <i data-lucide="outdent" class="w-4 h-4"></i>
                                        </button>
                                    </div>

                                    <!-- Links & Tools -->
                                    <div class="flex items-center border-r border-slate-300 pr-3 mr-3">
                                        <button type="button" id="link-btn" class="editor-btn p-2" title="Insert Link">
                                            <i data-lucide="link" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" id="unlink-btn" class="editor-btn p-2" title="Remove Link">
                                            <i data-lucide="link-2-off" class="w-4 h-4"></i>
                                        </button>
                                        <label for="image-upload" class="editor-btn p-2 cursor-pointer" title="Insert Image">
                                            <i data-lucide="image" class="w-4 h-4"></i>
                                            <input id="image-upload" type="file" accept="image/*" class="hidden">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Editor Content -->
                            <div
                                id="editor-content"
                                class="editor-content p-4 bg-white focus:outline-none overflow-y-auto"
                                contenteditable="true"
                                style="font-family: Inter, sans-serif; font-size: 14px; line-height: 1.6;"
                            >{!! old('content') !!}</div>

                            <textarea id="hidden-content" name="content" class="hidden" required>{{ old('content') }}</textarea>
                        </div>

                        @error('content')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                        <div class="mt-4 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                            <div class="flex items-start">
                                <i data-lucide="lightbulb" class="w-5 h-5 text-emerald-600 mr-2 mt-0.5"></i>
                                <div class="text-sm text-emerald-800">
                                    <p class="font-medium">Tips Membuat Halaman Pendaftaran:</p>
                                    <ul class="mt-1 list-disc list-inside space-y-1">
                                        <li>Gunakan template untuk memulai dengan cepat</li>
                                        <li>Sertakan informasi persyaratan yang jelas dan lengkap</li>
                                        <li>Cantumkan prosedur pendaftaran step-by-step</li>
                                        <li>Pastikan kontak pendaftaran mudah dihubungi</li>
                                        <li>Gambar dapat di-drag, resize, dan diatur posisinya</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="form-section fade-in" style="animation-delay: 0.3s;">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                            <i data-lucide="settings" class="w-5 h-5 mr-2 text-emerald-600"></i>
                            Publikasi
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="info-card mb-6">
                            <div class="flex items-start">
                                <i data-lucide="info" class="w-5 h-5 text-amber-600 mr-2 mt-0.5"></i>
                                <div class="text-sm text-amber-800">
                                    <p class="font-medium">Informasi</p>
                                    <p class="mt-1">Setelah halaman disimpan, Anda dapat melihat pratinjau dan mengelola halaman pendaftaran.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <button type="submit"
                                    class="w-full btn-primary px-4 py-3 rounded-lg font-medium">
                                <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                                Simpan Halaman
                            </button>

                            <a href="{{ route('admin.registration.index') }}"
                               class="w-full btn-secondary px-4 py-3 rounded-lg font-medium text-center block">
                                <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                                Batal
                            </a>
                        </div>

                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start">
                                <i data-lucide="help-circle" class="w-5 h-5 text-blue-600 mr-2 mt-0.5"></i>
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium">Bantuan:</p>
                                    <ul class="mt-1 list-disc list-inside space-y-1">
                                        <li>Pilih tipe halaman sesuai kebutuhan</li>
                                        <li>Isi judul yang menarik dan informatif</li>
                                        <li>Gunakan template untuk mempercepat pembuatan</li>
                                        <li>Pastikan semua informasi akurat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden fields for legacy compatibility -->
        <input type="hidden" name="requirements[]" value="">
        <input type="hidden" name="procedures[]" value="">
        <input type="hidden" name="documents[]" value="">
        <input type="hidden" name="contacts[]" value="">
    </form>
</div>
</div>
@endsection
