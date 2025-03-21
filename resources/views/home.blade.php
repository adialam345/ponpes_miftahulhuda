@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Miftahul Huda')

@section('content')
<div class="container pt-2 pb-4 content-wrapper">
    <div class="text-center mb-3">
        <h1 class="text-green-700 fw-bold display-5 display-md-4">Selamat Datang di Pondok Pesantren Miftahul Huda</h1>
        <p class="text-gray-600 mt-2 fs-6 fs-md-5">Menjadi lembaga pendidikan Islam yang mencetak generasi berakhlak mulia dan berilmu.</p>
    </div>

    <!-- Berita Terbaru dengan Slider -->
    <div class="mt-3">
        <h2 class="text-green-700 text-center fw-bold mb-2 mb-md-3 fs-3">Berita & Pengumuman Terbaru</h2>
        
        @php
            $news = \App\Models\News::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get();
        @endphp

        @if($news->count() > 0)
        <!-- News Slider -->
        <div class="news-slider-container position-relative mb-3 d-flex justify-content-center">
            <div id="newsCarousel" class="carousel slide" style="width: 1300px; max-width: 100%;" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($news as $index => $item)
                        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                
                <div class="carousel-inner rounded-3 shadow-lg">
                    @foreach($news as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="6000">
                        <a href="{{ route('news.show', $item->id) }}" class="text-decoration-none">
                            <div class="position-relative">
                                @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="d-block w-100" alt="{{ $item->title }}" style="height: 600px; object-fit: cover;">
                                @else
                                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 600px;">
                                    <i class="fas fa-newspaper fa-4x text-secondary"></i>
                                </div>
                                @endif
                                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-3">
                                    <h3 class="fs-4 text-white">{{ $item->title }}</h3>
                                    <p class="small mb-2 text-white">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $item->published_at->format('d M Y') }}
                                    </p>
                                    <p class="text-white">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}</p>
                                </div>
                                <!-- Mobile Caption (visible on small screens) -->
                                <div class="d-md-none position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 p-3 text-white">
                                    <h5 class="fs-6">{{ $item->title }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        
        @else
        <div class="text-center">
            <p class="text-muted">Belum ada berita atau pengumuman terbaru.</p>
        </div>
        @endif
        
        <div class="text-center mt-2">
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

<style>
    /* News Slider Custom Styles */
    .news-slider-container {
        margin-bottom: 2rem;
    }
    
    .carousel-item img {
        width: 100%;
        border-radius: 8px;
    }
    
    .carousel-caption {
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 0 0 8px 8px;
    }
    
    /* Make carousel indicators more visible */
    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 6px;
        margin-left: 6px;
    }
    
    /* Carousel controls styling */
    .carousel-control-prev, .carousel-control-next {
        width: 5%;
        opacity: 0.8;
        z-index: 10;
    }
    
    .carousel-control-prev:hover, .carousel-control-next:hover {
        opacity: 1;
    }
    
    .carousel-item a {
        cursor: pointer;
        display: block;
        position: relative;
    }
    
    .carousel-item a:hover:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 100, 0, 0.1);
        border-radius: 8px;
    }
    
    @media (max-width: 767px) {
        .carousel-item img, .carousel-item .bg-light {
            height: 300px !important;
        }
    }
    
    @media (max-width: 820px) {
        #newsCarousel {
            width: 100% !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the Bootstrap carousel with auto-play
        var newsCarousel = new bootstrap.Carousel(document.getElementById('newsCarousel'), {
            interval: 6000,  // 6 seconds per slide
            wrap: true,      // Continuous loop
            keyboard: true,  // Allow keyboard navigation
            pause: 'hover'   // Pause on mouse hover
        });
    });
</script>
@endsection
