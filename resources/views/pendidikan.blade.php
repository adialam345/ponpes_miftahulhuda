@extends('layouts.app')

@section('title', 'Pendidikan - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-bg"></div>
    <div class="container py-5 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="animate__animated animate__fadeInDown">
                    <h1 class="fw-bold display-5 mb-3">Program <span class="highlight-text">Pendidikan</span> Kami</h1>
                    <p class="lead text-gray-600 mb-4">Memberikan pendidikan berkualitas dengan nilai-nilai Islam yang kuat untuk membentuk generasi yang berilmu dan berakhlak mulia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Overview Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm p-4 mb-5">
                    <div class="card-body">
                        <h2 class="text-center mb-4 fw-bold">Pendidikan di Pondok Pesantren Miftahul Huda</h2>
                        <p class="mb-3">Pondok Pesantren Miftahul Huda menawarkan program pendidikan yang komprehensif, menggabungkan kurikulum pesantren tradisional dengan pendidikan formal modern. Kami berfokus pada pengembangan intelektual, spiritual, dan moral untuk mencetak generasi yang unggul.</p>
                        <p>Program pendidikan kami dirancang untuk membekali santri dengan pengetahuan agama yang mendalam, keterampilan sosial, dan kemampuan akademik yang akan membantu mereka sukses di dunia modern sambil tetap berpegang pada nilai-nilai Islam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="bg-light-custom py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-book-open me-2"></i>Program Unggulan</h6>
            <h2 class="fw-bold mb-2">Jenjang Pendidikan</h2>
            <div class="title-underline mx-auto"></div>
        </div>

        <div class="row g-4">
            <!-- Madrasah Diniyah Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm program-card animate__animated animate__fadeIn">
                    <div class="card-body p-4">
                        <div class="program-icon mb-3 text-center">
                            <i class="fas fa-moon fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h4 fw-bold text-center mb-3">Madrasah Diniyah</h3>
                        <p class="card-text">Program pendidikan keagamaan yang fokus pada pengajaran kitab kuning, Al-Qur'an, Hadits, Fiqih, dan ilmu-ilmu Islam tradisional lainnya.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pengajaran kitab kuning</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Tahfidz Al-Qur'an</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pembelajaran bahasa Arab</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kajian Fiqih dan Ushul Fiqih</li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="{{ url('/madin') }}" class="btn btn-outline-custom">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pondok Pesantren Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm program-card animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                    <div class="card-body p-4">
                        <div class="program-icon mb-3 text-center">
                            <i class="fas fa-mosque fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h4 fw-bold text-center mb-3">Pondok Pesantren</h3>
                        <p class="card-text">Program pendidikan asrama yang menyeluruh, memadukan pembelajaran agama dengan pembinaan akhlak dan karakter sepanjang hari.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pengajian rutin</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pembinaan karakter</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Praktik ibadah sehari-hari</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Keterampilan hidup dan leadership</li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="{{ route('registration.show', ['type' => 'pondok']) }}" class="btn btn-outline-custom">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SMP Islam Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm program-card animate__animated animate__fadeIn" style="animation-delay: 0.4s;">
                    <div class="card-body p-4">
                        <div class="program-icon mb-3 text-center">
                            <i class="fas fa-school fa-2x text-primary-custom"></i>
                        </div>
                        <h3 class="card-title h4 fw-bold text-center mb-3">SMP Islam</h3>
                        <p class="card-text">Pendidikan formal setingkat SMP yang mengintegrasikan kurikulum nasional dengan pendidikan Islam untuk menghasilkan lulusan yang kompeten.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kurikulum Nasional</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pendidikan Al-Qur'an intensif</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Ekstrakurikuler beragam</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Persiapan pendidikan lanjutan</li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="{{ url('/smp') }}" class="btn btn-outline-custom">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Teaching Method Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-chalkboard-teacher me-2"></i>Metode Pengajaran</h6>
            <h2 class="fw-bold mb-2">Pendekatan Pembelajaran</h2>
            <div class="title-underline mx-auto"></div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="animate__animated animate__fadeInLeft">
                    <img src="{{ asset('images/teaching-method.jpg') }}" alt="Metode Pengajaran" class="img-fluid rounded-lg shadow-sm" onerror="this.onerror=null; this.src='https://source.unsplash.com/random/600x400/?islamic,teaching'; this.className+=' fallback-img'">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="animate__animated animate__fadeInRight">
                    <h3 class="fw-bold mb-3">Metode Pembelajaran yang Efektif</h3>
                    <p class="mb-4">Kami menerapkan berbagai metode pembelajaran yang disesuaikan dengan kebutuhan santri dan materi yang diajarkan:</p>
                    
                    <div class="method-item d-flex mb-3">
                        <div class="method-icon me-3">
                            <i class="fas fa-book text-primary-custom"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Bandongan</h5>
                            <p>Metode klasikal dimana Kyai membaca kitab dan menjelaskan maknanya, sementara santri menyimak dan mencatat.</p>
                        </div>
                    </div>
                    
                    <div class="method-item d-flex mb-3">
                        <div class="method-icon me-3">
                            <i class="fas fa-users text-primary-custom"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Sorogan</h5>
                            <p>Metode individual dimana santri membaca kitab di hadapan Kyai yang kemudian memberikan koreksi dan bimbingan.</p>
                        </div>
                    </div>
                    
                    <div class="method-item d-flex mb-3">
                        <div class="method-icon me-3">
                            <i class="fas fa-comments text-primary-custom"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Halaqah</h5>
                            <p>Metode diskusi kelompok untuk mengkaji dan memperdalam pemahaman atas suatu topik tertentu.</p>
                        </div>
                    </div>
                    
                    <div class="method-item d-flex">
                        <div class="method-icon me-3">
                            <i class="fas fa-laptop text-primary-custom"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Modern</h5>
                            <p>Penggunaan teknologi dan metode pembelajaran kontemporer untuk materi umum dan keterampilan praktis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kegiatan Banner -->
<section class="py-5 bg-primary-custom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 text-white mb-4 mb-lg-0">
                <h3 class="fw-bold">Ingin Tahu Lebih Banyak Tentang Kegiatan Kami?</h3>
                <p class="mb-0">Pelajari lebih lanjut tentang jadwal dan aktivitas harian, mingguan, dan tahunan di Pondok Pesantren Miftahul Huda.</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="{{ url('/kegiatan') }}" class="btn btn-light fw-bold px-4 py-2">
                    <i class="fas fa-calendar-alt me-2"></i>Lihat Jadwal Kegiatan
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.program-card {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.program-card:hover {
    transform: translateY(-10px);
}

.program-icon {
    height: 70px;
    width: 70px;
    line-height: 70px;
    border-radius: 50%;
    background-color: var(--light-color);
    margin: 0 auto;
    transition: all 0.3s ease;
}

.program-card:hover .program-icon {
    background-color: var(--primary-color);
    color: white;
}

.program-card:hover .program-icon i {
    color: white !important;
}

.method-icon {
    font-size: 1.5rem;
    width: 40px;
    text-align: center;
}

/* Adding animation for cards */
@media (min-width: 768px) {
    .program-card {
        opacity: 0;
    }
    
    .program-card.animate__fadeIn {
        animation-duration: 1s;
        animation-fill-mode: forwards;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements when they come into view
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate__animated:not(.animate__animated--triggered)');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if(elementPosition < screenPosition) {
                element.classList.add('animate__animated--triggered');
                if(element.classList.contains('program-card')) {
                    element.style.opacity = '1';
                }
            }
        });
    };
    
    // Run on load
    animateOnScroll();
    
    // Run on scroll
    window.addEventListener('scroll', animateOnScroll);
});
</script>
@endsection 