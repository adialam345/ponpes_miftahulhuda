@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h1 class="text-2xl font-semibold">Tambah Berita Baru</h1>
        <p class="text-gray-500">Isi form berikut untuk menambahkan berita baru</p>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>
                <div class="p-4">
                    <!-- Word-like Text Editor Toolbar -->
                    <div class="border border-gray-300 rounded-t-md bg-gray-100 p-2 flex flex-wrap items-center gap-1">
                        <!-- Font Family & Size -->
                        <div class="flex items-center border-r border-gray-300 pr-2 mr-2">
                            <select id="font-family" class="text-sm border border-gray-300 rounded mr-1 focus:outline-none focus:ring-1 focus:ring-green-500">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="'Times New Roman', serif">Times New Roman</option>
                                <option value="'Courier New', monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="'Trebuchet MS', sans-serif">Trebuchet MS</option>
                            </select>
                            <select id="font-size" class="text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-green-500">
                                <option value="1">8pt</option>
                                <option value="2">10pt</option>
                                <option value="3" selected="">12pt</option>
                                <option value="4">14pt</option>
                                <option value="5">18pt</option>
                                <option value="6">24pt</option>
                                <option value="7">36pt</option>
                            </select>
                        </div>
                        
                        <!-- Text Formatting -->
                        <div class="flex items-center border-r border-gray-300 pr-2 mr-2">
                            <button type="button" id="bold-btn" class="p-1.5 rounded hover:bg-gray-200" title="Bold (Ctrl+B)">
                                <i class="fas fa-bold"></i>
                            </button>
                            <button type="button" id="italic-btn" class="p-1.5 rounded hover:bg-gray-200" title="Italic (Ctrl+I)">
                                <i class="fas fa-italic"></i>
                            </button>
                            <button type="button" id="underline-btn" class="p-1.5 rounded hover:bg-gray-200" title="Underline (Ctrl+U)">
                                <i class="fas fa-underline"></i>
                            </button>
                            <button type="button" id="strikethrough-btn" class="p-1.5 rounded hover:bg-gray-200" title="Strikethrough">
                                <i class="fas fa-strikethrough"></i>
                            </button>
                        </div>
                        
                        <!-- Colors -->
                        <div class="flex items-center border-r border-gray-300 pr-2 mr-2">
                            <div class="relative">
                                <button type="button" id="text-color-btn" class="p-1.5 rounded hover:bg-gray-200 flex items-center" title="Text Color">
                                    <i class="fas fa-font"></i>
                                    <span class="ml-1 w-2 h-2 bg-black rounded-full"></span>
                                </button>
                                <div id="text-color-dropdown" class="absolute hidden z-10 mt-1 w-40 bg-white shadow-lg rounded-md p-2 grid grid-cols-4 gap-1">
                                    <button type="button" class="w-8 h-8 bg-black rounded" data-color="#000000"></button>
                                    <button type="button" class="w-8 h-8 bg-red-600 rounded" data-color="#dc2626"></button>
                                    <button type="button" class="w-8 h-8 bg-blue-600 rounded" data-color="#2563eb"></button>
                                    <button type="button" class="w-8 h-8 bg-green-600 rounded" data-color="#16a34a"></button>
                                    <button type="button" class="w-8 h-8 bg-yellow-500 rounded" data-color="#eab308"></button>
                                    <button type="button" class="w-8 h-8 bg-purple-600 rounded" data-color="#9333ea"></button>
                                    <button type="button" class="w-8 h-8 bg-pink-600 rounded" data-color="#db2777"></button>
                                    <button type="button" class="w-8 h-8 bg-gray-600 rounded" data-color="#4b5563"></button>
                                </div>
                            </div>
                            <div class="relative ml-1">
                                <button type="button" id="bg-color-btn" class="p-1.5 rounded hover:bg-gray-200 flex items-center" title="Background Color">
                                    <i class="fas fa-fill-drip"></i>
                                </button>
                                <div id="bg-color-dropdown" class="absolute hidden z-10 mt-1 w-40 bg-white shadow-lg rounded-md p-2 grid grid-cols-4 gap-1">
                                    <button type="button" class="w-8 h-8 bg-yellow-100 rounded" data-color="#fef9c3"></button>
                                    <button type="button" class="w-8 h-8 bg-green-100 rounded" data-color="#dcfce7"></button>
                                    <button type="button" class="w-8 h-8 bg-blue-100 rounded" data-color="#dbeafe"></button>
                                    <button type="button" class="w-8 h-8 bg-red-100 rounded" data-color="#fee2e2"></button>
                                    <button type="button" class="w-8 h-8 bg-purple-100 rounded" data-color="#f3e8ff"></button>
                                    <button type="button" class="w-8 h-8 bg-gray-100 rounded" data-color="#f3f4f6"></button>
                                    <button type="button" class="w-8 h-8 bg-pink-100 rounded" data-color="#fce7f3"></button>
                                    <button type="button" class="w-8 h-8 bg-white border border-gray-300 rounded" data-color="#ffffff"></button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Text Alignment -->
                        <div class="flex items-center border-r border-gray-300 pr-2 mr-2">
                            <button type="button" id="align-left-btn" class="p-1.5 rounded hover:bg-gray-200" title="Align Left">
                                <i class="fas fa-align-left"></i>
                            </button>
                            <button type="button" id="align-center-btn" class="p-1.5 rounded hover:bg-gray-200" title="Align Center">
                                <i class="fas fa-align-center"></i>
                            </button>
                            <button type="button" id="align-right-btn" class="p-1.5 rounded hover:bg-gray-200" title="Align Right">
                                <i class="fas fa-align-right"></i>
                            </button>
                            <button type="button" id="align-justify-btn" class="p-1.5 rounded hover:bg-gray-200" title="Justify">
                                <i class="fas fa-align-justify"></i>
                            </button>
                        </div>
                        
                        <!-- Lists and Indentation -->
                        <div class="flex items-center border-r border-gray-300 pr-2 mr-2">
                            <button type="button" id="list-ul-btn" class="p-1.5 rounded hover:bg-gray-200" title="Bullet List">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <button type="button" id="list-ol-btn" class="p-1.5 rounded hover:bg-gray-200" title="Numbered List">
                                <i class="fas fa-list-ol"></i>
                            </button>
                            <button type="button" id="indent-btn" class="p-1.5 rounded hover:bg-gray-200" title="Increase Indent">
                                <i class="fas fa-indent"></i>
                            </button>
                            <button type="button" id="outdent-btn" class="p-1.5 rounded hover:bg-gray-200" title="Decrease Indent">
                                <i class="fas fa-outdent"></i>
                            </button>
                        </div>
                        
                        <!-- Links and Images -->
                        <div class="flex items-center">
                            <button type="button" id="link-btn" class="p-1.5 rounded hover:bg-gray-200" title="Insert Link">
                                <i class="fas fa-link"></i>
                            </button>
                            <button type="button" id="unlink-btn" class="p-1.5 rounded hover:bg-gray-200" title="Remove Link">
                                <i class="fas fa-unlink"></i>
                            </button>
                            <label for="image-upload" class="p-1.5 rounded hover:bg-gray-200 cursor-pointer" title="Insert Image">
                                <i class="fas fa-image"></i>
                                <span class="sr-only">Upload Image</span>
                            </label>
                            <input id="image-upload" type="file" accept="image/*" class="hidden">
                        </div>

                        <!-- Templates for News -->
                        <div class="flex items-center ml-auto">
                            <div class="relative">
                                <button type="button" id="template-btn" class="inline-flex items-center p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Insert Template">
                                    <i class="fas fa-file-alt mr-1"></i>
                                    <span class="text-sm">Templates</span>
                                    <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                </button>
                                <div id="template-dropdown" class="absolute hidden right-0 z-10 mt-1 w-64 bg-white shadow-lg rounded-md py-1 text-sm">
                                    <div class="px-3 py-2 border-b border-gray-200 text-xs font-medium text-gray-700">
                                        Template Cepat
                                    </div>
                                    <button type="button" data-template="news-intro" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                        <i class="fas fa-newspaper mr-2 text-green-600"></i> Intro Berita
                                    </button>
                                    <button type="button" data-template="news-event" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                        <i class="fas fa-calendar-alt mr-2 text-blue-600"></i> Berita Acara
                                    </button>
                                    <button type="button" data-template="news-announcement" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                        <i class="fas fa-bullhorn mr-2 text-yellow-600"></i> Pengumuman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Word-like Text Editor Content Area -->
                    <div id="editor-container" class="min-h-[300px] max-h-[600px] overflow-y-auto p-4 border border-gray-300 rounded-b-md bg-white focus:outline-none" contenteditable="true" style="font-family: Arial, sans-serif; font-size: 14px;">{{ old('content') }}</div>
                    <textarea id="hidden-content" name="content" class="hidden">{{ old('content') }}</textarea>
                </div>
                @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Berita</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100">
                <p class="text-gray-500 text-xs mt-1">Format: JPEG, PNG, JPG, GIF. Ukuran maksimum: 10MB.</p>
                @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publikasikan Sekarang</option>
                </select>
                @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.news.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded">
                    Batal
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Rich Text Editor functionality
    const editor = document.getElementById('editor-container');
    const hiddenContent = document.getElementById('hidden-content');
    const form = document.querySelector('form');
    
    // Initialize the hidden textarea with the editor content
    if (editor && hiddenContent) {
        hiddenContent.value = editor.innerHTML;
    }
    
    // Attach submit handler directly to the form
    if (form) {
        form.onsubmit = function() {
            if (editor && hiddenContent) {
                hiddenContent.value = editor.innerHTML;
            }
            return true; // Allow the form to submit
        };
    }
    
    // Update on any change to the editor content
    if (editor && hiddenContent) {
        editor.addEventListener('input', function() {
            hiddenContent.value = editor.innerHTML;
        });
    }
    
    // Font family
    document.getElementById('font-family').addEventListener('change', function() {
        document.execCommand('fontName', false, this.value);
        editor.focus();
    });
    
    // Font size
    document.getElementById('font-size').addEventListener('change', function() {
        document.execCommand('fontSize', false, this.value);
        editor.focus();
    });
    
    // Text formatting buttons
    document.getElementById('bold-btn').addEventListener('click', function() {
        document.execCommand('bold', false, null);
        editor.focus();
    });
    
    document.getElementById('italic-btn').addEventListener('click', function() {
        document.execCommand('italic', false, null);
        editor.focus();
    });
    
    document.getElementById('underline-btn').addEventListener('click', function() {
        document.execCommand('underline', false, null);
        editor.focus();
    });
    
    document.getElementById('strikethrough-btn').addEventListener('click', function() {
        document.execCommand('strikeThrough', false, null);
        editor.focus();
    });
    
    // Text color dropdown
    const textColorBtn = document.getElementById('text-color-btn');
    const textColorDropdown = document.getElementById('text-color-dropdown');
    
    textColorBtn.addEventListener('click', function() {
        textColorDropdown.classList.toggle('hidden');
        bgColorDropdown.classList.add('hidden');
    });
    
    textColorDropdown.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function() {
            const color = this.getAttribute('data-color');
            document.execCommand('foreColor', false, color);
            textColorDropdown.classList.add('hidden');
            editor.focus();
        });
    });
    
    // Background color dropdown
    const bgColorBtn = document.getElementById('bg-color-btn');
    const bgColorDropdown = document.getElementById('bg-color-dropdown');
    
    bgColorBtn.addEventListener('click', function() {
        bgColorDropdown.classList.toggle('hidden');
        textColorDropdown.classList.add('hidden');
    });
    
    bgColorDropdown.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function() {
            const color = this.getAttribute('data-color');
            document.execCommand('hiliteColor', false, color);
            bgColorDropdown.classList.add('hidden');
            editor.focus();
        });
    });
    
    // Hide color dropdowns when clicking elsewhere
    document.addEventListener('click', function(e) {
        if (!textColorBtn.contains(e.target) && !textColorDropdown.contains(e.target)) {
            textColorDropdown.classList.add('hidden');
        }
        if (!bgColorBtn.contains(e.target) && !bgColorDropdown.contains(e.target)) {
            bgColorDropdown.classList.add('hidden');
        }
        if (!templateBtn.contains(e.target) && !templateDropdown.contains(e.target)) {
            templateDropdown.classList.add('hidden');
        }
    });
    
    // Text alignment buttons
    document.getElementById('align-left-btn').addEventListener('click', function() {
        document.execCommand('justifyLeft', false, null);
        editor.focus();
    });
    
    document.getElementById('align-center-btn').addEventListener('click', function() {
        document.execCommand('justifyCenter', false, null);
        editor.focus();
    });
    
    document.getElementById('align-right-btn').addEventListener('click', function() {
        document.execCommand('justifyRight', false, null);
        editor.focus();
    });
    
    document.getElementById('align-justify-btn').addEventListener('click', function() {
        document.execCommand('justifyFull', false, null);
        editor.focus();
    });
    
    // List buttons
    document.getElementById('list-ul-btn').addEventListener('click', function() {
        document.execCommand('insertUnorderedList', false, null);
        editor.focus();
    });
    
    document.getElementById('list-ol-btn').addEventListener('click', function() {
        document.execCommand('insertOrderedList', false, null);
        editor.focus();
    });
    
    // Indentation
    document.getElementById('indent-btn').addEventListener('click', function() {
        document.execCommand('indent', false, null);
        editor.focus();
    });
    
    document.getElementById('outdent-btn').addEventListener('click', function() {
        document.execCommand('outdent', false, null);
        editor.focus();
    });
    
    // Link buttons
    document.getElementById('link-btn').addEventListener('click', function() {
        const url = prompt('Enter the URL:');
        if (url) {
            document.execCommand('createLink', false, url);
        }
        editor.focus();
    });
    
    document.getElementById('unlink-btn').addEventListener('click', function() {
        document.execCommand('unlink', false, null);
        editor.focus();
    });
    
    // Add keyboard shortcuts
    editor.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'b') {
            e.preventDefault();
            document.execCommand('bold', false, null);
        } else if (e.ctrlKey && e.key === 'i') {
            e.preventDefault();
            document.execCommand('italic', false, null);
        } else if (e.ctrlKey && e.key === 'u') {
            e.preventDefault();
            document.execCommand('underline', false, null);
        }
    });
    
    // Image upload
    document.getElementById('image-upload').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%';
                img.classList.add('my-2', 'rounded', 'border', 'border-gray-300');
                document.execCommand('insertHTML', false, img.outerHTML);
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Template dropdown
    const templateBtn = document.getElementById('template-btn');
    const templateDropdown = document.getElementById('template-dropdown');
    
    templateBtn.addEventListener('click', function() {
        templateDropdown.classList.toggle('hidden');
    });
    
    // Template handlers
    const templates = {
        'news-intro': `
            <h2 style="font-size: 18px; font-weight: bold; color: #006400; margin-bottom: 10px;">Informasi Penting</h2>
            <p style="margin-bottom: 10px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.</p>
            <p style="margin-bottom: 10px;">Silahkan isi konten berita di sini dengan informasi yang relevan.</p>
        `,
        'news-event': `
            <h2 style="font-size: 18px; font-weight: bold; color: #006400; margin-bottom: 10px;">Acara Mendatang</h2>
            <p style="margin-bottom: 10px;"><strong>Tanggal:</strong> [Masukkan Tanggal]</p>
            <p style="margin-bottom: 10px;"><strong>Waktu:</strong> [Masukkan Waktu]</p>
            <p style="margin-bottom: 10px;"><strong>Tempat:</strong> [Masukkan Lokasi]</p>
            <p style="margin-bottom: 10px;"><strong>Deskripsi:</strong></p>
            <p style="margin-bottom: 10px;">Silahkan isi deskripsi acara di sini.</p>
        `,
        'news-announcement': `
            <h2 style="font-size: 18px; font-weight: bold; color: #006400; margin-bottom: 10px;">Pengumuman Penting</h2>
            <p style="margin-bottom: 10px;">Dengan hormat kami sampaikan kepada seluruh [target audience] bahwa:</p>
            <ul style="margin-bottom: 10px; padding-left: 20px;">
                <li>Poin pengumuman 1</li>
                <li>Poin pengumuman 2</li>
                <li>Poin pengumuman 3</li>
            </ul>
            <p style="margin-bottom: 10px;">Untuk informasi lebih lanjut silahkan hubungi [kontak].</p>
        `
    };
    
    templateDropdown.querySelectorAll('button[data-template]').forEach(button => {
        button.addEventListener('click', function() {
            const templateName = this.getAttribute('data-template');
            if (templates[templateName]) {
                document.execCommand('insertHTML', false, templates[templateName]);
                templateDropdown.classList.add('hidden');
                editor.focus();
            }
        });
    });
});
</script>
@endsection 