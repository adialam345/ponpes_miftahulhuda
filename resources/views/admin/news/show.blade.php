@extends('layouts.admin')

@section('title', 'Detail Berita - Admin')

@section('content')
<div class="container py-4">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Detail Berita</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.news.edit', $news->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('admin.news.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $news->title }}</h2>
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <div>
                        <i class="fas fa-calendar-alt mr-1"></i> Dibuat: {{ $news->created_at->format('d M Y H:i') }}
                    </div>
                    @if($news->published_at)
                    <div>
                        <i class="fas fa-paper-plane mr-1"></i> Dipublikasikan: {{ $news->published_at->format('d M Y H:i') }}
                    </div>
                    @endif
                    <div>
                        @if($news->status == 'published')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Dipublikasikan
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Draft
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            @if($news->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full max-h-96 object-cover rounded">
            </div>
            @endif

            <div class="prose max-w-none">
                {!! nl2br(e($news->content)) !!}
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-3">Tindakan</h3>
        <div class="flex space-x-3">
            <a href="{{ route('admin.news.edit', $news->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-edit mr-1"></i> Edit Berita
            </a>
            <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded">
                    <i class="fas fa-trash mr-1"></i> Hapus Berita
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 