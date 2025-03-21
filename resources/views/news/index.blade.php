@extends('layouts.app')

@section('title', 'Berita & Pengumuman - Pondok Pesantren Miftahul Huda')

@section('content')
<div class="container pt-2 pb-4" style="margin-top: 0px;">
    <div class="text-center mb-3">
        <h1 class="text-green-700 fw-bold display-5">Berita & Pengumuman</h1>
        <p class="text-gray-600">Informasi terbaru dari Pondok Pesantren Miftahul Huda</p>
    </div>

    <div class="row">
        @forelse($news as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="bg-light text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-secondary"></i>
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text text-muted small">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $item->published_at->format('d M Y') }}
                    </p>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}</p>
                    <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm btn-outline-success mt-auto">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-4">
            <i class="fas fa-newspaper fa-3x text-gray-400 mb-3"></i>
            <p class="text-muted">Belum ada berita atau pengumuman terbaru.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $news->links() }}
    </div>
</div>
@endsection 