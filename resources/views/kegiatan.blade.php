@extends('layouts.app')

@section('title', 'Kegiatan - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="page-hero-section position-relative">
    <div class="hero-bg"></div>
    <div class="container position-relative py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center animate__animated animate__fadeInUp">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-calendar-check me-2"></i>Aktivitas</h6>
                <h1 class="fw-bold display-5 mb-3">
                    <span class="highlight-text">Kegiatan</span> Pesantren
                </h1>
                <p class="text-gray-600 mb-0 fs-5">Berbagai aktivitas dan kegiatan santri di Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>
    </div>
</section>

<!-- Daily Activities Section -->
<section class="daily-activities-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-clock me-2"></i>Jadwal</h6>
                <h2 class="fw-bold mb-2">Kegiatan Harian Santri</h2>
                <div class="title-underline mx-auto mb-4"></div>
                <p class="text-muted">Jadwal kegiatan rutin santri dari bangun tidur hingga istirahat malam</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="schedule-timeline animate__animated animate__fadeIn">
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>03:30 - 04:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Shalat Tahajud & Persiapan Subuh</h5>
                            <p class="text-muted mb-0">Santri dibangunkan untuk melaksanakan shalat tahajud dan persiapan shalat subuh berjamaah.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>04:30 - 05:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Shalat Subuh & Pengajian Al-Qur'an</h5>
                            <p class="text-muted mb-0">Shalat subuh berjamaah dilanjutkan dengan pengajian Al-Qur'an dan tahfidz.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>05:30 - 06:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Mandi & Sarapan</h5>
                            <p class="text-muted mb-0">Waktu untuk mandi dan sarapan, serta merapikan asrama.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>07:00 - 12:00</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Kegiatan Belajar Formal</h5>
                            <p class="text-muted mb-0">Santri mengikuti kegiatan belajar mengajar di madrasah atau sekolah formal.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>12:00 - 13:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Shalat Dzuhur & Makan Siang</h5>
                            <p class="text-muted mb-0">Shalat dzuhur berjamaah dilanjutkan dengan makan siang dan istirahat singkat.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>13:30 - 15:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Pengajian Kitab Kuning</h5>
                            <p class="text-muted mb-0">Pembelajaran kitab kuning dan ilmu-ilmu keislaman tradisional.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>15:30 - 16:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Shalat Ashar & Pengajian Al-Qur'an</h5>
                            <p class="text-muted mb-0">Shalat ashar berjamaah dilanjutkan dengan pengajian Al-Qur'an.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>16:30 - 17:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Waktu Bebas & Olahraga</h5>
                            <p class="text-muted mb-0">Waktu bebas untuk kegiatan olahraga, organisasi, atau kegiatan ekstrakurikuler.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>17:30 - 18:00</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Mandi & Persiapan Maghrib</h5>
                            <p class="text-muted mb-0">Waktu untuk mandi dan persiapan shalat maghrib berjamaah.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>18:00 - 19:30</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Shalat Maghrib & Pengajian</h5>
                            <p class="text-muted mb-0">Shalat maghrib berjamaah dilanjutkan dengan pengajian dan tadarus Al-Qur'an.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>19:30 - 20:00</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Shalat Isya & Makan Malam</h5>
                            <p class="text-muted mb-0">Shalat isya berjamaah dilanjutkan dengan makan malam.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>20:00 - 22:00</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Belajar Mandiri</h5>
                            <p class="text-muted mb-0">Waktu belajar mandiri atau tugas kelompok dengan bimbingan ustadz/ustadzah.</p>
                        </div>
                    </div>
                    
                    <div class="schedule-item">
                        <div class="schedule-time">
                            <span>22:00</span>
                        </div>
                        <div class="schedule-content">
                            <h5 class="fw-bold">Istirahat Malam</h5>
                            <p class="text-muted mb-0">Waktu istirahat dan tidur malam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Weekly Activities Section -->
<section class="weekly-activities-section py-5 bg-light-custom">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-calendar-week me-2"></i>Mingguan</h6>
                <h2 class="fw-bold mb-2">Kegiatan Mingguan</h2>
                <div class="title-underline mx-auto mb-4"></div>
                <p class="text-muted">Program rutin yang dilaksanakan secara mingguan di Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="activity-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-chalkboard-teacher text-primary-custom"></i>
                            </div>
                            <h3 class="card-title h5 fw-bold mb-0">Kajian Umum</h3>
                        </div>
                        <p class="card-text">Setiap Kamis malam diadakan kajian umum yang diikuti oleh seluruh santri dengan mengundang pemateri dari luar pesantren.</p>
                        <div class="activity-schedule mt-3">
                            <i class="fas fa-clock me-2 text-primary-custom"></i>
                            <span class="text-muted">Kamis, 19:30 - 21:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="activity-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-microphone-alt text-primary-custom"></i>
                            </div>
                            <h3 class="card-title h5 fw-bold mb-0">Latihan Khitobah</h3>
                        </div>
                        <p class="card-text">Kegiatan latihan pidato/ceramah untuk melatih santri dalam berdakwah dan public speaking dalam berbagai bahasa.</p>
                        <div class="activity-schedule mt-3">
                            <i class="fas fa-clock me-2 text-primary-custom"></i>
                            <span class="text-muted">Minggu, 09:00 - 11:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="activity-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-broom text-primary-custom"></i>
                            </div>
                            <h3 class="card-title h5 fw-bold mb-0">Ro'an (Kerja Bakti)</h3>
                        </div>
                        <p class="card-text">Kegiatan bersih-bersih lingkungan pesantren secara bersama-sama untuk melatih kebersamaan dan tanggung jawab santri.</p>
                        <div class="activity-schedule mt-3">
                            <i class="fas fa-clock me-2 text-primary-custom"></i>
                            <span class="text-muted">Jum'at, 07:00 - 09:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="activity-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-music text-primary-custom"></i>
                            </div>
                            <h3 class="card-title h5 fw-bold mb-0">Seni Hadroh</h3>
                        </div>
                        <p class="card-text">Latihan seni musik islami yang diiringi dengan rebana dan pembacaan shalawat Nabi Muhammad SAW.</p>
                        <div class="activity-schedule mt-3">
                            <i class="fas fa-clock me-2 text-primary-custom"></i>
                            <span class="text-muted">Sabtu, 15:30 - 17:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="activity-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-futbol text-primary-custom"></i>
                            </div>
                            <h3 class="card-title h5 fw-bold mb-0">Olahraga Bersama</h3>
                        </div>
                        <p class="card-text">Kegiatan olahraga rutin seperti sepak bola, basket, voli, dan lainnya untuk menjaga kesehatan jasmani santri.</p>
                        <div class="activity-schedule mt-3">
                            <i class="fas fa-clock me-2 text-primary-custom"></i>
                            <span class="text-muted">Minggu, 15:30 - 17:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="activity-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-book-reader text-primary-custom"></i>
                            </div>
                            <h3 class="card-title h5 fw-bold mb-0">Khatmil Qur'an</h3>
                        </div>
                        <p class="card-text">Kegiatan khataman Al-Qur'an (membaca Al-Qur'an 30 juz) secara bersama-sama yang diikuti oleh seluruh santri.</p>
                        <div class="activity-schedule mt-3">
                            <i class="fas fa-clock me-2 text-primary-custom"></i>
                            <span class="text-muted">Jum'at, 19:30 - 21:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Annual Activities Section -->
<section class="annual-activities-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h6 class="text-uppercase fw-bold text-primary-custom"><i class="fas fa-calendar-alt me-2"></i>Tahunan</h6>
                <h2 class="fw-bold mb-2">Kegiatan Tahunan</h2>
                <div class="title-underline mx-auto mb-4"></div>
                <p class="text-muted">Agenda tahunan yang dilaksanakan di Pondok Pesantren Miftahul Huda</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="annual-events">
                    <div class="annual-event-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <div class="annual-event-img rounded-start overflow-hidden">
                                    <img src="{{ asset('images/event-placeholder.jpg') }}" alt="Haflah Akhirussanah" class="img-fluid" onerror="this.onerror=null; this.src='https://source.unsplash.com/random/600x400/?islamic,graduation'; this.className+=' fallback-img'">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="annual-event-content p-4">
                                    <div class="event-date mb-2">
                                        <span class="badge bg-primary-custom">Juli</span>
                                    </div>
                                    <h3 class="fw-bold mb-2">Haflah Akhirussanah</h3>
                                    <p>Acara penutupan tahun ajaran dan wisuda santri yang telah menyelesaikan pendidikan di Pondok Pesantren Miftahul Huda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="annual-event-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-8">
                                <div class="annual-event-content p-4">
                                    <div class="event-date mb-2">
                                        <span class="badge bg-primary-custom">Ramadhan</span>
                                    </div>
                                    <h3 class="fw-bold mb-2">Pesantren Ramadhan</h3>
                                    <p>Program khusus selama bulan Ramadhan dengan kegiatan intensif seperti tadarus Al-Qur'an, kajian kitab, dan iktikaf di sepuluh malam terakhir.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="annual-event-img rounded-end overflow-hidden">
                                    <img src="{{ asset('images/ramadhan-placeholder.jpg') }}" alt="Pesantren Ramadhan" class="img-fluid" onerror="this.onerror=null; this.src='https://source.unsplash.com/random/600x400/?ramadan,prayer'; this.className+=' fallback-img'">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="annual-event-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <div class="annual-event-img rounded-start overflow-hidden">
                                    <img src="{{ asset('images/muharram-placeholder.jpg') }}" alt="Peringatan Tahun Baru Hijriyah" class="img-fluid" onerror="this.onerror=null; this.src='https://source.unsplash.com/random/600x400/?islamic,new-year'; this.className+=' fallback-img'">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="annual-event-content p-4">
                                    <div class="event-date mb-2">
                                        <span class="badge bg-primary-custom">Muharram</span>
                                    </div>
                                    <h3 class="fw-bold mb-2">Peringatan Tahun Baru Hijriyah</h3>
                                    <p>Rangkaian kegiatan untuk memperingati tahun baru Islam dengan berbagai lomba islami, pawai, dan pengajian akbar.</p>
                                </div>
                            </div>
                        </div>
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
    
    /* Schedule Timeline Styles */
    .schedule-timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .schedule-item {
        display: flex;
        margin-bottom: 30px;
        position: relative;
    }
    
    .schedule-time {
        flex: 0 0 140px;
        font-weight: 600;
        color: var(--primary-color);
        padding-right: 20px;
        text-align: right;
        border-right: 2px solid var(--primary-color);
    }
    
    .schedule-content {
        flex: 1;
        padding-left: 20px;
        position: relative;
    }
    
    .schedule-content:before {
        content: '';
        position: absolute;
        top: 5px;
        left: -8px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background-color: var(--primary-color);
    }
    
    /* Activity Card Styles */
    .activity-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .activity-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }
    
    .activity-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background-color: var(--light-color);
        border-radius: 50%;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }
    
    .activity-card:hover .activity-icon {
        background-color: var(--primary-color);
        color: white;
    }
    
    .activity-schedule {
        font-size: 0.9rem;
    }
    
    /* Annual Event Styles */
    .annual-event-item {
        margin-bottom: 30px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background-color: white;
        transition: all 0.3s ease;
    }
    
    .annual-event-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .annual-event-img img {
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }
    
    .annual-event-item:hover .annual-event-img img {
        transform: scale(1.05);
    }
    
    .event-date .badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        border-radius: 30px;
    }
    
    @media (max-width: 767px) {
        .schedule-item {
            flex-direction: column;
        }
        
        .schedule-time {
            flex: 0 0 auto;
            border-right: none;
            border-bottom: 2px solid var(--primary-color);
            padding-right: 0;
            padding-bottom: 10px;
            margin-bottom: 10px;
            text-align: left;
        }
        
        .schedule-content {
            padding-left: 0;
            padding-top: 15px;
        }
        
        .schedule-content:before {
            top: -8px;
            left: 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation classes when elements enter viewport
        const animatedElements = document.querySelectorAll('.activity-card, .annual-event-item');
        
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