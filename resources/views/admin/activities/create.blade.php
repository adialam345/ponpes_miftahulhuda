@extends('layouts.admin')

@section('title', 'Tambah Kegiatan Baru')

@push('scripts')
<script>
    // Fungsi untuk menangani perubahan file thumbnail
    function handleThumbnailChange(input) {
        console.log('Thumbnail change triggered');
        const fileNameElement = document.getElementById('file-name');
        const preview = document.getElementById('thumbnailPreview');
        
        if (!input.files || input.files.length === 0) {
            fileNameElement.textContent = 'Tidak ada file yang dipilih';
            preview.innerHTML = '';
            return;
        }
        
        const file = input.files[0];
        fileNameElement.textContent = file.name;
        
        // Preview thumbnail
        preview.innerHTML = '';
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('h-40', 'w-auto', 'object-cover', 'mt-2', 'rounded');
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
    
    // Fungsi untuk menangani perubahan multiple files
    function handleImagesChange(input) {
        console.log('Images change triggered');
        const previewContainer = document.getElementById('image-preview-container');
        const imagesCount = document.getElementById('images-count');
        
        if (!input.files || input.files.length === 0) {
            imagesCount.textContent = 'Tidak ada file yang dipilih';
            previewContainer.innerHTML = '';
            return;
        }
        
        const files = Array.from(input.files);
        
        // Update text jumlah file yang dipilih
        if (files.length === 1) {
            imagesCount.textContent = files[0].name;
        } else {
            imagesCount.textContent = `${files.length} file dipilih (${files.map(f => f.name).join(', ')})`;
        }
        
        // Bersihkan preview container
        previewContainer.innerHTML = '';
        
        // Tampilkan preview untuk setiap file
        files.slice(0, 10).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-24 w-full object-cover rounded';
                img.title = file.name;
                
                const fileName = document.createElement('div');
                fileName.className = 'absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 truncate';
                fileName.textContent = file.name;
                
                div.appendChild(img);
                div.appendChild(fileName);
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        
        // Tampilkan indikator jika ada lebih dari 10 file
        if (files.length > 10) {
            const moreDiv = document.createElement('div');
            moreDiv.className = 'bg-gray-100 flex items-center justify-center h-24 rounded';
            moreDiv.innerHTML = `<span class="text-gray-700">+${files.length - 10} file lainnya</span>`;
            previewContainer.appendChild(moreDiv);
        }
    }
    
    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded');
        const thumbnail = document.getElementById('thumbnail');
        const images = document.getElementById('images');
        
        // Tambahkan event listener
        if (thumbnail) {
            thumbnail.addEventListener('change', function() {
                handleThumbnailChange(this);
            });
        }
        
        if (images) {
            images.addEventListener('change', function() {
                handleImagesChange(this);
            });
        }
    });
</script>
@endpush

@section('content')
<div class="py-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Tambah Kegiatan Baru</h1>
                <p class="text-sm text-gray-600">Buat kegiatan baru dan tambahkan foto-fotonya</p>
            </div>
            <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-md overflow-hidden mb-6">
            <div class="border-b border-gray-200 px-4 py-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Form Tambah Kegiatan</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="activity_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="activity_date" id="activity_date" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('activity_date') border-red-500 @enderror" value="{{ old('activity_date') }}">
                        @error('activity_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex items-center">
                            <label class="relative cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                <span>Pilih File</span>
                                <input type="file" accept="image/jpeg,image/png,image/gif" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="thumbnail" name="thumbnail" required>
                            </label>
                            <span class="ml-3 text-sm text-gray-500" id="file-name">Tidak ada file yang dipilih</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Ukuran maksimal: 2MB.</p>
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div class="mt-2" id="thumbnailPreview"></div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Alternatif (Alt Text)</label>
                        <input type="text" name="alt_text" id="alt_text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('alt_text') border-red-500 @enderror" value="{{ old('alt_text') }}">
                        <p class="mt-1 text-sm text-gray-500">Deskripsi singkat gambar untuk aksesibilitas.</p>
                        @error('alt_text')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Tambah Foto-foto</label>
                        <div class="mt-1 flex items-center">
                            <label class="relative cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                <span>Pilih Beberapa File</span>
                                <input type="file" accept="image/jpeg,image/png,image/gif" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="images" name="images[]" multiple>
                            </label>
                            <span class="ml-3 text-sm text-gray-500" id="images-count">Tidak ada file yang dipilih</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Ukuran maksimal: 2MB per foto.</p>
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="image-preview-container" class="grid grid-cols-5 gap-2 mt-3"></div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_active" name="is_active" type="checkbox" class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded" {{ old('is_active', true) ? 'checked' : '' }} value="1">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_active" class="font-medium text-gray-700">Aktif</label>
                                <p class="text-gray-500">Kegiatan akan ditampilkan di website jika diaktifkan.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-5">
                        <div class="flex justify-end">
                            <a href="{{ route('admin.activities.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection