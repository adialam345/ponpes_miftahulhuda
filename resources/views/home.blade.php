@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-bg"></div>
    <div class="container position-relative pt-3 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="animate__animated animate__fadeInLeft">
                    <h1 class="fw-bold display-5 mb-3">
                        <span class="highlight-text">Selamat Datang</span> di Pondok Pesantren Miftahul Huda
                    </h1>
                    <p class="text-gray-600 mb-4 fs-5">Menjadi lembaga pendidikan Islam yang mencetak generasi berakhlak mulia, berilmu, dan siap menghadapi tantangan masa depan.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ url('/pesantren') }}" class="btn btn-outline-custom">Tentang Kami</a>
            </div>
        </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image-container animate__animated animate__fadeInRight">
                    <img src="{{ asset('images/hero-image.png') }}" alt="Santri Belajar" class="hero-image rounded-lg" onerror="this.onerror=null; this.src='https://source.unsplash.com/random/800x600/?islamic,school'; this.className+=' fallback-img'">
        </div>
            </div>
        </div>
            </div>
</section>

<!-- News Slider Section -->
<section class="news-section">
    <div class="container py-5">
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
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
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
                                <img src="{{ asset('storage/' . $item->image) }}" class="d-block w-100" alt="{{ $item->title }}" style="height: 500px; object-fit: cover;">
                    @else
                                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 500px;">
                                    <i class="fas fa-newspaper fa-4x text-secondary"></i>
                    </div>
                    @endif
                                <div class="carousel-caption d-none d-md-block">
                                    <h3 class="fs-4 text-white mb-2">{{ $item->title }}</h3>
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
        <div class="text-center p-5 bg-light rounded-3 shadow-sm">
            <i class="fas fa-newspaper fa-3x text-gray-400 mb-3"></i>
            <p class="text-muted">Belum ada berita atau pengumuman terbaru.</p>
        </div>
        @endif
        
        <div class="text-center mt-3">
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

<!-- Stats Section -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 mb-4 mb-md-0">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-users fa-2x text-primary-custom"></i>
                    </div>
                    <h3 class="counter fw-bold fs-2" data-target="500">0</h3>
                    <p class="stat-title text-muted">Jumlah Pengunjung</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4 mb-md-0">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-chalkboard-teacher fa-2x text-primary-custom"></i>
                    </div>
                    <h3 class="counter fw-bold fs-2" data-target="50">0</h3>
                    <p class="stat-title text-muted">Tenaga Pengajar</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-building fa-2x text-primary-custom"></i>
                    </div>
                    <h3 class="counter fw-bold fs-2" data-target="10">0</h3>
                    <p class="stat-title text-muted">Gedung Fasilitas</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-award fa-2x text-primary-custom"></i>
                    </div>
                    <h3 class="counter fw-bold fs-2" data-target="20">0</h3>
                    <p class="stat-title text-muted">Tahun Berdiri</p>
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
                    ->with(['galleries' => function($query) {
                        $query->active()
                              ->orderBy('order', 'asc')
                              ->limit(1);
                    }])
                    ->withCount(['galleries' => function($query) {
                        $query->active();
                    }])
                    ->take(8)
                    ->get();

                // Eager load remaining images for fancybox
                $activityIds = $activities->pluck('id');
                $otherImages = \App\Models\Gallery::whereIn('activity_id', $activityIds)
                    ->where('is_active', true)
                    ->orderBy('order', 'asc')
                    ->get()
                    ->groupBy('activity_id');
            @endphp
            
            @forelse($activities as $activity)
                @if($activity->galleries->isNotEmpty())
                <div class="col-6 col-md-4 col-lg-3 gallery-item">
                    <div class="gallery-card">
                        <img src="{{ asset('storage/' . $activity->galleries->first()->image) }}" alt="{{ $activity->title }}" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <a href="{{ asset('storage/' . $activity->galleries->first()->image) }}" class="gallery-icon" 
                               data-fancybox="gallery-{{ $activity->id }}" 
                               data-caption="{{ $activity->title }} - {{ $activity->galleries->first()->title ?? 'Foto 1' }}">
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
                @foreach($otherImages[$activity->id] ?? [] as $otherImage)
                    @if($otherImage->id !== $activity->galleries->first()->id)
                    <a href="{{ asset('storage/' . $otherImage->image) }}" 
                       data-fancybox="gallery-{{ $activity->id }}" 
                       data-type="image"
                       data-caption="{{ $activity->title }} - {{ $otherImage->title ?? 'Foto ' . ($loop->iteration + 1) }}">
                       <img src="{{ asset('storage/' . $otherImage->image) }}" alt="{{ $otherImage->title ?? 'Foto ' . ($loop->iteration + 1) }}" style="display:none">
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
        padding: 3rem 0 2rem;
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
        margin-bottom: 3rem;
    }
    
    .title-underline {
        height: 4px;
        width: 50px;
        background-color: var(--primary-color);
        margin-top: 15px;
    }
    
    /* News Slider Custom Styles */
    .news-section {
        background-color: #fff;
    }
    
    .news-slider-container {
        margin-bottom: 2rem;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
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
        background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 80%, transparent 100%);
        border-radius: 0 0 8px 8px;
        text-align: left;
    }
    
    /* Make carousel indicators more visible */
    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 6px;
        margin-left: 6px;
        background-color: var(--primary-color);
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    
    .carousel-indicators .active {
        opacity: 1;
        transform: scale(1.2);
    }
    
    /* Carousel controls styling */
    .carousel-control-prev, .carousel-control-next {
        width: 10%;
        opacity: 0.7;
        z-index: 10;
    }
    
    .carousel-control-prev:hover, .carousel-control-next:hover {
        opacity: 1;
    }
    
    .carousel-item a {
        cursor: pointer;
        display: block;
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }
    
    .carousel-item a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.2);
        z-index: 1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .carousel-item a:hover::before {
        opacity: 1;
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
    
    /* Stats Section Styles */
    .stats-section {
        padding: 4rem 0;
        background-color: #fff;
    }
    
    .stat-card {
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.2);
    }
    
    .stat-icon {
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .counter {
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }
    
    /* Media Queries */
    @media (max-width: 767px) {
        .carousel-item img, .carousel-item .bg-light {
            height: 300px !important;
        }
        
        .hero-section {
            padding: 2rem 0 1rem;
        }
        
        .feature-card {
            margin-bottom: 1.5rem;
        }
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
    
    /* Hero Parallax Effect */
    .hero-section {
        overflow: hidden;
        padding: 4rem 0 3rem;
        position: relative;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
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
    
    /* Fancybox Custom Styles */
    .fancybox__container {
        --fancybox-bg: rgba(0, 0, 0, 0.9);
    }
    
    .fancybox__nav {
        --carousel-button-bg: rgba(0, 0, 0, 0.5);
        --carousel-button-svg-width: 24px;
        --carousel-button-svg-height: 24px;
        --carousel-button-svg-stroke-width: 2.5;
    }
    
    .fancybox__nav .carousel__button {
        visibility: visible;
        opacity: 0.7;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        width: 48px;
        height: 48px;
    }
    
    .fancybox__nav .carousel__button:hover {
        opacity: 1;
        background-color: rgba(0, 0, 0, 0.8);
    }
    
    .fancybox__thumbs {
        background-color: rgba(0, 0, 0, 0.3);
    }
    
    /* Ensure images are properly loaded in fancybox */
    .fancybox__content img {
        display: block;
        max-width: 100%;
        max-height: 100%;
    }
    
    .fancybox__slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    /* Loading indicator for images */
    .fancybox-loading {
        border: 6px solid rgba(100, 100, 100, 0.4);
        border-top: 6px solid var(--primary-color);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: fancybox-rotate 1s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -25px;
        margin-left: -25px;
        z-index: 99999;
    }
    
    @keyframes fancybox-rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
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
        
        // Simple animation for counter numbers
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(counter => {
            const target = +counter.innerText;
            const increment = target / 20;
            
            const updateCounter = () => {
                const count = +counter.innerText.replace(/,/g, '');
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCounter, 100);
                } else {
                    counter.innerText = target;
                }
            };
            
            counter.innerText = '0';
            
            // Start counter animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counter);
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
        let delay = 0;
        
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
    });
</script>

<!-- Include Fancybox for Gallery -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="{{ asset('js/custom-gallery.js') }}"></script>

<script>
// Debugging helper untuk FancyBox
document.addEventListener('DOMContentLoaded', function() {
    // Log ketika FancyBox tersedia
    if (typeof Fancybox !== 'undefined') {
        console.log("FancyBox tersedia di halaman");
        
        // Tambahkan class untuk memastikan link terdeteksi dengan benar
        document.querySelectorAll('[data-fancybox]').forEach(function(el) {
            el.classList.add('fancybox-enabled');
        });
        
        // Event listener untuk debugging
        document.querySelectorAll('.gallery-card .gallery-icon').forEach(link => {
            link.addEventListener('click', function(e) {
                const galleryId = this.getAttribute('data-fancybox');
                console.log("Mengklik galeri:", galleryId);
                
                // Hitung jumlah gambar dalam galeri ini
                const totalImages = document.querySelectorAll(`[data-fancybox="${galleryId}"]`).length;
                console.log(`Galeri ${galleryId} berisi ${totalImages} gambar`);
                
                // Log semua URL gambar untuk debugging
                const imageUrls = [];
                document.querySelectorAll(`[data-fancybox="${galleryId}"]`).forEach(item => {
                    imageUrls.push(item.getAttribute('href'));
                });
                console.log("URLs gambar dalam galeri:", imageUrls);
                
                // Coba untuk me-reset FancyBox jika ada masalah
                if (totalImages > 0 && typeof Fancybox.show === 'function') {
                    console.log("FancyBox.show tersedia");
                } else {
                    console.error("FancyBox.show tidak tersedia atau tidak ada gambar");
                }
            });
        });
        
        // Inisialisasi alternatif jika script utama gagal
        setTimeout(function() {
            // Cek apakah FancyBox sudah berjalan dengan benar
            if (typeof window.initFancyBox === 'function') {
                console.log("Mencoba inisialisasi FancyBox alternatif");
                window.initFancyBox();
            } else {
                console.log("FancyBox helper tidak tersedia");
                
                // Jika helper tidak tersedia, gunakan metode langsung sederhana
                document.querySelectorAll('.gallery-card .gallery-icon').forEach(function(el) {
                    el.addEventListener('click', function(e) {
                        e.preventDefault();
                        const galleryId = this.getAttribute('data-fancybox');
                        
                        // Kumpulkan semua gambar dengan galleryId yang sama
                        const images = [];
                        document.querySelectorAll(`[data-fancybox="${galleryId}"]`).forEach(item => {
                            images.push({
                                src: item.getAttribute('href'),
                                caption: item.getAttribute('data-caption') || ''
                            });
                        });
                        
                        // Cari indeks gambar yang diklik
                        const currentSrc = this.getAttribute('href');
                        let startIndex = 0;
                        for (let i = 0; i < images.length; i++) {
                            if (images[i].src === currentSrc) {
                                startIndex = i;
                                break;
                            }
                        }
                        
                        // Buka galeri dengan Fancybox API
                        try {
                            Fancybox.show(images, {
                                startIndex: startIndex
                            });
                        } catch (error) {
                            console.error("Error membuka FancyBox:", error);
                            alert("Maaf, ada masalah membuka galeri. Silakan coba lagi.");
                        }
                    });
                });
            }
        }, 1000); // Tunggu 1 detik setelah page load
    } else {
        console.error("FancyBox tidak tersedia di halaman");
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    const duration = 3000; // Durasi total animasi dalam ms (2 detik)
    const frameRate = 1000/60; // 60fps

    // Fungsi untuk menjalankan animasi counter
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

    // Buat Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // Jika elemen terlihat di viewport
            if (entry.isIntersecting) {
                startCounting(entry.target);
                // Hentikan observasi setelah animasi dimulai
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5 // Trigger ketika 50% elemen terlihat
    });

    // Observe semua counter
    counters.forEach(counter => {
        counter.innerText = '0';
        observer.observe(counter);
    });
});
</script>
@endsection
