<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pondok Pesantren Miftahul Huda')</title>
    <meta name="description" content="@yield('meta_description', 'Pondok Pesantren Miftahul Huda - Pusat pendidikan Islam yang menghasilkan generasi Muslim berkualitas dan berakhlak mulia')">
    <meta name="keywords" content="@yield('meta_keywords', 'pesantren, pondok pesantren, pendidikan islam, miftahul huda')">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon"/>

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #0A5D36;
            --secondary-color: #2E8B57;
            --accent-color: #2CD371;
            --light-color: #E8F5E9;
            --dark-color: #0F1A17;
            --transition-speed: 0.3s;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FCFCFC;
            color: var(--dark-color);
            overflow-x: hidden;
            position: relative;
        }

        /* Navbar Styles */
        .navbar-custom {
            background-color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all var(--transition-speed) ease;
        }

        .navbar-custom.scrolled {
            padding: 0.5rem 1.5rem;
            background-color: rgba(10, 93, 54, 0.95);
            backdrop-filter: blur(10px);
        }

        .navbar-custom .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-custom .logo {
            display: flex;
            align-items: center;
            transition: transform var(--transition-speed) ease;
        }

        .navbar-custom .logo:hover {
            transform: translateY(-2px);
        }

        .navbar-custom .logo img {
            height: 45px;
            margin-right: 15px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .navbar-custom .logo span {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            letter-spacing: 0.3px;
        }

        .navbar-custom .menu {
            display: flex;
            align-items: center;
        }

        .navbar-custom .menu a {
            color: white;
            font-weight: 500;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            margin: 0 0.3rem;
            border-radius: 4px;
            transition: all var(--transition-speed) ease;
            position: relative;
        }

        .navbar-custom .menu a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--accent-color);
            transition: all var(--transition-speed) ease;
            transform: translateX(-50%);
        }

        .navbar-custom .menu a:hover:after {
            width: 70%;
        }

        .navbar-custom .menu a:hover {
            color: var(--accent-color);
        }

        .navbar-custom .dropdown {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .navbar-custom .dropdown-content {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all var(--transition-speed) ease;
            overflow: hidden;
            z-index: 1001;
        }

        .navbar-custom .dropdown:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .navbar-custom .dropdown-content a {
            color: var(--dark-color) !important;
            padding: 0.7rem 1.2rem;
            display: block;
            text-decoration: none;
            font-weight: 400;
            transition: all 0.2s ease;
            margin: 0;
            border-radius: 0;
        }

        .navbar-custom .dropdown-content a:hover {
            background-color: #f8f9fa;
            color: var(--primary-color) !important;
            padding-left: 1.5rem;
        }

        .navbar-custom .dropdown-content a:after {
            display: none;
        }

        .mobile-menu-button {
            display: none;
            color: white;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .mobile-menu-button:hover {
            transform: rotate(90deg);
        }

        /* Footer Styles */
        .footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: 3rem;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .footer-social {
            margin-bottom: 1rem;
        }

        .footer-social a {
            color: white;
            margin: 0 0.5rem;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-social a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }

        .footer-text {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Button Styles */
        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .btn-outline-custom {
            background-color: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Layout Styles */
        .content-wrapper {
            padding-bottom: 5rem;
            min-height: calc(100vh - 180px);
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
        }

        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }

        .bg-light-custom {
            background-color: var(--light-color) !important;
        }

        /* Scroll to Top Button */
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: white;
            width: 45px;
            height: 45px;
            text-align: center;
            line-height: 45px;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 99;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .scroll-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* Text Highlight */
        .highlight-text {
            position: relative;
            display: inline-block;
        }

        .highlight-text::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background-color: rgba(44, 211, 113, 0.3);
            z-index: -1;
        }

        /* Responsive Styles */
        @media (max-width: 991px) {
            .mobile-menu-button {
                display: block;
            }

            .navbar-custom .menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--primary-color);
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                max-height: 80vh;
                overflow-y: auto;
                z-index: 1000;
            }

            .navbar-custom .menu.active {
                display: flex;
                animation: slideDown 0.3s ease forwards;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .navbar-custom .menu a {
                padding: 0.8rem;
                width: 100%;
                margin: 0.3rem 0;
            }

            .navbar-custom .menu a:after {
                display: none;
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
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                transition: transform 0.3s ease;
            }

            .navbar-custom .dropdown.active > a::after {
                transform: rotate(180deg);
            }

            .navbar-custom .dropdown:hover .dropdown-content {
                opacity: 0;
                visibility: hidden;
                transform: translateY(10px);
            }

            .navbar-custom .dropdown-content {
                position: static;
                width: 100%;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: block;
                max-height: 0;
                transition: max-height 0.3s ease;
                box-shadow: none;
                background-color: rgba(0, 0, 0, 0.15);
                border-radius: 0;
                overflow: hidden;
                padding: 0;
            }

            .navbar-custom .dropdown.active .dropdown-content {
                max-height: 300px;
                padding: 0.25rem 0;
                opacity: 1;
                visibility: visible;
            }

            .navbar-custom .dropdown-content a {
                color: rgba(255, 255, 255, 0.9) !important;
                padding: 0.6rem 1.5rem 0.6rem 2rem;
                font-size: 0.95rem;
                border-left: 2px solid rgba(255, 255, 255, 0.2);
                margin-left: 1rem;
            }

            .navbar-custom .dropdown-content a:hover {
                background-color: rgba(255, 255, 255, 0.1);
                color: white !important;
                border-left: 2px solid var(--accent-color);
                padding-left: 2rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-custom .logo span {
                font-size: 1rem;
            }

            .navbar-custom .logo img {
                height: 35px;
            }

            .footer {
                padding: 1rem 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar-custom">
        <div class="container">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/logopondok.png') }}" alt="Logo Pondok Pesantren Miftahul Huda">
                <span>Pondok Pesantren Miftahul Huda</span>
            </a>
            <button class="mobile-menu-button" id="mobileMenuToggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="menu" id="mobileMenu">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="nav-link {{ request()->is('pimpinan*') || request()->is('pesantren*') ? 'active' : '' }}">
                        Profil <i class="fas fa-chevron-down ms-1 fa-xs"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ url('/pimpinan') }}" class="{{ request()->is('pimpinan*') ? 'active' : '' }}">Pengasuh</a>
                        <a href="{{ url('/pesantren') }}" class="{{ request()->is('pesantren*') ? 'active' : '' }}">Pesantren</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="nav-link {{ request()->is('kegiatan*') || request()->is('madin*') || request()->is('smp*') ? 'active' : '' }}">
                        Pendidikan <i class="fas fa-chevron-down ms-1 fa-xs"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ url('/kegiatan') }}" class="{{ request()->is('kegiatan*') ? 'active' : '' }}">Kegiatan</a>
                        <a href="{{ url('/madin') }}" class="{{ request()->is('madin*') ? 'active' : '' }}">Madin</a>
                        <a href="{{ url('/smp') }}" class="{{ request()->is('smp*') ? 'active' : '' }}">SMP</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="nav-link {{ request()->is('registration*') ? 'active' : '' }}">
                        Pendaftaran <i class="fas fa-chevron-down ms-1 fa-xs"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ route('registration.show', ['type' => 'pondok']) }}" class="{{ request()->is('registration*') && request()->query('type') == 'pondok' ? 'active' : '' }}">Pondok</a>
                        <a href="{{ route('registration.show', ['type' => 'smp']) }}" class="{{ request()->is('registration*') && request()->query('type') == 'smp' ? 'active' : '' }}">SMP</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="nav-link {{ request()->is('syariah-pondok*') || request()->is('syariah-smp*') ? 'active' : '' }}">
                        Pembayaran <i class="fas fa-chevron-down ms-1 fa-xs"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ url('/syariah-pondok') }}" class="{{ request()->is('syariah-pondok*') ? 'active' : '' }}">Syariah Pondok</a>
                        <a href="{{ url('/syariah-smp') }}" class="{{ request()->is('syariah-smp*') ? 'active' : '' }}">Syariah SMP</a>
                    </div>
                </div>
                <a href="{{ route('gallery.index') }}" class="nav-link {{ request()->is('gallery*') ? 'active' : '' }}">Galeri</a>
                <a href="{{ url('/kontak') }}" class="nav-link {{ request()->is('kontak*') ? 'active' : '' }}">Kontak & Alamat</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scroll to Top Button -->
    <div class="scroll-to-top" id="scrollToTop" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-social">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
            <div class="footer-text">
                &copy; {{ date('Y') }} Pondok Pesantren Miftahul Huda. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Main JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preloader
            const preloader = document.getElementById('preloader');
            if (preloader) {
                window.addEventListener('load', function() {
                    preloader.style.opacity = '0';
                    setTimeout(function() {
                        preloader.style.display = 'none';
                    }, 500);
                });
            }

            // Mobile menu toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    mobileMenu.classList.toggle('active');
                    this.innerHTML = mobileMenu.classList.contains('active') ?
                        '<i class="fas fa-times"></i>' :
                        '<i class="fas fa-bars"></i>';
                });
            }

            // Mobile dropdown toggles
            const dropdowns = document.querySelectorAll('.dropdown');
            const isMobile = () => window.innerWidth <= 991;

            // Remove existing click events
            function setupMobileNavigation() {
                // Clean up existing event listeners by cloning and replacing elements
                dropdowns.forEach(dropdown => {
                    const dropdownLink = dropdown.querySelector('a');
                    if (dropdownLink) {
                        const newLink = dropdownLink.cloneNode(true);
                        dropdownLink.parentNode.replaceChild(newLink, dropdownLink);

                        // Add new event listener
                        if (newLink.getAttribute('href') === 'javascript:void(0);') {
                            newLink.addEventListener('click', handleDropdownClick);
                        }
                    }
                });
            }

            // Dropdown click handler
            function handleDropdownClick(e) {
                e.preventDefault();
                e.stopPropagation();

                if (isMobile()) {
                    const dropdown = this.closest('.dropdown');

                    // Close other dropdowns
                    dropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown && otherDropdown.classList.contains('active')) {
                            otherDropdown.classList.remove('active');
                        }
                    });

                    // Toggle this dropdown with slight delay to prevent double-click issues
                    setTimeout(() => {
                        dropdown.classList.toggle('active');
                    }, 10);
                }
            }

            // Setup resize handler
            function handleResize() {
                if (isMobile()) {
                    // Add mobile-specific behaviors
                    setupMobileNavigation();
                } else {
                    // Reset mobile menu when in desktop mode
                    if (mobileMenu && mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        if (mobileMenuToggle) {
                            mobileMenuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                        }
                    }

                    // Reset all dropdowns in desktop mode
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                }
            }

            // Initial setup
            handleResize();

            // Prevent duplicate event listeners
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(handleResize, 100);
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (isMobile() && mobileMenu) {
                    // Close menu when clicking outside
                    if (!mobileMenu.contains(e.target) &&
                        mobileMenuToggle &&
                        !mobileMenuToggle.contains(e.target) &&
                        mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        if (mobileMenuToggle) {
                            mobileMenuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                        }
                    }
                }
            });

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar-custom');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }

            // Scroll to top button
            const scrollToTopBtn = document.getElementById('scrollToTop');

            if (scrollToTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        scrollToTopBtn.classList.add('active');
                    } else {
                        scrollToTopBtn.classList.remove('active');
                    }
                });

                scrollToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            // Add active class to current nav item based on URL
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath === currentPath) {
                    link.style.color = 'var(--accent-color)';
                }
            });

            // Initialize Bootstrap tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialize Bootstrap popovers
            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>

    <style>
        /* Preloader styles */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.98);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        /* Active nav link styles */
        .nav-link.active,
        .dropdown-content a.active {
            color: var(--accent-color) !important;
            font-weight: 600;
        }

        /* Alert styles */
        .alert {
            margin-bottom: 0;
            border: none;
            border-radius: 0;
        }
    </style>

    @stack('scripts')
</body>
</html>
