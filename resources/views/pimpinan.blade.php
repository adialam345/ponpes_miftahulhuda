@extends('layouts.app')

@section('title', 'Pimpinan - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="page-hero-section position-relative">
    <div class="hero-bg"></div>
    <div class="container position-relative py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center animate__animated animate__fadeInUp">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-user-tie me-2"></i>Profil</h6>
                <h1 class="fw-bold display-5 mb-3">
                    <span class="highlight-text">Pimpinan</span> Pesantren
                </h1>
                <p class="text-gray-600 mb-0 fs-5">Mengenal sosok pemimpin yang membangun dan mengembangkan Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>
    </div>
</section>

<!-- Profile Section -->
<section class="profile-section py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="profile-image-container animate__animated animate__fadeInLeft">
                    <img src="{{ asset('images/kyai-placeholder.jpg') }}" alt="Pimpinan Pesantren" class="profile-image rounded-lg w-100" onerror="this.onerror=null; this.src='https://source.unsplash.com/random/600x800/?islamic,scholar'; this.className+=' fallback-img'">
                </div>
            </div>
            <div class="col-lg-7 animate__animated animate__fadeInRight">
                <h2 class="fw-bold mb-4">KH. Dr. Imam Mudhofir,. S.Pd., M.Pd</h2>
                <div class="title-underline mb-4"></div>
                <p class="mb-3">KH. Dr. Imam Mudhofir,. S.Pd., M.Pd adalah sosok pemimpin yang kharismatik dan berwawasan luas. Beliau telah memimpin Pondok Pesantren Miftahul Huda selama lebih dari 20 tahun, menjadikannya salah satu pesantren terkemuka di daerah ini.</p>
                <p class="mb-3">Dengan latar belakang pendidikan yang kuat dari berbagai pesantren terkenal di Indonesia, beliau memiliki pemahaman mendalam tentang ilmu-ilmu keislaman dan pendidikan modern.</p>
                <p class="mb-4">Di bawah kepemimpinannya, Pondok Pesantren Miftahul Huda telah berkembang pesat dan terus berinovasi dalam metode pendidikan, sambil tetap menjaga nilai-nilai tradisional pesantren.</p>
                
                <h4 class="fw-bold mb-3">Riwayat Pendidikan</h4>
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-graduation-cap text-primary-custom me-3"></i>
                        <span>Pondok Pesantren Tebuireng, Jombang (1980-1987)</span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-graduation-cap text-primary-custom me-3"></i>
                        <span>Universitas Al-Azhar, Kairo - Fakultas Syariah (1987-1992)</span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-graduation-cap text-primary-custom me-3"></i>
                        <span>Pondok Pesantren Lirboyo, Kediri (1992-1995)</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Vision & Mission -->
        <div class="row mt-5 pt-3">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card feature-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-eye fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h4 fw-bold text-dark">Visi Pimpinan</h3>
                        <p class="card-text">Menjadikan Pondok Pesantren Miftahul Huda sebagai pusat pendidikan Islam yang menghasilkan generasi Muslim berkualitas, berakhlak mulia, dan siap menghadapi tantangan global dengan tetap menjunjung tinggi nilai-nilai Islam.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card feature-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-bullseye fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h4 fw-bold text-dark">Misi Pimpinan</h3>
                        <ul class="ps-3">
                            <li class="mb-2">Menyelenggarakan pendidikan Islam berkualitas dengan metode modern</li>
                            <li class="mb-2">Membina karakter santri dengan akhlakul karimah</li>
                            <li class="mb-2">Mengembangkan program pendidikan yang relevan dengan kebutuhan zaman</li>
                            <li>Memberikan kontribusi positif kepada masyarakat sekitar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-section py-5 bg-light-custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-quote-left me-2"></i>Testimoni</h6>
                <h2 class="fw-bold mb-2">Kata Mereka Tentang Pimpinan</h2>
                <div class="title-underline mx-auto"></div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="testimonial-icon mb-3">
                            <i class="fas fa-user-circle fa-3x text-primary-custom opacity-50"></i>
                        </div>
                        <p class="card-text fst-italic mb-3">"Kyai Abdul Ghofur adalah sosok yang sangat inspiratif. Beliau tidak hanya mengajarkan ilmu, tetapi juga memberikan teladan dalam kehidupan sehari-hari."</p>
                        <h5 class="testimonial-name mb-1">Ust. Ahmad Syafii</h5>
                        <p class="small text-muted">Pengajar Senior</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="testimonial-icon mb-3">
                            <i class="fas fa-user-circle fa-3x text-primary-custom opacity-50"></i>
                        </div>
                        <p class="card-text fst-italic mb-3">"Berkat bimbingan Kyai Abdul Ghofur, saya bisa menjadi pribadi yang lebih baik. Beliau selalu sabar menghadapi santri dan memberikan nasihat yang bijaksana."</p>
                        <h5 class="testimonial-name mb-1">Muhammad Rizki</h5>
                        <p class="small text-muted">Alumni Angkatan 2018</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="testimonial-icon mb-3">
                            <i class="fas fa-user-circle fa-3x text-primary-custom opacity-50"></i>
                        </div>
                        <p class="card-text fst-italic mb-3">"Kyai Abdul Ghofur memiliki visi yang jauh ke depan. Beliau berhasil memadukan nilai-nilai tradisional pesantren dengan pendidikan modern yang sangat dibutuhkan santri."</p>
                        <h5 class="testimonial-name mb-1">Hj. Siti Aisyah</h5>
                        <p class="small text-muted">Wali Santri</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Hero Section Styles */
    .page-hero-section {
        overflow: hidden;
        padding: 4rem 0;
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
    
    /* Profile Styles */
    .profile-image {
        max-height: 500px;
        object-fit: cover;
        transition: all 0.5s ease;
    }
    
    .title-underline {
        height: 4px;
        width: 50px;
        background-color: var(--primary-color);
        margin-top: 5px;
    }
    
    /* Testimonial Styles */
    .testimonial-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }
    
    .testimonial-name {
        color: var(--primary-color);
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation classes when elements enter viewport
        const animatedElements = document.querySelectorAll('.feature-card, .testimonial-card');
        
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