@extends('layouts.app')

@section('title', 'Pesantren - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="page-hero-section position-relative">
    <div class="hero-bg"></div>
    <div class="container position-relative py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center animate__animated animate__fadeInUp">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-mosque me-2"></i>Profil</h6>
                <h1 class="fw-bold display-5 mb-3">
                    <span class="highlight-text">Profil</span> Pesantren
                </h1>
                <p class="text-gray-600 mb-0 fs-5">Mengenal sejarah dan informasi tentang Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>
    </div>
</section>

<!-- History Section -->
<section class="history-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="animate__animated animate__fadeInLeft">
                    <h2 class="fw-bold mb-4">Sejarah Pendirian</h2>
                    <div class="title-underline mb-4"></div>
                    <p class="mb-3">Pondok Pesantren Miftahul Huda didirikan oleh Dr. Ky. Imam Mudofir, S.Pd. M.Pd. dan Ibu Nyai Ririn Nurhayati, STP., S.Pd. pada tanggal 17 Oktober 2015 bertepatan dengan Hari Sabtu Wage tanggal 04 Muharram 1437 H di Jl. Wisata Tani, Gang Pesantren No. 01, Doho RT 29 RW 04, Kecamatan Dolopo, Kabupaten Madiun. Peletakan Batu pertama Pondok Pesantren pada tanggal 27 Desember 2015 bertepatan dengan Hari Ahad Kliwon tanggal 14 Robiul Awwal 1437 H. Awal Mukim santri dan kegaiatan Pondok Pesantren Miftahul Huda pada tanggal 19 Juli 2016 bertepatan dengan Hari Rabu Legi 14 Syawal 1437 H. Dewan Pengasuh dan sekaligus Pimpinan Pondok Pesantren Miftahul Huda adalah Dr. Ky. Imam Mudofir, S.Pd., M.Pd. yang didampingi oleh Dewan Pembina dan sekaligus Dewan Pendamping seluruh kegiatan Pondok Pesantren Miftahul Huda adalah Ibu Nyai Ririn Nurhayati, STP., S.Pd. Pondok Pesantren Miftahul Huda resmi mendapat surat keputusan dari pemerintah dengan SK Kemenkumham No : AHU-0036417.AH.01.04 Tahun 2016.</p>
                    <p>Kini, Pondok Pesantren Miftahul Huda telah menjadi salah satu lembaga pendidikan Islam terkemuka di daerah ini, dan terus berkomitmen untuk memberikan pendidikan berkualitas bagi para santrinya.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm animate__animated animate__fadeInRight">
                    <div class="card-body p-4">
                        <div class="timeline-container">
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h5 class="fw-bold">2015</h5>
                                    <p>Pendirian Pondok Pesantren Miftahul Huda dengan 7 santri pertama.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h5 class="fw-bold">2022</h5>
                                    <p>Pembangunan asrama santri putri dan perluasan area pesantren.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h5 class="fw-bold">2025</h5>
                                    <p>Pendirian SMP Miftahul Huda Terpadu.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h5 class="fw-bold">2025</h5>
                                    <p>Perayaan Hari Lahir ke-10 Pondok Pesantren Miftahul Huda Doho.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="vision-mission-section py-5 bg-light-custom">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-compass me-2"></i>Arah</h6>
                <h2 class="fw-bold mb-2">Visi & Misi Pesantren</h2>
                <div class="title-underline mx-auto mb-4"></div>
                <p class="text-muted">Prinsip dan panduan yang menjadi dasar penyelenggaraan pendidikan di Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card feature-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-eye fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h4 fw-bold text-dark">Visi Pesantren</h3>
                        <p class="card-text">Mengamalkan perintah Allah SWT dan Rosulullah SAW yang bersinergi dengan pemerintah (NKRI).</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card feature-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-bullseye fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h4 fw-bold text-dark">Misi Pesantren</h3>
                        <ul class="ps-3">
                            <li class="mb-2">1. PPMH mendidik dan membina serta menyiapkan insan yang sholeh dan sholehah, berilmu dan beramal, berakhlak mulia penuh kedisiplinan, bertanggung jawab dan berkepribadian luhur dalam rangka membentuk jiwa taqwallah.</li>
                            <li class="mb-2">2. PPMH membentuk dan mengupayakan terwujudnya sistem masyarakat yang berdasarkan nilai-nilai ajaran Islam sesuai dengan latar sosial budaya yang melingkupinya.</li>
                            <li class="mb-2">3. PPMH merencanakan mekanisme dakwah Islam yang efektif, terpadu, sesuai dengan kondisi dan tetap mempertahankan warisan nilai yang sudah baik serta melakukan pembaharuan dan peningkatan efektivitas dakwah.</li>
                            <li class="mb-2">4. PPMH menggali dan menyajikan khasanah pemikiran Islam dalam rangka menyampaikan pemahaman keagamaan di tengah kehidupan masyarakat.</li>
                            <li>5. PPMH mendukung pelaksanaan program pemerintah yang tidak bertentangan dengan Islam dalam mencerdaskan kehidupan bangsa, mewujudkan cita-cita luhur bangsa serta meningkatkan kualitas sumber daya manusia.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="facilities-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-building me-2"></i>Fasilitas</h6>
                <h2 class="fw-bold mb-2">Fasilitas Pesantren</h2>
                <div class="title-underline mx-auto mb-4"></div>
                <p class="text-muted">Berbagai fasilitas yang menunjang kegiatan belajar mengajar di Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="facility-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="facility-icon mb-3">
                            <i class="fas fa-home fa-2x text-primary-custom"></i>
                        </div>
                        <h4 class="facility-title h5 fw-bold">Asrama Santri</h4>
                        <p class="text-muted">Asrama putra dan putri dengan kapasitas total 500 santri, dilengkapi dengan fasilitas yang nyaman dan bersih.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="facility-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="facility-icon mb-3">
                            <i class="fas fa-mosque fa-2x text-primary-custom"></i>
                        </div>
                        <h4 class="facility-title h5 fw-bold">Masjid</h4>
                        <p class="text-muted">Masjid sebagai pusat kegiatan ibadah dan pembelajaran Al-Qur'an dengan kapasitas 600 jamaah.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="facility-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="facility-icon mb-3">
                            <i class="fas fa-school fa-2x text-primary-custom"></i>
                        </div>
                        <h4 class="facility-title h5 fw-bold">Ruang Kelas</h4>
                        <p class="text-muted">20 ruang kelas modern dengan peralatan pembelajaran yang memadai untuk kegiatan belajar mengajar.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="facility-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="facility-icon mb-3">
                            <i class="fas fa-book fa-2x text-primary-custom"></i>
                        </div>
                        <h4 class="facility-title h5 fw-bold">Perpustakaan</h4>
                        <p class="text-muted">Perpustakaan dengan koleksi lebih dari 5000 buku, jurnal, dan referensi keislaman dan umum.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="facility-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="facility-icon mb-3">
                            <i class="fas fa-laptop fa-2x text-primary-custom"></i>
                        </div>
                        <h4 class="facility-title h5 fw-bold">Lab Komputer</h4>
                        <p class="text-muted">Laboratorium komputer dengan 40 unit komputer yang terhubung dengan internet untuk menunjang pembelajaran.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="facility-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="facility-icon mb-3">
                            <i class="fas fa-futbol fa-2x text-primary-custom"></i>
                        </div>
                        <h4 class="facility-title h5 fw-bold">Sarana Olahraga</h4>
                        <p class="text-muted">Lapangan olahraga untuk futsal, basket, dan voli, serta berbagai peralatan olahraga lainnya.</p>
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

    /* Timeline Styles */
    .timeline-container {
        position: relative;
        padding-left: 30px;
    }

    .timeline-container:before {
        content: '';
        position: absolute;
        top: 0;
        left: 8px;
        height: 100%;
        width: 2px;
        background-color: var(--primary-color);
        opacity: 0.3;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-dot {
        position: absolute;
        top: 5px;
        left: -30px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background-color: var(--primary-color);
    }

    .timeline-content {
        padding-bottom: 10px;
    }

    /* Section Styling */
    .title-underline {
        height: 4px;
        width: 50px;
        background-color: var(--primary-color);
        margin-top: 5px;
    }

    /* Facility Card Styles */
    .facility-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .facility-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .facility-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: var(--light-color);
        border-radius: 50%;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .facility-card:hover .facility-icon {
        background-color: var(--primary-color);
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation classes when elements enter viewport
        const animatedElements = document.querySelectorAll('.feature-card, .facility-card');

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
