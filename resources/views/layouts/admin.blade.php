<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Ponpes Miftahul Huda')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Styles -->
    <style>
        [x-cloak] { display: none !important; }

        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .nav-item {
            position: relative;
            transition: all 0.3s ease;
            white-space: nowrap; /* Prevent text wrapping */
        }

        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-item:hover::after,
        .nav-item.active::after {
            width: 80%;
        }

        .nav-item.active {
            color: #0f172a;
            font-weight: 500;
        }

        .mobile-nav-item {
            transition: all 0.3s ease;
        }

        .mobile-nav-item:hover {
            background-color: #f0fdf4;
            transform: translateX(5px);
        }

        .mobile-nav-item.active {
            background-color: #f0fdf4;
            border-left: 3px solid #10b981;
            color: #0f172a;
            font-weight: 500;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-item {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        .sidebar-item:hover {
            background-color: #f0fdf4;
        }

        .sidebar-item.active {
            background-color: #f0fdf4;
            color: #0f172a;
            font-weight: 500;
        }

        .sidebar-item.active i {
            color: #10b981;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            max-width: 90vw;
            max-height: 90vh;
            overflow: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .btn-primary {
            background: linear-gradient(90deg, #10b981, #3b82f6);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #059669, #2563eb);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.5);
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .input-with-icon {
            padding-left: 2.5rem;
        }
    </style>

    @stack('styles')
</head>
<body class="gradient-bg min-h-screen" x-data="adminData()">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="glass-nav sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                <i data-lucide="layout-dashboard" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-slate-900">Admin Dashboard</h1>
                                <p class="text-xs text-slate-500">Ponpes Miftahul Huda</p>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-0.5">
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center px-2 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 transition-all duration-200">
                            <i data-lucide="home" class="w-4 h-4 mr-1"></i>
                            Dashboard
                        </a>

                        <a href="{{ route('admin.news.index') }}"
                           class="nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }} flex items-center px-2 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 transition-all duration-200">
                            <i data-lucide="newspaper" class="w-4 h-4 mr-1"></i>
                            Berita
                        </a>

                        <a href="{{ route('admin.registration.index') }}"
                           class="nav-item {{ request()->routeIs('admin.registration.*') ? 'active' : '' }} flex items-center px-2 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 transition-all duration-200">
                            <i data-lucide="user-plus" class="w-4 h-4 mr-1"></i>
                            Pendaftaran
                        </a>

                        <a href="{{ route('admin.activities.index') }}"
                           class="nav-item {{ request()->routeIs('admin.activities.*') || request()->routeIs('admin.galleries.*') ? 'active' : '' }} flex items-center px-2 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 transition-all duration-200">
                            <i data-lucide="images" class="w-4 h-4 mr-1"></i>
                            Foto Kegiatan
                        </a>

                        <button
                            @click="openPasswordModal = true"
                            class="nav-item flex items-center px-2 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 transition-all duration-200"
                        >
                            <i data-lucide="key" class="w-4 h-4 mr-1"></i>
                            Password
                        </button>

                        <form action="{{ route('admin.logout') }}" method="POST" class="flex" id="logout-form">
                            @csrf
                            <button
                                type="button"
                                onclick="confirmLogout()"
                                class="nav-item flex items-center px-2 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-red-600 transition-all duration-200"
                            >
                                <i data-lucide="log-out" class="w-4 h-4 mr-1"></i>
                                Logout
                            </button>
                        </form>
                    </div>

                    <!-- User Profile (Desktop) -->
                    <div class="hidden md:flex items-center">
                        <div class="relative ml-4 pl-4 border-l border-slate-200">
                            <button class="flex items-center focus:outline-none" @click="userMenuOpen = !userMenuOpen">
                                <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <i data-lucide="user" class="w-4 h-4 text-white"></i>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-slate-500">Administrator</p>
                                </div>
                                <i data-lucide="chevron-down" class="w-4 h-4 ml-2 text-slate-400"></i>
                            </button>

                            <!-- User Dropdown Menu -->
                            <div
                                x-show="userMenuOpen"
                                @click.away="userMenuOpen = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50"
                                x-cloak
                            >
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                    <i data-lucide="user" class="w-4 h-4 inline mr-2"></i> Profil
                                </a>
                                <a href="#" @click.prevent="openPasswordModal = true; userMenuOpen = false" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                    <i data-lucide="key" class="w-4 h-4 inline mr-2"></i> Ganti Password
                                </a>
                                <hr class="my-1">
                                <button
                                    onclick="confirmLogout()"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                >
                                    <i data-lucide="log-out" class="w-4 h-4 inline mr-2"></i> Logout
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="flex items-center md:hidden">
                        <button
                            @click="mobileMenu = !mobileMenu"
                            class="inline-flex items-center justify-center p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-all duration-200"
                        >
                            <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenu"></i>
                            <i data-lucide="x" class="w-6 h-6" x-show="mobileMenu" x-cloak></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div
                class="md:hidden bg-white/90 backdrop-blur-md border-t border-slate-200"
                x-show="mobileMenu"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
            >
                <div class="px-4 pt-2 pb-3 space-y-1">
                    <!-- User Profile (Mobile) -->
                    <div class="flex items-center p-3 mb-2 border-b border-slate-200">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-full flex items-center justify-center">
                            <i data-lucide="user" class="w-5 h-5 text-white"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-slate-500">Administrator</p>
                        </div>
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                       class="mobile-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900">
                        <i data-lucide="home" class="w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.news.index') }}"
                       class="mobile-nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }} flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900">
                        <i data-lucide="newspaper" class="w-5 h-5 mr-3"></i>
                        Kelola Berita
                    </a>

                    <a href="{{ route('admin.registration.index') }}"
                       class="mobile-nav-item {{ request()->routeIs('admin.registration.*') ? 'active' : '' }} flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900">
                        <i data-lucide="user-plus" class="w-5 h-5 mr-3"></i>
                        Kelola Pendaftaran
                    </a>

                    <a href="{{ route('admin.activities.index') }}"
                       class="mobile-nav-item {{ request()->routeIs('admin.activities.*') || request()->routeIs('admin.galleries.*') ? 'active' : '' }} flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900">
                        <i data-lucide="images" class="w-5 h-5 mr-3"></i>
                        Kelola Foto Kegiatan
                    </a>

                    <button
                        @click="openPasswordModal = true; mobileMenu = false"
                        class="mobile-nav-item flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900"
                    >
                        <i data-lucide="key" class="w-5 h-5 mr-3"></i>
                        Ganti Password
                    </button>

                    <button
                        onclick="confirmLogout()"
                        class="mobile-nav-item flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-red-600 hover:text-red-700"
                    >
                        <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                        Logout
                    </button>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white/80 backdrop-blur-md border-t border-slate-200 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <p class="text-sm text-slate-600">
                            &copy; {{ date('Y') }} Ponpes Miftahul Huda. All rights reserved.
                        </p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-500 hover:text-slate-700 transition-colors duration-200">
                            <i data-lucide="help-circle" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="text-slate-500 hover:text-slate-700 transition-colors duration-200">
                            <i data-lucide="settings" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="text-slate-500 hover:text-slate-700 transition-colors duration-200">
                            <i data-lucide="globe" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Password Change Modal -->
    <div
        id="passwordModal"
        class="modal-overlay"
        :class="{'active': openPasswordModal}"
        @click="if($event.target.id === 'passwordModal') openPasswordModal = false"
    >
        <div class="modal-content w-full max-w-md mx-4">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <i data-lucide="key" class="w-5 h-5 mr-2 text-emerald-600"></i>
                        Ganti Password
                    </h3>
                    <button @click="openPasswordModal = false" class="text-slate-400 hover:text-slate-600 transition-colors duration-200">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('admin.password.update') }}" method="POST" @submit="handlePasswordSubmit($event)">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="relative">
                        <label for="current_password" class="block text-sm font-medium text-slate-700 mb-2">
                            <i data-lucide="lock" class="w-4 h-4 inline mr-1"></i>
                            Password Saat Ini
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="current_password"
                                id="current_password"
                                required
                                class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                x-model="passwordForm.currentPassword"
                            >
                        </div>
                    </div>

                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            <i data-lucide="key" class="w-4 h-4 inline mr-1"></i>
                            Password Baru
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                x-model="passwordForm.newPassword"
                            >
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Minimal 8 karakter</p>
                    </div>

                    <div class="relative">
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                            <i data-lucide="check" class="w-4 h-4 inline mr-1"></i>
                            Konfirmasi Password Baru
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                class="input-field block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                x-model="passwordForm.confirmPassword"
                            >
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-slate-200 flex justify-end space-x-3">
                    <button
                        type="button"
                        @click="openPasswordModal = false"
                        class="btn-secondary px-4 py-2 rounded-lg"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="btn-primary px-4 py-2 rounded-lg"
                        :disabled="loading"
                    >
                        <span x-show="!loading">Update Password</span>
                        <span x-show="loading" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Alpine.js data
        function adminData() {
            return {
                mobileMenu: false,
                userMenuOpen: false,
                openPasswordModal: false,
                loading: false,
                passwordForm: {
                    currentPassword: '',
                    newPassword: '',
                    confirmPassword: ''
                },

                handlePasswordSubmit(event) {
                    if (this.passwordForm.newPassword !== this.passwordForm.confirmPassword) {
                        event.preventDefault();
                        showAlert('error', 'Password baru dan konfirmasi password tidak cocok');
                        return;
                    }

                    if (this.passwordForm.newPassword.length < 8) {
                        event.preventDefault();
                        showAlert('error', 'Password baru minimal 8 karakter');
                        return;
                    }

                    this.loading = true;
                    // Form will submit normally
                }
            }
        }

        // Confirm logout
        function confirmLogout() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar dari sistem?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

        // Show alert
        function showAlert(type, message) {
            const icons = {
                success: 'success',
                error: 'error',
                warning: 'warning',
                info: 'info'
            };

            Swal.fire({
                icon: icons[type],
                title: type === 'success' ? 'Berhasil!' : type === 'error' ? 'Error!' : 'Informasi',
                text: message,
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Show success message if exists
            @if(session('success'))
                showAlert('success', "{{ session('success') }}");
            @endif

            @if(session('error'))
                showAlert('error', "{{ session('error') }}");
            @endif

            // Open password modal if there are validation errors
            @if($errors->any())
                setTimeout(function() {
                    window.dispatchEvent(new CustomEvent('alpine:init'));
                    const adminDataInstance = Alpine.evaluate(document.querySelector('[x-data]'), 'adminData()');
                    adminDataInstance.openPasswordModal = true;

                    // Show error message
                    showAlert('error', "{{ $errors->first() }}");
                }, 500);
            @endif

            // Re-initialize icons after Alpine.js updates
            setTimeout(() => {
                lucide.createIcons();
            }, 100);
        });

        // Re-initialize icons when Alpine.js updates the DOM
        document.addEventListener('alpine:updated', () => {
            lucide.createIcons();
        });
    </script>

    @stack('scripts')
</body>
</html>
