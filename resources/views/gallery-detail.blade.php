@extends('layouts.app')

@section('title', $activity->title . ' - Galeri Foto - Pondok Pesantren Miftahul Huda')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Galeri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $activity->title }}</li>
                    </ol>
                </nav>
                
                <div class="text-center mb-4">
                    <h2 class="section-heading">{{ $activity->title }}</h2>
                    @if($activity->activity_date)
                    <div class="text-muted">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $activity->activity_date->format('d F Y') }}
                    </div>
                    @endif
                    <hr class="my-4">
                    
                    @if($activity->description)
                    <div class="row mb-4">
                        <div class="col-lg-8 mx-auto">
                            <p class="lead text-muted">{{ $activity->description }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="row gallery-container">
            @forelse($activity->galleries as $index => $gallery)
            <div class="col-6 col-md-4 col-lg-3 mb-4 gallery-item">
                <div class="gallery-card">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" class="img-fluid rounded">
                    <div class="gallery-overlay">
                        <a href="{{ asset('storage/' . $gallery->image) }}" 
                           class="gallery-icon" 
                           data-fancybox="gallery-detail" 
                           data-type="image"
                           data-caption="{{ $activity->title }} - {{ $gallery->title ?? 'Foto ' . ($index + 1) }}"
                           id="gallery-detail-image-{{ $index }}">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <h6 class="small fw-bold mb-0">{{ $gallery->title }}</h6>
                    @if($gallery->description)
                    <small class="text-muted">{{ \Illuminate\Support\Str::limit($gallery->description, 50) }}</small>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    Belum ada foto dalam galeri untuk kegiatan ini.
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5 text-center">
            <a href="{{ route('gallery.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Galeri Utama
            </a>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
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
    
    /* Animation for gallery items */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .gallery-item {
        animation: fadeIn 0.6s ease forwards;
        opacity: 0;
    }
    
    /* Staggered animation for gallery items */
    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.2s; }
    .gallery-item:nth-child(3) { animation-delay: 0.3s; }
    .gallery-item:nth-child(4) { animation-delay: 0.4s; }
    .gallery-item:nth-child(5) { animation-delay: 0.5s; }
    .gallery-item:nth-child(6) { animation-delay: 0.6s; }
    .gallery-item:nth-child(7) { animation-delay: 0.7s; }
    .gallery-item:nth-child(8) { animation-delay: 0.8s; }
    .gallery-item:nth-child(9) { animation-delay: 0.9s; }
    .gallery-item:nth-child(10) { animation-delay: 1s; }
    .gallery-item:nth-child(11) { animation-delay: 1.1s; }
    .gallery-item:nth-child(12) { animation-delay: 1.2s; }
</style>
@endsection

@section('scripts')
<!-- Include Fancybox -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="{{ asset('js/custom-gallery.js') }}"></script>
<script src="{{ asset('js/fancybox-init.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debugging helper untuk FancyBox
    if (typeof Fancybox !== 'undefined') {
        console.log("FancyBox tersedia di halaman detail galeri");
        
        // Tambahkan class untuk memastikan link terdeteksi dengan benar
        document.querySelectorAll('[data-fancybox]').forEach(function(el) {
            el.classList.add('fancybox-enabled');
        });
        
        // Coba gunakan initFancyBox helper jika tersedia
        if (typeof window.initFancyBox === 'function') {
            window.initFancyBox();
        }
        
        // Fallback jika helper tidak berfungsi
        setTimeout(function() {
            console.log("Memeriksa apakah FancyBox perlu inisialisasi ulang pada halaman detail");
            // Tambahkan event listener kustom ke setiap tombol galeri
            document.querySelectorAll('.gallery-icon').forEach(function(el) {
                el.addEventListener('click', function(e) {
                    console.log("Tombol galeri diklik:", this.id);
                });
            });
        }, 1000);
    } else {
        console.error("FancyBox tidak tersedia di halaman detail galeri");
    }
    
    // Animasi item galeri saat masuk viewport
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    galleryItems.forEach((item) => {
        observer.observe(item);
    });
});
</script>
@endsection 