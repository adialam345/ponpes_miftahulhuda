@extends('layouts.app')

@section('title', 'Pengasuh - Pondok Pesantren Miftahul Huda')

@section('content')
<!-- Hero Section -->
<section class="relative py-16 overflow-hidden">
    <div class="absolute inset-0 bg-slate-50 z-[-1]" style="clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);"></div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center animate__animated animate__fadeIn">
            <h6 class="text-sm font-bold uppercase text-emerald-600 flex items-center justify-center gap-2 mb-2">
                <i class="fas fa-user-tie me-2"></i> Profil
            </h6>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                <span class="relative inline-block">
                    Pengasuh
                    <span class="absolute bottom-1 left-0 w-full h-3 bg-emerald-100 -z-10"></span>
                </span>
                Pesantren
            </h1>
            <p class="text-gray-600 text-lg">
                Mengenal sosok pengasuh yang membangun dan mengembangkan Pondok Pesantren Miftahul Huda Doho Dolopo Madiun
            </p>
        </div>
    </div>
</section>

<!-- Profile Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
            <div class="animate__animated animate__fadeInLeft">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img
                        src="{{ asset('images/kyai.png') }}"
                        alt="Pimpinan Pesantren"
                        class="w-full h-auto object-cover"
                        onerror="this.onerror=null; this.src='https://source.unsplash.com/random/600x800/?islamic,scholar'; this.className+=' fallback-img'"
                    >
                </div>
            </div>
            <div class="animate__animated animate__fadeInRight">
                <h2 class="text-3xl font-bold mb-4">Kyai Dr. Imam Mudofir S.Pd., M.Pd.</h2>
                <div class="h-1 w-12 bg-emerald-600 mb-6"></div>
                <p class="mb-4">
                    KH. Dr. Imam Mudhofir,. S.Pd., M.Pd adalah sosok pemimpin yang kharismatik dan berwawasan luas. Beliau
                    telah memimpin Pondok Pesantren Miftahul Huda selama lebih dari 10 tahun, menjadikannya salah satu
                    pesantren terkemuka di daerah ini.
                </p>
                <p class="mb-4">
                    Dengan latar belakang pendidikan yang kuat dari berbagai pesantren terkenal di Indonesia, beliau
                    memiliki pemahaman mendalam tentang ilmu-ilmu keislaman dan pendidikan modern.
                </p>
                <p class="mb-6">
                    Di bawah kepemimpinannya, Pondok Pesantren Miftahul Huda telah berkembang pesat dan terus berinovasi
                    dalam metode pendidikan, sambil tetap menjaga nilai-nilai tradisional pesantren.
                </p>

                <h4 class="text-xl font-bold mb-4">Riwayat Pendidikan</h4>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center">
                        <i class="fas fa-graduation-cap text-emerald-600 mr-3 flex-shrink-0"></i>
                        <span>MAN 1 Tulungagung (1995)</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-graduation-cap text-emerald-600 mr-3 flex-shrink-0"></i>
                        <span>S1 Universitas Negeri Malang (2001)</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-graduation-cap text-emerald-600 mr-3 flex-shrink-0"></i>
                        <span>S2 Universitas Negeri Malang (2006)</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-graduation-cap text-emerald-600 mr-3 flex-shrink-0"></i>
                        <span>S3 Universitas Negeri Malang (2014)</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-graduation-cap text-emerald-600 mr-3 flex-shrink-0"></i>
                        <span>Pondok Pesantrean Miftahul Huda Malang (Pondok Gading)</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="grid md:grid-cols-2 gap-8 mt-12">
            <div class="group">
                <div class="h-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
                    <div class="mb-4 inline-block rounded-lg bg-emerald-100 p-3">
                        <i class="fas fa-eye text-emerald-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Visi Pimpinan</h3>
                    <p class="text-gray-600">
                        Menjadikan Pondok Pesantren Miftahul Huda sebagai pusat pendidikan Islam yang menghasilkan generasi
                        Muslim berkualitas, berakhlak mulia, dan siap menghadapi tantangan global dengan tetap menjunjung
                        tinggi nilai-nilai Islam.
                    </p>
                </div>
            </div>
            <div class="group">
                <div class="h-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
                    <div class="mb-4 inline-block rounded-lg bg-emerald-100 p-3">
                        <i class="fas fa-bullseye text-emerald-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Misi Pimpinan</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Menyelenggarakan pendidikan Islam berkualitas dengan metode modern</li>
                        <li>• Membina karakter santri dengan akhlakul karimah</li>
                        <li>• Mengembangkan program pendidikan yang relevan dengan kebutuhan zaman</li>
                        <li>• Memberikan kontribusi positif kepada masyarakat sekitar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center mb-12">
            <h6 class="text-sm font-bold uppercase text-emerald-600 flex items-center justify-center gap-2 mb-2">
                <i class="fas fa-quote-left me-2"></i> Testimoni
            </h6>
            <h2 class="text-3xl font-bold mb-2">Kata Mereka Tentang Pimpinan</h2>
            <div class="h-1 w-12 bg-emerald-600 mx-auto"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="group">
                <div class="h-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-2">
                    <div class="mb-4 text-center">
                        <i class="fas fa-user-circle text-emerald-600 opacity-50 text-4xl"></i>
                    </div>
                    <p class="text-gray-600 italic mb-4 text-center">"Kyai Abdul Ghofur adalah sosok yang sangat inspiratif. Beliau tidak hanya mengajarkan ilmu, tetapi juga memberikan teladan dalam kehidupan sehari-hari."</p>
                    <div class="text-center">
                        <h5 class="font-semibold text-emerald-600 mb-1">Ust. Ahmad Syafii</h5>
                        <p class="text-sm text-gray-500">Pengajar Senior</p>
                    </div>
                </div>
            </div>
            <div class="group">
                <div class="h-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-2">
                    <div class="mb-4 text-center">
                        <i class="fas fa-user-circle text-emerald-600 opacity-50 text-4xl"></i>
                    </div>
                    <p class="text-gray-600 italic mb-4 text-center">"Berkat bimbingan Kyai Abdul Ghofur, saya bisa menjadi pribadi yang lebih baik. Beliau selalu sabar menghadapi santri dan memberikan nasihat yang bijaksana."</p>
                    <div class="text-center">
                        <h5 class="font-semibold text-emerald-600 mb-1">Muhammad Rizki</h5>
                        <p class="text-sm text-gray-500">Alumni Angkatan 2018</p>
                    </div>
                </div>
            </div>
            <div class="group">
                <div class="h-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-2">
                    <div class="mb-4 text-center">
                        <i class="fas fa-user-circle text-emerald-600 opacity-50 text-4xl"></i>
                    </div>
                    <p class="text-gray-600 italic mb-4 text-center">"Kyai Abdul Ghofur memiliki visi yang jauh ke depan. Beliau berhasil memadukan nilai-nilai tradisional pesantren dengan pendidikan modern yang sangat dibutuhkan santri."</p>
                    <div class="text-center">
                        <h5 class="font-semibold text-emerald-600 mb-1">Hj. Siti Aisyah</h5>
                        <p class="text-sm text-gray-500">Wali Santri</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate__fadeIn {
        animation: fadeIn 1s ease-out forwards;
    }

    .animate__fadeInLeft {
        animation: fadeInLeft 1s ease-out forwards;
    }

    .animate__fadeInRight {
        animation: fadeInRight 1s ease-out forwards;
    }

    /* Hover transitions */
    .transition-all {
        transition: all 0.3s ease;
    }

    .hover\:shadow-md:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .hover\:-translate-y-2:hover {
        transform: translateY(-8px);
    }

    /* Grid system for older browsers */
    @media (min-width: 768px) {
        .md\:grid-cols-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .md\:grid-cols-3 {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    /* Tailwind-like utilities */
    .container {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
        padding-right: 1rem;
        padding-left: 1rem;
    }

    @media (min-width: 640px) {
        .container {
            max-width: 640px;
        }
    }

    @media (min-width: 768px) {
        .container {
            max-width: 768px;
        }
    }

    @media (min-width: 1024px) {
        .container {
            max-width: 1024px;
        }
    }

    @media (min-width: 1280px) {
        .container {
            max-width: 1280px;
        }
    }

    /* Colors */
    .bg-emerald-100 {
        background-color: #d1fae5;
    }

    .bg-emerald-600 {
        background-color: #059669;
    }

    .text-emerald-600 {
        color: #059669;
    }

    .bg-slate-50 {
        background-color: #f8fafc;
    }

    /* Spacing */
    .space-y-2 > * + * {
        margin-top: 0.5rem;
    }

    .space-y-3 > * + * {
        margin-top: 0.75rem;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .gap-8 {
        gap: 2rem;
    }

    .gap-12 {
        gap: 3rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation classes when elements enter viewport
        const animateOnScroll = function() {
            const cards = document.querySelectorAll('.group');

            cards.forEach(card => {
                const cardPosition = card.getBoundingClientRect();

                // Check if card is in viewport
                if(cardPosition.top < window.innerHeight && cardPosition.bottom > 0) {
                    card.classList.add('animate__animated', 'animate__fadeIn');
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
