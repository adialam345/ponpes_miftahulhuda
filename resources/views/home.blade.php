@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Miftahul Huda')

@section('content')
<div class="container py-4 content-wrapper">
    <div class="text-center">
        <h1 class="text-green-700 fw-bold display-5 display-md-4">Selamat Datang di Pondok Pesantren Miftahul Huda</h1>
        <p class="text-gray-600 mt-3 fs-6 fs-md-5">Menjadi lembaga pendidikan Islam yang mencetak generasi berakhlak mulia dan berilmu.</p>
    </div>

    <!-- Berita Terbaru -->
    <div class="mt-4 mt-md-5">
        <h2 class="text-green-700 text-center fw-bold mb-3 mb-md-4 fs-3">Berita & Pengumuman Terbaru</h2>
        <div class="row g-3 g-md-4">
            @php
                $news = \App\Models\News::where('status', 'published')
                    ->orderBy('published_at', 'desc')
                    ->take(3)
                    ->get();
            @endphp

            @forelse($news as $item)
            <div class="col-12 col-md-4 mb-3">
                <div class="card h-100 shadow">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="bg-light text-center py-4 py-md-5">
                        <i class="fas fa-newspaper fa-3x text-secondary"></i>
                    </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fs-5">{{ $item->title }}</h5>
                        <p class="card-text text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $item->published_at->format('d M Y') }}
                        </p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}</p>
                        <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm btn-outline-success mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada berita atau pengumuman terbaru.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-3 mt-md-4">
            <a href="{{ route('news.index') }}" class="btn btn-success">Lihat Semua Berita</a>
        </div>
    </div>

    <div class="mt-4 mt-md-5 row g-3 g-md-4 text-center">
        <div class="col-12 col-md-4 mb-3">
            <div class="bg-white p-3 p-md-4 shadow rounded h-100">
                <h3 class="text-green-700 fw-semibold fs-4">Pendidikan</h3>
                <p class="text-gray-600 mt-2">Kami menyediakan berbagai program pendidikan berbasis keislaman.</p>
                <a href="{{ url('/pendidikan') }}" class="text-green-600 fw-bold d-block mt-3">Selengkapnya</a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="bg-white p-3 p-md-4 shadow rounded h-100">
                <h3 class="text-green-700 fw-semibold fs-4">Pendaftaran</h3>
                <p class="text-gray-600 mt-2">Informasi pendaftaran santri baru dan prosedur penerimaan.</p>
                <a href="{{ url('/pendaftaran') }}" class="text-green-600 fw-bold d-block mt-3">Selengkapnya</a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="bg-white p-3 p-md-4 shadow rounded h-100">
                <h3 class="text-green-700 fw-semibold fs-4">Kontak</h3>
                <p class="text-gray-600 mt-2">Hubungi kami untuk informasi lebih lanjut mengenai pondok pesantren.</p>
                <a href="{{ url('/kontak') }}" class="text-green-600 fw-bold d-block mt-3">Selengkapnya</a>
            </div>
        </div>
    </div>
</div>
@endsection
