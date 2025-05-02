@extends('layouts.app')

@section('title', 'Galeri Foto - Pondok Pesantren Miftahul Huda')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Galeri Foto</h2>
                <h3 class="section-subheading text-muted">Kegiatan dan Aktivitas Santri</h3>
                <hr class="my-4">
            </div>
        </div>
        
        <!-- Gallery Activities Grid -->
        <div class="row g-4">
            @forelse($activities as $activity)
                @if($activity->thumbnailGallery)
                <div class="col-6 col-md-4 col-lg-3 gallery-item">
                    <a href="{{ route('gallery.show', $activity->id) }}" class="text-decoration-none">
                        <div class="gallery-card">
                            <img src="{{ asset('storage/' . $activity->thumbnailGallery->image) }}" alt="{{ $activity->title }}" class="img-fluid rounded">
                            <div class="gallery-overlay">
                                <div class="gallery-view">
                                    <i class="fas fa-images me-1"></i> Lihat Album
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center mt-2">
                            <h5 class="card-title fs-6 mb-1">{{ $activity->title }}</h5>
                            <div class="text-muted small">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $activity->activity_date ? $activity->activity_date->format('d F Y') : '' }}
                            </div>
                            <div class="mt-1 badge bg-primary-custom">
                                <i class="fas fa-images me-1"></i> {{ $activity->galleries_count }} foto
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            @empty
            <!-- No activities -->
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    Belum ada foto dalam galeri saat ini.
                </div>
            </div>
            @endforelse
        </div>
        
        @if($activities->count() == 0)
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    Belum ada foto dalam galeri saat ini.
                </div>
            </div>
        </div>
        @endif
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
        aspect-ratio: 1 / 1;
    }
    
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    .gallery-card img {
        transition: all 0.5s ease;
        width: 100%;
        height: 100%;
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
    
    .gallery-view {
        background: white;
        color: var(--primary-color);
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        transform: scale(0);
        transition: all 0.3s ease;
    }
    
    .gallery-card:hover .gallery-view {
        transform: scale(1);
    }
    
    .bg-primary-custom {
        background-color: var(--primary-color);
        color: white;
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
<script>
document.addEventListener('DOMContentLoaded', function() {
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