@extends('layouts.app')

@section('title', 'Kontak & Alamat - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="page-hero-section position-relative">
    <div class="hero-bg"></div>
    <div class="container position-relative py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center animate__animated animate__fadeInUp">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-map-marker-alt me-2"></i>Informasi</h6>
                <h1 class="fw-bold display-5 mb-3">
                    <span class="highlight-text">Kontak</span> & Alamat
                </h1>
                <p class="text-gray-600 mb-0 fs-5">Informasi kontak dan lokasi Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="contact-info-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="contact-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="contact-icon mb-3 mx-auto">
                            <i class="fas fa-map-marked-alt fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="contact-title h4 fw-bold mb-3">Alamat</h3>
                        <p class="mb-0">Jl. Wisata Tani Gang Pesantren No. 1<br>RT.29/RW.04, Desa Doho<br>Kecamatan Dolopo<br>Kabupaten Madiun, Jawa Timur 63174</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="contact-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="contact-icon mb-3 mx-auto">
                            <i class="fas fa-phone-alt fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="contact-title h4 fw-bold mb-3">Telepon</h3>
                        <p class="mb-2"><strong>WhatsApp Admin:</strong> +62 822-6081-2597</p>
                        <p class="mb-0"><strong>Pengasuh:</strong> +62 821-4385-5976</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="contact-icon mb-3 mx-auto">
                            <i class="fas fa-envelope fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="contact-title h4 fw-bold mb-3">Email & Media Sosial</h3>
                        <p class="mb-3"><strong>Email:</strong> miftahulhuda.doho@gmail.com</p>
                        <div class="social-links">
                            <a href="https://www.facebook.com/ponpesmiftahul.hudadoho.5/?locale=id_ID" class="social-link" title="Facebook" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/pondok.doho?utm_source=ig_web_button_share_sheet&amp;igsh=ZDNlZDc0MzIxNw==" class="social-link" title="Instagram" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/@pondokdoho-ponpesmiftahulh5066" class="social-link" title="YouTube" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="https://www.tiktok.com/@miftahulhuda.doho?is_from_webapp=1&sender_device=pc" class="social-link" title="Tiktok" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section py-5 bg-light-custom">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-directions me-2"></i>Lokasi</h6>
                <h2 class="fw-bold mb-2">Peta Lokasi Pesantren</h2>
                <div class="title-underline mx-auto mb-4"></div>
                <p class="text-muted mb-0">Temukan lokasi kami dengan mudah menggunakan peta di bawah ini</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="map-container rounded-lg shadow-sm p-2 bg-white">
                    <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.18734914186!2d111.50891517575458!3d-7.769948192249411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a2fa84ad929d%3A0x3d2178186495597!2sPondok%20Pesantren%20Miftahul%20Huda%20Doho!5e0!3m2!1sid!2sid!4v1746159464197!5m2!1sid!2sid" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-paper-plane me-2"></i>Hubungi Kami</h6>
                <h2 class="fw-bold mb-2">Kirim Pesan</h2>
                <div class="title-underline mx-auto mb-4"></div>
                <p class="text-muted mb-0">Silakan isi formulir di bawah ini untuk mengirim pesan atau pertanyaan kepada kami</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-container card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <form action="#" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="tel" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="subject" class="form-label fw-semibold">Subjek</label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="message" class="form-label fw-semibold">Pesan</label>
                                        <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-custom px-5 py-2">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
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

    /* Section Styling */
    .title-underline {
        height: 4px;
        width: 50px;
        background-color: var(--primary-color);
        margin-top: 5px;
    }

    /* Contact Card Styles */
    .contact-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .contact-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background-color: var(--light-color);
        border-radius: 50%;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .contact-card:hover .contact-icon {
        background-color: var(--primary-color);
        color: white;
    }

    /* Social Links */
    .social-links {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: var(--light-color);
        color: var(--primary-color);
        border-radius: 50%;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }

    .social-link:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-3px);
    }

    /* Form Styling */
    .contact-form-container {
        border-radius: 12px;
    }

    .form-control {
        padding: 0.75rem;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(10, 93, 54, 0.15);
    }
    .btn-custom {
        background-color: var(--primary-color);
        color: white;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background-color: var(--primary-color-dark);
        transform: translateY(-3px);
    }
    /* Map Section */
    .map-container {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    .map-container iframe {
        border-radius: 12px;
    }
    .map-container .ratio {
        overflow: hidden;
        border-radius: 12px;
    }
    .map-container .ratio iframe {
        border-radius: 12px;
    }
    /* Responsive Styles */
    @media (max-width: 768px) {
        .contact-card {
            margin-bottom: 20px;
        }
        .contact-form-container {
            padding: 2rem;
        }
    }
    @media (max-width: 576px) {
        .contact-card {
            margin-bottom: 15px;
        }
        .contact-form-container {
            padding: 1.5rem;
        }
    }
    /* Animation */
    .animate__animated {
        visibility: hidden;
    }
    .animate__animated.animate__fadeInUp {
        visibility: visible;
        animation-duration: 1s;
        animation-fill-mode: both;
    }
    .animate__animated.animate__fadeInUp {
        animation-name: fadeInUp;
    }
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translate3d(0, 100%, 0);
        }
        100% {
            opacity: 1;
            transform: none;
        }
    }
    /* Light and Dark Mode */
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation classes when elements enter viewport
        const animatedElements = document.querySelectorAll('.contact-card, .map-container, .contact-form-container, .transport-card');

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
