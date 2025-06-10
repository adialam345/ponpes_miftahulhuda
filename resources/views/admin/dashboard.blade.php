<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Ponpes Miftahul Huda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notification-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen" x-data="dashboardData()">

    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                            <i data-lucide="home" class="w-5 h-5 text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-900">Admin Dashboard</h1>
                            <p class="text-xs text-slate-500">Ponpes Miftahul Huda</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-2">
                    <button class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-white/50 transition-all duration-200">
                        <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                        Dashboard
                    </button>

                    <button
                        @click="openPasswordModal = true"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-white/50 transition-all duration-200"
                    >
                        <i data-lucide="key" class="w-4 h-4 mr-2"></i>
                        Ganti Password
                    </button>

                    <button
                        @click="handleLogout()"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200"
                    >
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                        Logout
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center ml-4 pl-4 border-l border-slate-200">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-full flex items-center justify-center">
                            <i data-lucide="user" class="w-4 h-4 text-white"></i>
                        </div>
                        <div class="ml-2">
                            <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-slate-500">Administrator</p>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button
                        @click="mobileMenu = !mobileMenu"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-white/50 transition-all duration-200"
                    >
                        <i data-lucide="menu" class="w-5 h-5" x-show="!mobileMenu"></i>
                        <i data-lucide="x" class="w-5 h-5" x-show="mobileMenu" x-cloak></i>
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
                <button class="flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900 hover:bg-white/50">
                    <i data-lucide="home" class="w-4 h-4 mr-3"></i>
                    Dashboard
                </button>
                <button
                    @click="openPasswordModal = true; mobileMenu = false"
                    class="flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900 hover:bg-white/50"
                >
                    <i data-lucide="key" class="w-4 h-4 mr-3"></i>
                    Ganti Password
                </button>
                <button
                    @click="handleLogout()"
                    class="flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-red-600 hover:bg-red-50"
                >
                    <i data-lucide="log-out" class="w-4 h-4 mr-3"></i>
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <!-- Welcome Section -->
        <div class="mb-8 animate-fade-in">
            <div class="bg-gradient-to-r from-emerald-500 to-blue-600 rounded-2xl shadow-xl text-white overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold mb-2">Selamat Datang di Dashboard Admin</h2>
                            <p class="text-emerald-100 text-lg">Kelola sistem Ponpes Miftahul Huda dengan mudah dan efisien</p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                <i data-lucide="settings" class="w-10 h-10 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-2 bg-gradient-to-r from-emerald-400 to-blue-500"></div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Total News -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Total Berita</p>
                        <p class="text-3xl font-bold text-slate-900">{{ $totalNews ?? 0 }}</p>
                        <p class="text-xs {{ ($newsThisMonth ?? 0) > 0 ? 'text-emerald-600' : 'text-slate-600' }} mt-1">
                            <i data-lucide="{{ ($newsThisMonth ?? 0) > 0 ? 'trending-up' : 'minus' }}" class="w-3 h-3 inline mr-1"></i>
                            {{ ($newsThisMonth ?? 0) > 0 ? "+$newsThisMonth bulan ini" : "Tidak ada perubahan" }}
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="newspaper" class="w-6 h-6 text-emerald-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Activity Photos -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Foto Kegiatan</p>
                        <p class="text-3xl font-bold text-slate-900">{{ $totalActivityPhotos ?? 0 }}</p>
                        <p class="text-xs {{ ($activityPhotosToday ?? 0) > 0 ? 'text-emerald-600' : 'text-slate-600' }} mt-1">
                            <i data-lucide="{{ ($activityPhotosToday ?? 0) > 0 ? 'trending-up' : 'minus' }}" class="w-3 h-3 inline mr-1"></i>
                            {{ ($activityPhotosToday ?? 0) > 0 ? "+$activityPhotosToday hari ini" : "Tidak ada perubahan" }}
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="image" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- News Management -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover group">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <i data-lucide="newspaper" class="w-7 h-7 text-white"></i>
                        </div>
                        <span class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $totalNews ?? 12 }} Berita
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Kelola Berita</h3>
                    <p class="text-sm text-slate-600 mb-4">Kelola berita dan pengumuman untuk website</p>
                    <button
                        onclick="navigateWithAlert('{{ route('admin.news.index') }}', 'Menuju halaman kelola berita')"
                        class="w-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-medium py-2 px-4 rounded-lg transition-all duration-200 flex items-center justify-center group"
                    >
                        Kelola Sekarang
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </button>
                </div>
            </div>

            <!-- Registration Management -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover group">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <i data-lucide="user-plus" class="w-7 h-7 text-white"></i>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $totalRegistrations ?? 45 }} Pendaftar
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Kelola Pendaftaran</h3>
                    <p class="text-sm text-slate-600 mb-4">Kelola data pendaftaran santri baru</p>
                    <button
                        onclick="navigateWithAlert('{{ route('admin.registration.index') }}', 'Menuju halaman kelola pendaftaran')"
                        class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium py-2 px-4 rounded-lg transition-all duration-200 flex items-center justify-center group"
                    >
                        Kelola Sekarang
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </button>
                </div>
            </div>

            <!-- Activity Photos Management -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover group">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <i data-lucide="images" class="w-7 h-7 text-white"></i>
                        </div>
                        <span class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $totalPhotos ?? 28 }} Foto
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Kelola Foto Kegiatan</h3>
                    <p class="text-sm text-slate-600 mb-4">Kelola galeri foto kegiatan ponpes</p>
                    <button
                        onclick="navigateWithAlert('{{ route('admin.activities.index') }}', 'Menuju halaman kelola foto kegiatan')"
                        class="w-full bg-amber-50 hover:bg-amber-100 text-amber-700 font-medium py-2 px-4 rounded-lg transition-all duration-200 flex items-center justify-center group"
                    >
                        Kelola Sekarang
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                        <h3 class="text-lg font-semibold text-slate-900">Aktivitas Terbaru</h3>
                    <p class="text-sm text-slate-600">Pantau aktivitas terbaru di sistem</p>
                    </div>
                <div class="flex items-center">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse mr-2"></span>
                    <span class="text-xs font-medium text-emerald-600">Live</span>
                </div>
            </div>

            <!-- Activity List -->
                <div class="space-y-4">
                @forelse($recentActivities ?? [] as $activity)
                <div class="flex items-start space-x-4 p-4 bg-slate-50 rounded-lg">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                        <i data-lucide="activity" class="w-5 h-5 text-emerald-600"></i>
                        </div>
                        <div class="flex-1">
                        <p class="text-sm font-medium text-slate-900">{{ $activity->title }}</p>
                        <p class="text-xs text-slate-600">{{ $activity->created_at->diffForHumans() }}</p>
                        @if($activity->galleries->count() > 0)
                        <p class="text-xs text-blue-600 mt-1">
                            <i data-lucide="image" class="w-3 h-3 inline mr-1"></i>
                            {{ $activity->galleries->count() }} foto ditambahkan
                        </p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <p class="text-sm text-slate-600">Belum ada aktivitas terbaru</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    <div
        x-cloak
        x-show="openPasswordModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div
            @click.away="openPasswordModal = false"
            class="bg-white rounded-xl shadow-2xl w-full max-w-md"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i data-lucide="key" class="w-5 h-5 text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Ganti Password</h3>
                            <p class="text-sm text-slate-600">Masukkan password lama dan password baru</p>
                        </div>
                    </div>
                    <button @click="openPasswordModal = false" class="text-slate-400 hover:text-slate-500 transition-colors duration-200">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form @submit.prevent="handlePasswordChange()" class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-slate-700 mb-1">Password Saat Ini</label>
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            x-model="passwordForm.currentPassword"
                            required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Masukkan password saat ini"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            x-model="passwordForm.newPassword"
                            required
                            minlength="8"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Masukkan password baru (min. 8 karakter)"
                        >
                        <p class="text-xs text-slate-500 mt-1">Minimal 8 karakter</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password Baru</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            x-model="passwordForm.confirmPassword"
                            required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Konfirmasi password baru"
                        >
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button
                            type="button"
                            @click="openPasswordModal = false"
                            class="flex-1 px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors duration-200"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200"
                            :disabled="loading"
                        >
                            <span x-show="!loading">Update Password</span>
                            <span x-show="loading" class="flex items-center justify-center">
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
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-4 right-4 z-50 bg-emerald-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-4 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Alpine.js data
        function dashboardData() {
            return {
                openPasswordModal: false,
                mobileMenu: false,
                loading: false,
                passwordForm: {
                    currentPassword: '',
                    newPassword: '',
                    confirmPassword: ''
                },

                async handlePasswordChange() {
                    if (this.passwordForm.newPassword !== this.passwordForm.confirmPassword) {
                        showAlert('error', 'Password baru dan konfirmasi password tidak cocok');
                        return;
                    }

                    if (this.passwordForm.newPassword.length < 8) {
                        showAlert('error', 'Password baru minimal 8 karakter');
                        return;
                    }

                    this.loading = true;

                    try {
                        const response = await fetch('{{ route("admin.password.update") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                current_password: this.passwordForm.currentPassword,
                                password: this.passwordForm.newPassword,
                                password_confirmation: this.passwordForm.confirmPassword
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            showAlert('success', 'Password berhasil diubah');
                            this.openPasswordModal = false;
                            this.passwordForm = {
                                currentPassword: '',
                                newPassword: '',
                                confirmPassword: ''
                            };
                        } else {
                            showAlert('error', data.message || 'Gagal mengubah password');
                        }
                    } catch (error) {
                        showAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
                    } finally {
                        this.loading = false;
                    }
                },

                async handleLogout() {
                    const result = await Swal.fire({
                        title: 'Konfirmasi Logout',
                        text: 'Apakah Anda yakin ingin keluar dari sistem?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    });

                    if (result.isConfirmed) {
                        showAlert('info', 'Sedang logout...');

                        // Submit logout form
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route("admin.logout") }}';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        form.appendChild(csrfToken);
                        document.body.appendChild(form);
                        form.submit();
                    }
                }
            }
        }

        // Alert functions
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

        function navigateWithAlert(url, message) {
            showAlert('info', message);
            setTimeout(() => {
                window.location.href = url;
            }, 1000);
        }

        // Auto-hide flash messages
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showAlert('success', '{{ session("success") }}');
            @endif

            @if(session('error'))
                showAlert('error', '{{ session("error") }}');
            @endif

            @if($errors->any())
                showAlert('error', '{{ $errors->first() }}');
                // Open password modal if there are validation errors
                setTimeout(() => {
                    window.Alpine.store('openPasswordModal', true);
                }, 500);
            @endif
        });
    </script>
</body>
</html>
