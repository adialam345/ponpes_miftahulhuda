@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-bg"></div>
    <div class="container position-relative pt-5 pb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="animate__animated animate__fadeInLeft">
                    <h1 class="fw-bold display-5 mb-3">
                        <span class="highlight-text">Selamat Datang</span> di Pondok Pesantren Miftahul Huda
                    </h1>
                    <p class="text-gray-600 mb-4 fs-5">Menjadi lembaga pendidikan Islam yang mencetak generasi berakhlak mulia, berilmu, dan siap menghadapi tantangan masa depan.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ url('/pesantren') }}" class="btn btn-custom">Tentang Kami</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image-container animate__animated animate__fadeInRight">
                    <img src="{{ asset('images/hero-image.png') }}" alt="Santri Belajar" class="hero-image rounded-lg shadow-lg" onerror="this.onerror=null; this.src='https://source.unsplash.com/random/800x600/?islamic,school'; this.className+=' fallback-img'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News Slider Section -->
<section class="news-section py-5">
    <div class="container">
        <div class="section-header text-center mb-4">
            <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-newspaper me-2"></i>Terkini</h6>
            <h2 class="fw-bold mb-2">Berita & Pengumuman Terbaru</h2>
            <div class="title-underline mx-auto"></div>
        </div>

        @php
            $news = \App\Models\News::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get();
        @endphp

        @if($news->count() > 0)
        <!-- News Slider -->
        <div class="news-slider-container position-relative mb-4">
            <div class="swiper newsSwiper">
                <div class="swiper-wrapper">
                    @foreach($news as $item)
                    <div class="swiper-slide">
                        <a href="{{ route('news.show', $item->id) }}" class="text-decoration-none">
                            <div class="news-card">
                                @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
                                @else
                                <div class="news-image-placeholder">
                                    <i class="fas fa-newspaper fa-4x text-secondary"></i>
                                </div>
                                @endif
                                <div class="news-content">
                                    <h3 class="news-title">{{ $item->title }}</h3>
                                    <p class="news-date">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $item->published_at->format('d M Y') }}
                                    </p>
                                    <p class="news-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        @else
        <div class="text-center p-5 bg-light rounded-3 shadow-sm">
            <i class="fas fa-newspaper fa-3x text-gray-400 mb-3"></i>
            <p class="text-muted">Belum ada berita atau pengumuman terbaru.</p>
        </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('news.index') }}" class="btn btn-custom">
                <i class="fas fa-arrow-right me-2"></i>Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5 bg-light-custom">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fa fa-info-circle me-2"></i>Informasi</h6>
            <h2 class="fw-bold mb-2">Informasi Umum</h2>
            <div class="title-underline mx-auto"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4 mb-4">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-book-quran fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h5 fw-bold text-dark">Pendidikan</h3>
                        <p class="card-text text-muted">Kami menyediakan berbagai program pendidikan berbasis keislaman dengan kurikulum yang komprehensif.</p>
                        <a href="{{ url('/pendidikan') }}" class="feature-link">
                            Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-user-graduate fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h5 fw-bold text-dark">Pendaftaran</h3>
                        <p class="card-text text-muted">Informasi lengkap tentang pendaftaran santri baru dan prosedur penerimaan di pesantren kami.</p>
                        <a href="{{ url('/pendaftaran') }}" class="feature-link">
                            Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-phone fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h5 fw-bold text-dark">Kontak</h3>
                        <p class="card-text text-muted">Hubungi kami untuk informasi lebih lanjut mengenai program dan fasilitas di pondok pesantren.</p>
                        <a href="{{ url('/kontak') }}" class="feature-link">
                            Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Schedule Section -->
<section class="schedule-section py-5 bg-light-custom">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-calendar me-2"></i>Jadwal</h6>
            <h2 class="fw-bold mb-2">Program Kegiatan Unggulan</h2>
            <div class="title-underline mx-auto"></div>
            <p class="text-muted mt-3 col-md-8 mx-auto">Berikut adalah jadwal kegiatan dan program unggulan di Pondok Pesantren Miftahul Huda yang membantu mengembangkan potensi para santri.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="schedule-card card h-100 border-0 shadow-sm hover-card">
                    <div class="card-header bg-primary-custom text-white d-flex align-items-center py-3">
                        <i class="fas fa-quran me-3 fa-2x"></i>
                        <h5 class="m-0 fw-bold">Tahfidz Al-Qur'an</h5>
                    </div>
                    <div class="card-body">
                        <ul class="schedule-list">
                            <li class="d-flex mb-3">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">04:30</span>
                                    <small class="text-muted">Pagi</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Setoran Hafalan</h6>
                                    <p class="text-muted small mb-0">Setelah Sholat Subuh</p>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">15:30</span>
                                    <small class="text-muted">Sore</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Muroja'ah</h6>
                                    <p class="text-muted small mb-0">Setelah Sholat Ashar</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">20:00</span>
                                    <small class="text-muted">Malam</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Tahsin</h6>
                                    <p class="text-muted small mb-0">Setelah Sholat Isya</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="schedule-card card h-100 border-0 shadow-sm hover-card">
                    <div class="card-header bg-success text-white d-flex align-items-center py-3">
                        <i class="fas fa-book me-3 fa-2x"></i>
                        <h5 class="m-0 fw-bold">Kajian Kitab</h5>
                    </div>
                    <div class="card-body">
                        <ul class="schedule-list">
                            <li class="d-flex mb-3">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">08:00</span>
                                    <small class="text-muted">Pagi</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Fiqih</h6>
                                    <p class="text-muted small mb-0">Kitab Fathul Qarib</p>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">13:30</span>
                                    <small class="text-muted">Siang</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Hadits</h6>
                                    <p class="text-muted small mb-0">Kitab Bulughul Maram</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">19:30</span>
                                    <small class="text-muted">Malam</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Akhlak</h6>
                                    <p class="text-muted small mb-0">Kitab Ta'limul Muta'alim</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="schedule-card card h-100 border-0 shadow-sm hover-card">
                    <div class="card-header bg-warning text-dark d-flex align-items-center py-3">
                        <i class="fas fa-lightbulb me-3 fa-2x"></i>
                        <h5 class="m-0 fw-bold">Ekstrakurikuler</h5>
                    </div>
                    <div class="card-body">
                        <ul class="schedule-list">
                            <li class="d-flex mb-3">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">Selasa</span>
                                    <small class="text-muted">15:30</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Kaligrafi</h6>
                                    <p class="text-muted small mb-0">Ruang Seni</p>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">Kamis</span>
                                    <small class="text-muted">15:30</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Hadroh</h6>
                                    <p class="text-muted small mb-0">Aula Utama</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="schedule-time bg-light px-3 py-2 rounded me-3 text-center">
                                    <span class="d-block fw-bold">Sabtu</span>
                                    <small class="text-muted">08:00</small>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Olahraga</h6>
                                    <p class="text-muted small mb-0">Lapangan</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/kegiatan') }}" class="btn btn-outline-custom">
                Lihat Semua Kegiatan <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-images me-2"></i>Galeri</h6>
            <h2 class="fw-bold mb-2">Aktivitas Santri</h2>
            <div class="title-underline mx-auto"></div>
            <p class="text-muted mt-3 col-md-8 mx-auto">Melihat lebih dekat kehidupan dan aktivitas santri di Pondok Pesantren Miftahul Huda.</p>
        </div>

        <div class="row g-3">
            @php
                // Dapatkan aktivitas yang aktif dan memiliki galeri
                $activities = \App\Models\Activity::active()
                    ->ordered()
                    ->whereHas('galleries', function($query) {
                        $query->active();
                    })
                    ->with(['firstGallery', 'galleries' => function($query) {
                        $query->active()->orderBy('order', 'asc');
                    }])
                    ->withCount(['galleries' => function($query) {
                        $query->active();
                    }])
                    ->take(8)
                    ->get();
            @endphp

            @forelse($activities as $activity)
                @if($activity->firstGallery)
                <div class="col-6 col-md-4 col-lg-3 gallery-item">
                    <div class="gallery-card">
                        <img src="{{ asset('storage/' . $activity->firstGallery->image) }}" alt="{{ $activity->title }}" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <a href="{{ asset('storage/' . $activity->firstGallery->image) }}" class="gallery-icon"
                               data-fancybox="gallery-{{ $activity->id }}"
                               data-caption="{{ $activity->title }} - {{ $activity->firstGallery->title ?? 'Foto 1' }}">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <h6 class="small fw-bold mb-0">{{ $activity->title }}</h6>
                        <small class="text-muted">{{ $activity->galleries_count }} foto</small>
                    </div>
                </div>

                <!-- Hidden links for additional gallery images -->
                <div class="d-none" id="gallery-links-{{ $activity->id }}">
                @foreach($activity->galleries as $gallery)
                    @if($gallery->id !== $activity->firstGallery->id)
                    <a href="{{ asset('storage/' . $gallery->image) }}"
                       data-fancybox="gallery-{{ $activity->id }}"
                       data-type="image"
                       data-caption="{{ $activity->title }} - {{ $gallery->title ?? 'Foto ' . ($loop->iteration + 1) }}">
                       <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title ?? 'Foto ' . ($loop->iteration + 1) }}" style="display:none">
                    </a>
                    @endif
                @endforeach
                </div>
                @endif
            @empty
                <div class="col-12 text-center">
                    <div class="p-4 bg-light rounded">
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada foto dalam galeri.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('gallery.index') }}" class="btn btn-outline-custom">
                Lihat Semua Galeri <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<style>
    /* Hero Section Styles */
    .hero-section {
        overflow: hidden;
        padding: 5rem 0 4rem;
        position: relative;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: var(--light-color);
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        z-index: -1;
        background-image: url('https://source.unsplash.com/random/1600x900/?pattern,islamic');
        background-blend-mode: overlay;
        opacity: 0.1;
    }

    .hero-image-container {
        position: relative;
        padding: 1rem;
    }

    .hero-image {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: 12px;
        transition: all 0.5s ease;
    }

    .hero-image:hover {
        transform: scale(1.02);
    }

    /* Section Styling */
    .section-header {
        margin-bottom: 2rem;
    }

    .title-underline {
        height: 4px;
        width: 50px;
        background-color: var(--primary-color);
        margin-top: 10px;
        margin-bottom: 0;
    }

    /* News Slider Custom Styles */
    .news-section {
        background-color: #fff;
        padding: 4rem 0;
        overflow: hidden;
    }

    .news-slider-container {
        padding: 0;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
        overflow: visible;
    }

    .swiper {
        width: 100%;
        padding: 30px 0;
        overflow: visible;
    }

    .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 600px;
        height: 500px;
        transition: transform 0.6s ease;
    }

    .swiper-slide-active {
        transform: scale(1.1);
        z-index: 2;
    }

    .news-card {
        width: 100%;
        height: 100%;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        transform: translateY(-5px);
    }

    .news-image {
        width: 100%;
        height: 360px;
        object-fit: cover;
    }

    .news-image-placeholder {
        width: 100%;
        height: 360px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .news-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .news-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .news-date {
        font-size: 0.9rem;
        color: #718096;
        margin-bottom: 10px;
    }

    .news-excerpt {
        font-size: 1rem;
        color: #4a5568;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: var(--primary-color);
        background: rgba(255, 255, 255, 0.9);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 22px;
    }

    .swiper-pagination-bullet {
        background: var(--primary-color);
        width: 10px;
        height: 10px;
    }

    .swiper-pagination-bullet-active {
        background: var(--primary-color);
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .swiper-slide {
            width: 340px;
            height: 440px;
        }

        .news-image,
        .news-image-placeholder {
            height: 300px;
        }

        .news-title {
            font-size: 1.1rem;
        }

        .news-excerpt {
            font-size: 0.9rem;
            -webkit-line-clamp: 2;
        }

        .news-content {
            padding: 15px;
        }
    }

    /* Features Section Styles */
    .feature-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .feature-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: var(--light-color);
        border-radius: 50%;
        margin-bottom: 1rem;
    }

    .feature-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        margin-top: 1rem;
    }

    .feature-link:hover {
        color: var(--secondary-color);
        transform: translateX(5px);
    }

    /* Schedule Section Styles */
    .schedule-section {
        position: relative;
    }

    .schedule-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .schedule-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }

    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .schedule-time {
        min-width: 70px;
        font-size: 0.9rem;
    }

    .card-header {
        border-bottom: 0;
    }

    /* Gallery Section Styles */
    .gallery-section {
        background-color: #fff;
    }

    .gallery-card {
        position: relative;
        margin-bottom: 15px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .gallery-card img {
        transition: all 0.5s ease;
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }

    .gallery-card:hover img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(10, 93, 54, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-icon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 18px;
        transform: scale(0);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .gallery-card:hover .gallery-icon {
        transform: scale(1);
    }

    /* Animation for schedule cards */
    @keyframes slideInRight {
        from {
            transform: translateX(50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slide-in {
        animation: slideInRight 0.5s ease forwards;
    }

    /* Media Queries */
    @media (max-width: 767px) {
        .hero-section {
            padding: 3rem 0 2rem;
        }

        .feature-card {
            margin-bottom: 1.5rem;
        }

        .hero-image {
            max-height: 350px;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        var swiper = new Swiper(".newsSwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 2.5,
            initialSlide: 1,
            spaceBetween: -250,
            coverflowEffect: {
                rotate: 8,
                stretch: 20,
                depth: 350,
                modifier: 2,
                scale: 0.85,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1.5,
                    spaceBetween: -150
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: -200
                },
                1024: {
                    slidesPerView: 2.5,
                    spaceBetween: -250
                }
            }
        });

        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const duration = 3000; // Total animation duration in ms (3 seconds)
        const frameRate = 1000/60; // 60fps

        // Function to animate counters
        const startCounting = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const frames = duration/frameRate;
            const increment = target/frames;
            let current = 0;

            const updateCount = () => {
                if (current < target) {
                    current += increment;
                    counter.innerText = Math.min(Math.floor(current), target);
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target;
                }
            };

            counter.innerText = '0';
            requestAnimationFrame(updateCount);
        };

        // Create Intersection Observer for counters
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounting(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5 // Trigger when 50% of element is visible
        });

        // Observe all counters
        counters.forEach(counter => {
            counter.innerText = '0';
            counterObserver.observe(counter);
        });

        // Add animation classes when elements enter viewport
        const animatedElements = document.querySelectorAll('.feature-card, .stat-card');
        const animateOnScroll = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    animateOnScroll.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animatedElements.forEach(element => {
            animateOnScroll.observe(element);
        });

        // Animate schedule cards on scroll
        const scheduleCards = document.querySelectorAll('.schedule-card');
        const animateSchedules = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('animate-slide-in');
                    }, index * 150); // Staggered animation
                    animateSchedules.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        scheduleCards.forEach(card => {
            animateSchedules.observe(card);
        });

        // Animate gallery items on scroll
        const galleryItems = document.querySelectorAll('.gallery-item');
        const animateGallery = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('animate__animated', 'animate__fadeIn');
                    }, index * 100); // Staggered animation
                    animateGallery.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        galleryItems.forEach(item => {
            animateGallery.observe(item);
        });

        // Initialize Fancybox for gallery
        if (typeof Fancybox !== 'undefined') {
            Fancybox.bind("[data-fancybox]", {
                // Fancybox options
                Carousel: {
                    infinite: false,
                },
                Thumbs: {
                    autoStart: true,
                },
                Toolbar: {
                    display: [
                        { id: "prev", position: "center" },
                        { id: "counter", position: "center" },
                        { id: "next", position: "center" },
                        "zoom",
                        "slideshow",
                        "fullscreen",
                        "download",
                        "close",
                    ],
                },
            });
        }
    });
</script>
@endpush

<!-- Include Fancybox for Gallery -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
@endsection
