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
                <label for="content" class="block text-sm font-medium text-gray-700">Konten Berita</label>
                <textarea name="content" id="content" rows="6" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content') }}</textarea>
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
                <p class="text-gray-500 text-xs mt-1">Format: JPEG, PNG, JPG, GIF. Ukuran maksimum: 2MB.</p>
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
@endsection 