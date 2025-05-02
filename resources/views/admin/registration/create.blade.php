@extends('layouts.admin')

@section('title', 'Tambah Halaman Pendaftaran - Admin')

@section('content')
<div class="py-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="mb-4">
            <h1 class="text-2xl font-semibold text-gray-900">Tambah Halaman Pendaftaran</h1>
            <p class="text-sm text-gray-600">Isi form berikut untuk menambahkan halaman pendaftaran baru</p>
        </div>

        <form action="{{ route('admin.registration.store') }}" method="POST">
            @csrf

            <div class="flex flex-col md:flex-row gap-6">
                <!-- Main Content Area -->
                <div class="md:w-2/3">
                    <div class="bg-white shadow-sm rounded-md overflow-hidden mb-6">
                        <div class="p-6">
                            <!-- Tipe Halaman -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Halaman <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="page_type" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md @error('page_type') border-red-500 @enderror" required>
                                        <option value="">Pilih Tipe Halaman</option>
                                        <option value="pondok" {{ old('page_type', $type) == 'pondok' ? 'selected' : '' }}>Pendaftaran Pondok</option>
                                        <option value="smp" {{ old('page_type', $type) == 'smp' ? 'selected' : '' }}>Pendaftaran SMP</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('page_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Judul Halaman -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Halaman <span class="text-red-500">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('title') border-red-500 @enderror" required>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Mulai Pendaftaran -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Pendaftaran</label>
                                <input type="date" name="registration_start" value="{{ old('registration_start') }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('registration_start') border-red-500 @enderror">
                                @error('registration_start')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Akhir Pendaftaran -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir Pendaftaran</label>
                                <input type="date" name="registration_end" value="{{ old('registration_end') }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('registration_end') border-red-500 @enderror">
                                @error('registration_end')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Konten Halaman -->
                    <div class="bg-white shadow-sm rounded-md overflow-hidden mb-6">
                        <div class="border-b border-gray-200 px-4 py-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Konten Halaman <span class="text-red-500">*</span></h3>
                            <p class="mt-1 text-sm text-gray-500">Deskripsi umum halaman pendaftaran.</p>
                        </div>
                        <div class="p-4">
                             
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
                                        <option value="3" selected>12pt</option>
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
                                    <input id="image-upload" type="file" accept="image/*" class="hidden" />
                                </div>

                                <!-- Templates -->
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
                                            <button type="button" data-template="requirements" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                                <i class="fas fa-list-ul mr-2 text-green-600"></i> Persyaratan Pendaftaran
                                            </button>
                                            <button type="button" data-template="procedures" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                                <i class="fas fa-tasks mr-2 text-blue-600"></i> Prosedur Pendaftaran
                                            </button>
                                            <button type="button" data-template="documents" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                                <i class="fas fa-file-alt mr-2 text-yellow-600"></i> Dokumen yang Dibutuhkan
                                            </button>
                                            <button type="button" data-template="contacts" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                                <i class="fas fa-address-book mr-2 text-red-600"></i> Kontak Pendaftaran
                                            </button>
                                            <button type="button" data-template="full-page" class="w-full text-left px-4 py-2 hover:bg-gray-100 border-t border-gray-200">
                                                <i class="fas fa-file-medical mr-2 text-purple-600"></i> Template Halaman Lengkap
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Word-like Text Editor Content Area -->
                            <div id="editor-container" class="min-h-[300px] max-h-[600px] overflow-y-auto p-4 border border-gray-300 rounded-b-md bg-white focus:outline-none" contenteditable="true" style="font-family: Arial, sans-serif; font-size: 14px;">
                                {!! old('content') !!}
                            </div>
                            <textarea id="hidden-content" name="content" class="hidden" required>{{ old('content') }}</textarea>
                            
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="mt-3 text-gray-500 text-sm">
                                <h5 class="font-medium mb-1">Tip Penggunaan Editor:</h5>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Gunakan <span class="bg-gray-100 px-1 rounded">Templates</span> untuk menambahkan bagian-bagian standar seperti Persyaratan, Prosedur, dll.</li>
                                    <li>Untuk menyisipkan gambar, klik tombol <i class="fas fa-image"></i> atau tarik & lepas file gambar langsung ke dalam editor.</li>
                                    <li>Gunakan tombol formatting untuk mengubah tampilan teks (tebal, miring, warna, dll).</li>
                                    <li>Gambar dapat diubah ukurannya dengan menarik sudut gambar.</li>
                                    <li>Untuk menyimpan halaman ini, klik tombol <span class="bg-blue-100 text-blue-700 px-1 rounded">Simpan</span> di panel samping.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden fields to store legacy data format if needed -->
                    <input type="hidden" name="requirements[]" value="">
                    <input type="hidden" name="procedures[]" value="">
                    <input type="hidden" name="documents[]" value="">
                    <input type="hidden" name="contacts[]" value="">
                </div>

                <!-- Sidebar -->
                <div class="md:w-1/3">
                    <div class="bg-white shadow-sm rounded-md overflow-hidden mb-6">
                        <div class="border-b border-gray-200 px-4 py-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Publikasi</h3>
                        </div>
                        <div class="p-4">
                            <div class="bg-yellow-50 p-4 rounded-md mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-info-circle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Informasi</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>Setelah halaman disimpan, Anda dapat melihat pratinjau halaman tersebut.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-end space-x-3">
                                <a href="{{ route('admin.registration.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Batal
                                </a>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <i class="fas fa-save mr-2"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
    
    console.log('Editor found:', !!editor, 'Hidden content found:', !!hiddenContent, 'Form found:', !!form);
    
    // Initialize the hidden textarea with the editor content
    if (editor && hiddenContent) {
        hiddenContent.value = editor.innerHTML;
    }
    
    // Attach submit handler directly to the form
    if (form) {
        form.onsubmit = function() {
            if (editor && hiddenContent) {
                hiddenContent.value = editor.innerHTML;
                console.log('Saving content on submit:', hiddenContent.value.substring(0, 100) + '...');
            }
            return true; // Allow the form to submit
        };
    }
    
    // Also update on any change to the editor content
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
                img.classList.add('my-2', 'cursor-move', 'rounded', 'border', 'border-gray-300');
                
                // Get current selection and insert image
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    range.insertNode(img);
                } else {
                    editor.appendChild(img);
                }
                
                // Make image draggable
                img.addEventListener('mousedown', function(e) {
                    // Store initial mouse position and image position
                    const startX = e.clientX;
                    const startY = e.clientY;
                    const startLeft = img.offsetLeft;
                    const startTop = img.offsetTop;
                    
                    // Prevent default behavior
                    e.preventDefault();
                    
                    // Add resize handles
                    const addResizeHandles = () => {
                        const wrapper = document.createElement('div');
                        wrapper.style.position = 'relative';
                        wrapper.style.display = 'inline-block';
                        wrapper.style.margin = '5px';
                        
                        img.parentNode.insertBefore(wrapper, img);
                        wrapper.appendChild(img);
                        
                        // Create resize handles
                        const corners = ['nw', 'ne', 'se', 'sw'];
                        corners.forEach(corner => {
                            const handle = document.createElement('div');
                            handle.className = `resize-handle resize-${corner}`;
                            handle.style.position = 'absolute';
                            handle.style.width = '10px';
                            handle.style.height = '10px';
                            handle.style.backgroundColor = 'white';
                            handle.style.border = '1px solid #777';
                            handle.style.borderRadius = '50%';
                            handle.style.cursor = `${corner}-resize`;
                            
                            // Position the handle
                            if (corner.includes('n')) handle.style.top = '-5px';
                            if (corner.includes('s')) handle.style.bottom = '-5px';
                            if (corner.includes('w')) handle.style.left = '-5px';
                            if (corner.includes('e')) handle.style.right = '-5px';
                            
                            wrapper.appendChild(handle);
                            
                            // Add resize functionality
                            handle.addEventListener('mousedown', function(e) {
                                e.stopPropagation();
                                e.preventDefault();
                                
                                const startWidth = img.offsetWidth;
                                const startHeight = img.offsetHeight;
                                const startX = e.clientX;
                                const startY = e.clientY;
                                
                                const resizeHandler = function(e) {
                                    let newWidth = startWidth;
                                    let newHeight = startHeight;
                                    
                                    if (corner.includes('e')) {
                                        newWidth = startWidth + (e.clientX - startX);
                                    } else if (corner.includes('w')) {
                                        newWidth = startWidth - (e.clientX - startX);
                                    }
                                    
                                    if (corner.includes('s')) {
                                        newHeight = startHeight + (e.clientY - startY);
                                    } else if (corner.includes('n')) {
                                        newHeight = startHeight - (e.clientY - startY);
                                    }
                                    
                                    // Maintain aspect ratio
                                    const ratio = startWidth / startHeight;
                                    if (e.shiftKey) {
                                        if (Math.abs(e.clientX - startX) > Math.abs(e.clientY - startY)) {
                                            newHeight = newWidth / ratio;
                                        } else {
                                            newWidth = newHeight * ratio;
                                        }
                                    }
                                    
                                    img.style.width = `${Math.max(50, newWidth)}px`;
                                    img.style.height = 'auto';
                                };
                                
                                const endResizeHandler = function() {
                                    document.removeEventListener('mousemove', resizeHandler);
                                    document.removeEventListener('mouseup', endResizeHandler);
                                };
                                
                                document.addEventListener('mousemove', resizeHandler);
                                document.addEventListener('mouseup', endResizeHandler);
                            });
                        });
                    };
                    
                    // Mouse move handler
                    function moveHandler(e) {
                        const dx = e.clientX - startX;
                        const dy = e.clientY - startY;
                        
                        // Update image position
                        img.style.position = 'relative';
                        img.style.left = `${startLeft + dx}px`;
                        img.style.top = `${startTop + dy}px`;
                    }
                    
                    // Mouse up handler
                    function upHandler() {
                        // Remove event listeners
                        document.removeEventListener('mousemove', moveHandler);
                        document.removeEventListener('mouseup', upHandler);
                        
                        // Add resize handles on double click
                        img.addEventListener('dblclick', function(e) {
                            e.preventDefault();
                            addResizeHandles();
                        });
                    }
                    
                    // Add event listeners
                    document.addEventListener('mousemove', moveHandler);
                    document.addEventListener('mouseup', upHandler);
                });
            };
            reader.readAsDataURL(file);
        }
    });

    // Template feature
    const templateBtn = document.getElementById('template-btn');
    const templateDropdown = document.getElementById('template-dropdown');
    
    templateBtn.addEventListener('click', function() {
        templateDropdown.classList.toggle('hidden');
    });
    
    // Hide template dropdown when clicking elsewhere
    document.addEventListener('click', function(e) {
        if (!templateBtn.contains(e.target) && !templateDropdown.contains(e.target)) {
            templateDropdown.classList.add('hidden');
        }
    });
    
    // Template insertion
    templateDropdown.querySelectorAll('button[data-template]').forEach(button => {
        button.addEventListener('click', function() {
            const templateType = this.getAttribute('data-template');
            let templateHTML = '';
            
            switch(templateType) {
                case 'requirements':
                    templateHTML = `
                        <h3 style="font-size: 18px; font-weight: bold; color: #166534; margin-bottom: 10px;">Persyaratan Pendaftaran</h3>
                        <ul style="margin-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 5px;">Fotokopi Kartu Keluarga</li>
                            <li style="margin-bottom: 5px;">Fotokopi Akta Kelahiran</li>
                            <li style="margin-bottom: 5px;">Fotokopi Ijazah Terakhir</li>
                            <li style="margin-bottom: 5px;">Pas Foto 3x4 (3 lembar)</li>
                            <li style="margin-bottom: 5px;">Surat Keterangan Sehat dari Dokter</li>
                        </ul>
                    `;
                    break;
                case 'procedures':
                    templateHTML = `
                        <h3 style="font-size: 18px; font-weight: bold; color: #1e40af; margin-bottom: 10px;">Prosedur Pendaftaran</h3>
                        <ol style="margin-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 5px;">Mengisi formulir pendaftaran online</li>
                            <li style="margin-bottom: 5px;">Membayar biaya pendaftaran</li>
                            <li style="margin-bottom: 5px;">Menyerahkan berkas persyaratan</li>
                            <li style="margin-bottom: 5px;">Mengikuti ujian seleksi</li>
                            <li style="margin-bottom: 5px;">Pengumuman hasil seleksi</li>
                            <li style="margin-bottom: 5px;">Pendaftaran ulang bagi yang diterima</li>
                        </ol>
                    `;
                    break;
                case 'documents':
                    templateHTML = `
                        <h3 style="font-size: 18px; font-weight: bold; color: #854d0e; margin-bottom: 10px;">Dokumen yang Dibutuhkan</h3>
                        <ul style="margin-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 5px;">Formulir Pendaftaran (diisi lengkap)</li>
                            <li style="margin-bottom: 5px;">Surat Pernyataan Orang Tua</li>
                            <li style="margin-bottom: 5px;">Surat Rekomendasi dari Sekolah Asal</li>
                            <li style="margin-bottom: 5px;">Rapor 3 Semester Terakhir</li>
                        </ul>
                    `;
                    break;
                case 'contacts':
                    templateHTML = `
                        <h3 style="font-size: 18px; font-weight: bold; color: #b91c1c; margin-bottom: 10px;">Kontak Pendaftaran</h3>
                        <div style="margin-left: 10px; margin-bottom: 15px;">
                            <p style="margin-bottom: 5px;"><i class="fas fa-phone-alt" style="width: 20px;"></i> Telepon: 0812-3456-7890 (Ustadz Ahmad)</p>
                            <p style="margin-bottom: 5px;"><i class="fas fa-envelope" style="width: 20px;"></i> Email: pendaftaran@ponpesmiftahulhuda.sch.id</p>
                            <p style="margin-bottom: 5px;"><i class="fab fa-whatsapp" style="width: 20px;"></i> WhatsApp: 0812-3456-7890</p>
                            <p style="margin-bottom: 5px;"><i class="fas fa-map-marker-alt" style="width: 20px;"></i> Alamat: Jl. Contoh No. 123, Kota Anda</p>
                        </div>
                    `;
                    break;
                case 'full-page':
                    templateHTML = `
                        <h2 style="font-size: 22px; font-weight: bold; color: #1f2937; margin-bottom: 15px; text-align: center;">Informasi Pendaftaran</h2>
                        
                        <p style="margin-bottom: 20px; text-align: justify;">
                            Pondok Pesantren Miftahul Huda membuka pendaftaran santri baru untuk tahun akademik 2023/2024. 
                            Berikut adalah informasi lengkap mengenai persyaratan, prosedur, dokumen yang dibutuhkan, 
                            dan kontak pendaftaran.
                        </p>
                        
                        <h3 style="font-size: 18px; font-weight: bold; color: #166534; margin-bottom: 10px;">Persyaratan Pendaftaran</h3>
                        <ul style="margin-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 5px;">Fotokopi Kartu Keluarga</li>
                            <li style="margin-bottom: 5px;">Fotokopi Akta Kelahiran</li>
                            <li style="margin-bottom: 5px;">Fotokopi Ijazah Terakhir</li>
                            <li style="margin-bottom: 5px;">Pas Foto 3x4 (3 lembar)</li>
                            <li style="margin-bottom: 5px;">Surat Keterangan Sehat dari Dokter</li>
                        </ul>
                        
                        <h3 style="font-size: 18px; font-weight: bold; color: #1e40af; margin-bottom: 10px;">Prosedur Pendaftaran</h3>
                        <ol style="margin-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 5px;">Mengisi formulir pendaftaran online</li>
                            <li style="margin-bottom: 5px;">Membayar biaya pendaftaran</li>
                            <li style="margin-bottom: 5px;">Menyerahkan berkas persyaratan</li>
                            <li style="margin-bottom: 5px;">Mengikuti ujian seleksi</li>
                            <li style="margin-bottom: 5px;">Pengumuman hasil seleksi</li>
                            <li style="margin-bottom: 5px;">Pendaftaran ulang bagi yang diterima</li>
                        </ol>
                        
                        <h3 style="font-size: 18px; font-weight: bold; color: #854d0e; margin-bottom: 10px;">Dokumen yang Dibutuhkan</h3>
                        <ul style="margin-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 5px;">Formulir Pendaftaran (diisi lengkap)</li>
                            <li style="margin-bottom: 5px;">Surat Pernyataan Orang Tua</li>
                            <li style="margin-bottom: 5px;">Surat Rekomendasi dari Sekolah Asal</li>
                            <li style="margin-bottom: 5px;">Rapor 3 Semester Terakhir</li>
                        </ul>
                        
                        <h3 style="font-size: 18px; font-weight: bold; color: #b91c1c; margin-bottom: 10px;">Kontak Pendaftaran</h3>
                        <div style="margin-left: 10px; margin-bottom: 15px;">
                            <p style="margin-bottom: 5px;"><i class="fas fa-phone-alt" style="width: 20px;"></i> Telepon: 0812-3456-7890 (Ustadz Ahmad)</p>
                            <p style="margin-bottom: 5px;"><i class="fas fa-envelope" style="width: 20px;"></i> Email: pendaftaran@ponpesmiftahulhuda.sch.id</p>
                            <p style="margin-bottom: 5px;"><i class="fab fa-whatsapp" style="width: 20px;"></i> WhatsApp: 0812-3456-7890</p>
                            <p style="margin-bottom: 5px;"><i class="fas fa-map-marker-alt" style="width: 20px;"></i> Alamat: Jl. Contoh No. 123, Kota Anda</p>
                        </div>
                    `;
                    break;
                default:
                    templateHTML = '';
            }
            
            if (templateHTML) {
                // Get current selection
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    
                    // Create a temporary div to hold the template HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = templateHTML;
                    
                    // Insert the template content
                    range.deleteContents();
                    
                    // Insert each child node of the tempDiv
                    while (tempDiv.firstChild) {
                        range.insertNode(tempDiv.firstChild);
                        range.collapse(false);
                    }
                } else {
                    // If no selection, append to the end
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = templateHTML;
                    
                    // Append each child node of the tempDiv
                    while (tempDiv.firstChild) {
                        editor.appendChild(tempDiv.firstChild);
                    }
                }
                
                // Hide dropdown
                templateDropdown.classList.add('hidden');
                
                // Focus editor
                editor.focus();
            }
        });
    });
});
</script>
@endsection 