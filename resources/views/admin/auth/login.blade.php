<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Ponpes Miftahul Huda</title>
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
            background: linear-gradient(135deg, #0f766e 0%, #1e40af 50%, #7c3aed 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            left: 80%;
            animation-delay: 5s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 50%;
            animation-delay: 10s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            left: 20%;
            animation-delay: 15s;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }

        .logo-animation {
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen relative overflow-hidden" x-data="loginData()">

    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full space-y-8">

            <!-- Logo and Header -->
            <div class="text-center fade-in">
                <div class="logo-animation inline-block">
                    <div class="w-20 h-20 bg-white rounded-full shadow-2xl flex items-center justify-center mx-auto mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-full flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-white mb-2">
                    Admin Login
                </h2>
                <p class="text-xl text-white/80 font-medium">
                    Ponpes Miftahul Huda
                </p>
                <p class="text-sm text-white/60 mt-2">
                    Masuk ke sistem administrasi
                </p>
            </div>

            <!-- Login Form -->
            <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in" style="animation-delay: 0.2s;">

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                        <div class="flex items-center">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                        </div>
                        <ul class="mt-2 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center mt-1">
                                    <i data-lucide="x-circle" class="w-3 h-3 mr-2"></i>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                        <div class="flex items-center">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-2"></i>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg">
                        <div class="flex items-center">
                            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 mr-2"></i>
                            <p class="text-sm text-emerald-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form @submit.prevent="handleLogin()" class="space-y-6">
                    @csrf

                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-2">
                            <i data-lucide="user" class="w-4 h-4 inline mr-2"></i>
                            Username
                        </label>
                        <div class="relative">
                            <input
                                id="username"
                                name="username"
                                type="text"
                                x-model="form.username"
                                required
                                class="input-focus appearance-none relative block w-full px-4 py-3 pl-12 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                placeholder="Masukkan username Anda"
                                value="{{ old('username') }}"
                                :disabled="loading"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-5 h-5 text-slate-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            <i data-lucide="lock" class="w-4 h-4 inline mr-2"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                x-model="form.password"
                                required
                                class="input-focus appearance-none relative block w-full px-4 py-3 pl-12 pr-12 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                placeholder="Masukkan password Anda"
                                :disabled="loading"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
                            </div>
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors duration-200"
                                :disabled="loading"
                            >
                                <i :data-lucide="showPassword ? 'eye-off' : 'eye'" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                x-model="form.remember"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded"
                                :disabled="loading"
                            >
                            <label for="remember" class="ml-2 block text-sm text-slate-700">
                                Ingat saya
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="btn-hover group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                            :disabled="loading"
                        >
                            <span x-show="!loading" class="flex items-center">
                                <i data-lucide="log-in" class="w-4 h-4 mr-2"></i>
                                Masuk ke Dashboard
                            </span>
                            <span x-show="loading" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sedang masuk...
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Additional Info -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-slate-500">
                        Sistem Administrasi Ponpes Miftahul Huda
                    </p>
                    <p class="text-xs text-slate-400 mt-1">
                        © 2025 - Semua hak dilindungi
                    </p>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="text-center fade-in" style="animation-delay: 0.4s;">
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white/80 text-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i>
                    Koneksi aman dan terenkripsi
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div
        x-show="loading"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="bg-white rounded-xl p-6 shadow-2xl">
            <div class="flex items-center space-x-3">
                <svg class="animate-spin h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-slate-700 font-medium">Memverifikasi kredensial...</span>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Alpine.js data
        function loginData() {
            return {
                showPassword: false,
                loading: false,
                form: {
                    username: '{{ old("username") }}',
                    password: '',
                    remember: false
                },

                async handleLogin() {
                    if (!this.form.username || !this.form.password) {
                        this.showAlert('error', 'Username dan password harus diisi');
                        return;
                    }

                    this.loading = true;

                    try {
                        // Create form data
                        const formData = new FormData();
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        formData.append('username', this.form.username);
                        formData.append('password', this.form.password);
                        if (this.form.remember) {
                            formData.append('remember', '1');
                        }

                        const response = await fetch('{{ route("admin.login") }}', {
                            method: 'POST',
                            body: formData
                        });

                        if (response.ok) {
                            this.showAlert('success', 'Login berhasil! Mengalihkan ke dashboard...');

                            setTimeout(() => {
                                window.location.href = '{{ route("admin.dashboard") }}';
                            }, 1500);
                        } else {
                            const data = await response.text();

                            // If response is HTML (redirect with errors), reload the page
                            if (data.includes('<!DOCTYPE html>')) {
                                window.location.reload();
                            } else {
                                this.showAlert('error', 'Username atau password salah');
                            }
                        }
                    } catch (error) {
                        console.error('Login error:', error);
                        this.showAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
                    } finally {
                        this.loading = false;
                    }
                },

                showAlert(type, message) {
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
                        timer: type === 'success' ? 2000 : 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        background: type === 'success' ? '#f0fdf4' : type === 'error' ? '#fef2f2' : '#f8fafc',
                        color: type === 'success' ? '#166534' : type === 'error' ? '#dc2626' : '#475569'
                    });
                }
            }
        }

        // Auto-show alerts for server-side messages
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session("error") }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: '{{ $errors->first() }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
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
</body>
</html>
