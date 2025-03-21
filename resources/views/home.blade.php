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
            <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-star me-2"></i>Keunggulan</h6>
            <h2 class="fw-bold mb-2">Program Unggulan Kami</h2>
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
                    <h3 class="counter fw-bold fs-2">500</h3>
                    <p class="stat-title text-muted">Jumlah Pengunjung</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4 mb-md-0">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-chalkboard-teacher fa-2x text-primary-custom"></i>
                    </div>
                    <h3 class="counter fw-bold fs-2">50</h3>
                    <p class="stat-title text-muted">Tenaga Pengajar</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-building fa-2x text-primary-custom"></i>
                    </div>
                    <h3 class="counter fw-bold fs-2">10</h3>
                    <p class="stat-title text-muted">Gedung Fasilitas</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-award fa-2x text-primary-custom"></i>
                    </div>
                    <h3 class="counter fw-bold fs-2">20</h3>
                    <p class="stat-title text-muted">Tahun Berdiri</p>
        </div>
            </div>
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
    });
</script>
@endsection
