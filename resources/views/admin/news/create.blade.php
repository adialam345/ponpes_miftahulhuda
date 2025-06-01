@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin')

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
    background-color: #10b981;
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
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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
    background-color: #f0fdf4;
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
    background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
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

.btn-primary {
    background: linear-gradient(90deg, #10b981, #3b82f6);
    color: white;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(90deg, #059669, #2563eb);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.5);
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

.input-field {
    transition: all 0.3s ease;
}

.input-field:focus {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.preview-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.preview-item {
    position: relative;
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.preview-item img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.remove-preview {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background: rgba(239, 68, 68, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.remove-preview:hover {
    background: #dc2626;
    transform: scale(1.1);
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let editor, hiddenContent;
let selectedFiles = [];

document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
    initializeEditor();
    setupImageUpload();
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
    setupTemplates();
    setupKeyboardShortcuts();
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

    // Clear formatting
    document.getElementById('clear-format-btn')?.addEventListener('click', function() {
        document.execCommand('removeFormat', false, null);
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

function setupTemplates() {
    const templateBtn = document.getElementById('template-btn');
    const templateDropdown = document.getElementById('template-dropdown');

    if (templateBtn && templateDropdown) {
        templateBtn.addEventListener('click', function() {
            templateDropdown.classList.toggle('hidden');
        });

        const templates = {
            'news-intro': `
                <h2 style="font-size: 20px; font-weight: bold; color: #059669; margin-bottom: 16px;">📰 Informasi Penting</h2>
                <p style="margin-bottom: 12px; color: #374151;">Assalamu'alaikum warahmatullahi wabarakatuh,</p>
                <p style="margin-bottom: 12px; color: #374151;">Dengan hormat kami sampaikan informasi penting berikut:</p>
                <p style="margin-bottom: 12px; color: #374151;">[Silahkan isi konten berita di sini dengan informasi yang relevan]</p>
                <p style="margin-bottom: 12px; color: #374151;">Demikian informasi yang dapat kami sampaikan. Jazakumullahu khairan.</p>
                <p style="color: #374151;">Wassalamu'alaikum warahmatullahi wabarakatuh</p>
            `,
            'news-event': `
                <h2 style="font-size: 20px; font-weight: bold; color: #059669; margin-bottom: 16px;">📅 Undangan Acara</h2>
                <p style="margin-bottom: 12px; color: #374151;">Assalamu'alaikum warahmatullahi wabarakatuh,</p>
                <p style="margin-bottom: 12px; color: #374151;">Dengan hormat kami mengundang Bapak/Ibu untuk menghadiri acara:</p>
                <div style="background: #f0fdf4; padding: 16px; border-radius: 8px; margin: 16px 0; border-left: 4px solid #10b981;">
                    <p style="margin-bottom: 8px;"><strong>📍 Acara:</strong> [Nama Acara]</p>
                    <p style="margin-bottom: 8px;"><strong>📅 Tanggal:</strong> [Tanggal Acara]</p>
                    <p style="margin-bottom: 8px;"><strong>🕐 Waktu:</strong> [Waktu Acara]</p>
                    <p style="margin-bottom: 8px;"><strong>🏢 Tempat:</strong> [Lokasi Acara]</p>
                </div>
                <p style="margin-bottom: 12px; color: #374151;">[Deskripsi acara dan informasi tambahan]</p>
                <p style="color: #374151;">Atas perhatian dan kehadirannya, kami ucapkan terima kasih.</p>
            `,
            'news-announcement': `
                <h2 style="font-size: 20px; font-weight: bold; color: #059669; margin-bottom: 16px;">📢 Pengumuman Penting</h2>
                <p style="margin-bottom: 12px; color: #374151;">Assalamu'alaikum warahmatullahi wabarakatuh,</p>
                <p style="margin-bottom: 12px; color: #374151;">Dengan hormat kami sampaikan pengumuman kepada seluruh [target audience] bahwa:</p>
                <div style="background: #fef3c7; padding: 16px; border-radius: 8px; margin: 16px 0; border-left: 4px solid #f59e0b;">
                    <ul style="margin: 0; padding-left: 20px; color: #374151;">
                        <li style="margin-bottom: 8px;">Poin pengumuman pertama</li>
                        <li style="margin-bottom: 8px;">Poin pengumuman kedua</li>
                        <li style="margin-bottom: 8px;">Poin pengumuman ketiga</li>
                    </ul>
                </div>
                <p style="margin-bottom: 12px; color: #374151;">Untuk informasi lebih lanjut, silahkan hubungi [kontak person].</p>
                <p style="color: #374151;">Demikian pengumuman ini kami sampaikan. Jazakumullahu khairan.</p>
            `,
            'welcome-message': `
                <h2 style="font-size: 20px; font-weight: bold; color: #059669; margin-bottom: 16px;">🌟 Selamat Datang</h2>
                <p style="margin-bottom: 12px; color: #374151;">Assalamu'alaikum warahmatullahi wabarakatuh,</p>
                <p style="margin-bottom: 12px; color: #374151;">Alhamdulillahirabbil'alamiin, puji syukur kehadirat Allah SWT yang telah memberikan rahmat dan hidayah-Nya kepada kita semua.</p>
                <p style="margin-bottom: 12px; color: #374151;">Selamat datang di [nama tempat/acara]. Semoga kehadiran Anda membawa berkah dan manfaat bagi kita semua.</p>
                <p style="color: #374151;">Barakallahu fiikum, wassalamu'alaikum warahmatullahi wabarakatuh</p>
            `
        };

        templateDropdown.querySelectorAll('[data-template]').forEach(btn => {
            btn.addEventListener('click', function() {
                const templateName = this.getAttribute('data-template');
                if (templates[templateName]) {
                    document.execCommand('insertHTML', false, templates[templateName]);
                    templateDropdown.classList.add('hidden');
                    editor.focus();
                    hiddenContent.value = editor.innerHTML;
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!templateBtn.contains(e.target) && !templateDropdown.contains(e.target)) {
                templateDropdown.classList.add('hidden');
            }
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

function setupImageUpload() {
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('image-input');
    const previewContainer = document.getElementById('image-preview');

    if (!uploadArea || !fileInput) return;

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
        if (files.length > 0) {
            const file = files[0];

            // Validate file type
            if (!file.type.startsWith('image/')) {
                showAlert('error', 'File harus berupa gambar');
                return;
            }

            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                showAlert('error', 'Ukuran file maksimal 10MB');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewContainer) {
                    previewContainer.innerHTML = `
                        <div class="preview-item">
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-preview" onclick="removePreview()">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                    `;
                    lucide.createIcons();
                }
            };
            reader.readAsDataURL(file);
        }
    }
}

function removePreview() {
    const previewContainer = document.getElementById('image-preview');
    const fileInput = document.getElementById('image-input');

    if (previewContainer) {
        previewContainer.innerHTML = '';
    }
    if (fileInput) {
        fileInput.value = '';
    }
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
            const title = document.getElementById('title').value.trim();
            const content = hiddenContent.value.trim();

            if (!title) {
                e.preventDefault();
                showAlert('error', 'Judul berita harus diisi');
                return;
            }

            if (!content || content === '<br>' || content === '<div><br></div>') {
                e.preventDefault();
                showAlert('error', 'Konten berita harus diisi');
                return;
            }

            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Sedang menyimpan berita baru',
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
</script>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-slate-900 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                        <i data-lucide="plus" class="w-5 h-5 text-white"></i>
                    </div>
                    Tambah Berita Baru
                </h1>
                <p class="text-slate-600 mt-1">Buat berita atau pengumuman baru untuk ditampilkan di website</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.news.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Information -->
        <div class="form-section fade-in">
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
                        Judul Berita
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                        placeholder="Masukkan judul berita yang menarik..."
                    >
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-2">
                        <i data-lucide="toggle-left" class="w-4 h-4 inline mr-1"></i>
                        Status Publikasi
                    </label>
                    <select
                        name="status"
                        id="status"
                        required
                        class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                    >
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                            📝 Draft - Simpan sebagai draft
                        </option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                            ✅ Publikasikan - Tampilkan di website
                        </option>
                    </select>
                    @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Content Editor -->
        <div class="form-section fade-in" style="animation-delay: 0.1s;">
            <div class="section-header">
                <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-emerald-600"></i>
                    Konten Berita
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
                                <button type="button" id="clear-format-btn" class="editor-btn p-2" title="Clear Formatting">
                                    <i data-lucide="eraser" class="w-4 h-4"></i>
                                </button>
                            </div>

                            <!-- Templates -->
                            <div class="relative ml-auto">
                                <button type="button" id="template-btn" class="editor-btn p-2 flex items-center" title="Insert Template">
                                    <i data-lucide="file-plus" class="w-4 h-4 mr-1"></i>
                                    <span class="text-sm">Template</span>
                                    <i data-lucide="chevron-down" class="w-3 h-3 ml-1"></i>
                                </button>
                                <div id="template-dropdown" class="absolute hidden right-0 z-10 mt-1 w-64 bg-white shadow-lg rounded-lg border border-slate-200 py-1">
                                    <div class="px-3 py-2 border-b border-slate-200 text-xs font-medium text-slate-700">
                                        Template Cepat
                                    </div>
                                    <button type="button" data-template="news-intro" class="template-item w-full text-left px-4 py-3 text-sm">
                                        <i data-lucide="newspaper" class="w-4 h-4 inline mr-2 text-emerald-600"></i>
                                        Informasi Umum
                                    </button>
                                    <button type="button" data-template="news-event" class="template-item w-full text-left px-4 py-3 text-sm">
                                        <i data-lucide="calendar" class="w-4 h-4 inline mr-2 text-blue-600"></i>
                                        Undangan Acara
                                    </button>
                                    <button type="button" data-template="news-announcement" class="template-item w-full text-left px-4 py-3 text-sm">
                                        <i data-lucide="megaphone" class="w-4 h-4 inline mr-2 text-yellow-600"></i>
                                        Pengumuman Penting
                                    </button>
                                    <button type="button" data-template="welcome-message" class="template-item w-full text-left px-4 py-3 text-sm">
                                        <i data-lucide="heart" class="w-4 h-4 inline mr-2 text-pink-600"></i>
                                        Pesan Selamat Datang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Editor Content -->
                    <div
                        id="editor-content"
                        class="editor-content p-4 bg-white focus:outline-none overflow-y-auto"
                        contenteditable="true"
                        style="font-family: Inter, sans-serif; font-size: 14px; line-height: 1.6;"
                        placeholder="Mulai menulis berita Anda di sini..."
                    >{{ old('content') }}</div>

                    <textarea id="hidden-content" name="content" class="hidden">{{ old('content') }}</textarea>
                </div>

                @error('content')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <div class="mt-4 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                    <div class="flex items-start">
                        <i data-lucide="lightbulb" class="w-5 h-5 text-emerald-600 mr-2 mt-0.5"></i>
                        <div class="text-sm text-emerald-800">
                            <p class="font-medium">Tips Menulis Berita:</p>
                            <ul class="mt-1 list-disc list-inside space-y-1">
                                <li>Gunakan template untuk memulai dengan cepat</li>
                                <li>Keyboard shortcuts: Ctrl+B (Bold), Ctrl+I (Italic), Ctrl+U (Underline)</li>
                                <li>Pastikan konten mudah dibaca dan informatif</li>
                                <li>Gunakan salam dan penutup yang sesuai dengan nilai-nilai islami</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Upload -->
        <div class="form-section fade-in" style="animation-delay: 0.2s;">
            <div class="section-header">
                <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                    <i data-lucide="image" class="w-5 h-5 mr-2 text-emerald-600"></i>
                    Gambar Berita
                </h3>
            </div>
            <div class="p-6">
                <div id="upload-area" class="upload-area">
                    <div class="text-center">
                        <i data-lucide="upload-cloud" class="w-12 h-12 text-slate-400 mx-auto mb-4"></i>
                        <div class="text-lg font-medium text-slate-900 mb-2">
                            Drag & drop gambar di sini atau klik untuk memilih
                        </div>
                        <p class="text-sm text-slate-500">
                            Format: JPEG, PNG, JPG, GIF. Maksimal: 10MB
                        </p>
                    </div>
                    <input type="file" name="image" id="image-input" accept="image/*" class="hidden">
                </div>

                <div id="image-preview" class="preview-container"></div>

                @error('image')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start">
                        <i data-lucide="info" class="w-5 h-5 text-blue-600 mr-2 mt-0.5"></i>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium">Catatan Gambar:</p>
                            <ul class="mt-1 list-disc list-inside space-y-1">
                                <li>Gambar akan ditampilkan sebagai thumbnail di halaman berita</li>
                                <li>Gunakan gambar yang relevan dengan konten berita</li>
                                <li>Pastikan gambar memiliki kualitas yang baik dan tidak blur</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('admin.news.index') }}"
               class="btn-secondary px-6 py-3 rounded-lg font-medium">
                <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                Batal
            </a>
            <button type="submit"
                    class="btn-primary px-6 py-3 rounded-lg font-medium">
                <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                Simpan Berita
            </button>
        </div>
    </form>
</div>
</div>
@endsection
