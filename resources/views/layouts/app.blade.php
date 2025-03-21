<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pondok Pesantren Miftahul Huda')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f8fff0;
        }
        .navbar-custom {
            background-color: #006400; /* Hijau tua */
            color: white;
            padding: 15px;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }
        .navbar-custom .logo {
            display: flex;
            align-items: center;
        }
        .navbar-custom .logo img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-custom .logo span {
            font-size: 1.2rem;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            .navbar-custom .logo span {
                font-size: 0.9rem;
            }
            .navbar-custom .logo img {
                height: 30px;
            }
        }
        .navbar-custom a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            margin: 0 10px;
        }
        .navbar-custom a:hover {
            color: #d4edda; /* Warna hijau muda */
        }
        .navbar-custom .menu {
            display: flex;
            align-items: center;
        }
        .navbar-custom .dropdown {
            position: relative;
        }
        .navbar-custom .dropdown-content {
            display: none;
            position: absolute;
            background-color: #228B22; /* Hijau terang */
            color: white;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            min-width: 160px;
            z-index: 1000;
            border-radius: 5px;
            padding: 10px 0;
        }
        .navbar-custom .dropdown-content a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .navbar-custom .dropdown-content a:hover {
            background-color: #006400;
        }
        .navbar-custom .dropdown:hover .dropdown-content {
            display: block;
        }
        .footer {
            width: 100%;
            background-color: #006400;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            font-size: 0.9rem;
        }
        @media (max-width: 767px) {
            .footer {
                font-size: 0.8rem;
                padding: 8px 0;
            }
        }
        .content-wrapper {
            padding-bottom: 60px; /* Memberi ruang agar konten tidak tertutup footer */
        }
        @media (max-width: 767px) {
            .content-wrapper {
                padding-bottom: 50px;
            }
        }

        /* Mobile menu styles */
        .mobile-menu-button {
            display: none;
            color: white;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .mobile-menu-button {
                display: block;
            }
            .navbar-custom .menu {
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                background-color: #006400;
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .navbar-custom .menu.active {
                display: flex;
            }
            .navbar-custom .menu a {
                padding: 10px;
                width: 100%;
                margin: 0;
            }
            .navbar-custom .dropdown {
                width: 100%;
            }
            .navbar-custom .dropdown > a {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .navbar-custom .dropdown > a::after {
                content: '\f107';
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
            }
            .navbar-custom .dropdown-content {
                position: static;
                box-shadow: none;
                display: none;
                width: 100%;
                padding-left: 20px;
            }
            .navbar-custom .dropdown.active .dropdown-content {
                display: block;
            }
        }

        /* Responsive card layout */
        @media (max-width: 767px) {
            .card {
                margin-bottom: 20px;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-green-50">
    <nav class="navbar-custom">
        <div class="logo">
            <img src="{{ asset("/images/logopondok.png") }}" alt="Logo">
            <span>Pondok Pesantren Miftahul Huda</span>
        </div>
        <button class="mobile-menu-button" id="mobileMenuToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="menu" id="mobileMenu">
            <a href="{{ url('/') }}">Beranda</a>
            <div class="dropdown">
                <a href="{{ url('/profil') }}">Profil <i class="fas fa-chevron-down d-none d-lg-inline-block"></i></a>
                <div class="dropdown-content">
                    <a href="{{ url('/pimpinan') }}">Pimpinan</a>
                    <a href="{{ url('/pesantren') }}">Pesantren</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="{{ url('/pendidikan') }}">Pendidikan <i class="fas fa-chevron-down d-none d-lg-inline-block"></i></a>
                <div class="dropdown-content">
                    <a href="{{ url('/kegiatan') }}">Kegiatan</a>
                    <a href="{{ url('/madin') }}">Madin</a>
                    <a href="{{ url('/smp') }}">SMP</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0);">Pendaftaran <i class="fas fa-chevron-down d-none d-lg-inline-block"></i></a>
                <div class="dropdown-content">
                    <a href="{{ route('registration.show', ['type' => 'pondok']) }}">Pondok</a>
                    <a href="{{ route('registration.show', ['type' => 'smp']) }}">SMP</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="{{ url('/pembayaran') }}">Pembayaran <i class="fas fa-chevron-down d-none d-lg-inline-block"></i></a>
                <div class="dropdown-content">
                    <a href="{{ url('/syariah-pondok') }}">Syariah Pondok</a>
                    <a href="{{ url('/syariah-smp') }}">Syariah SMP</a>
                </div>
            </div>
            <a href="{{ url('/kontak') }}">Kontak & Alamat</a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="footer">
        &copy; 2025 Pondok Pesantren Miftahul Huda. Semua Hak Dilindungi.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
            });

            // Mobile dropdown toggles
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                const dropdownLink = dropdown.querySelector('a');

                if (window.innerWidth <= 991) {
                    dropdownLink.addEventListener('click', function(e) {
                        if (this.getAttribute('href') === 'javascript:void(0);' || window.innerWidth <= 991) {
                            e.preventDefault();
                            dropdown.classList.toggle('active');
                        }
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
