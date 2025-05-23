<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Ponpes Miftahul Huda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100" x-data="{ openPasswordModal: false, mobileMenu: false }">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo dan Tombol Menu Mobile -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-xl font-semibold">Admin Dashboard</span>
                        </div>
                    </div>

                    <!-- Menu Desktop -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="#" class="text-gray-600 hover:text-gray-900 flex items-center px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-home mr-1"></i> Dashboard
                        </a>
                        <button 
                            @click="openPasswordModal = true" 
                            class="text-gray-600 hover:text-gray-900 flex items-center px-3 py-2 rounded-md text-sm font-medium"
                        >
                            <i class="fas fa-key mr-1"></i> Ganti Password
                        </button>
                        <form action="{{ route('admin.logout') }}" method="POST" class="flex">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900 flex items-center px-3 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    </div>

                    <!-- Tombol Menu Mobile -->
                    <div class="flex items-center md:hidden">
                        <button 
                            @click="mobileMenu = !mobileMenu" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        >
                            <span class="sr-only">Buka menu utama</span>
                            <i class="fas fa-bars text-xl" x-show="!mobileMenu"></i>
                            <i class="fas fa-times text-xl" x-show="mobileMenu" x-cloak></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div class="md:hidden" x-show="mobileMenu" x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="#" class="text-gray-600 hover:text-gray-900 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <button 
                        @click="openPasswordModal = true; mobileMenu = false" 
                        class="text-gray-600 hover:text-gray-900 hover:bg-gray-100 block w-full text-left px-3 py-2 rounded-md text-base font-medium"
                    >
                        <i class="fas fa-key mr-2"></i> Ganti Password
                    </button>
                    <form action="{{ route('admin.logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900 hover:bg-gray-100 block w-full text-left px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Konten Dashboard -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium mb-6">Selamat Datang di Dashboard Admin</h2>
                <p>Silahkan gunakan menu di atas untuk mengelola sistem.</p>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- Dashboard Cards -->
            <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- News Management Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <i class="fas fa-newspaper text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Kelola Berita
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            Berita & Pengumuman
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.news.index') }}" class="font-medium text-green-700 hover:text-green-900">
                                Kelola Berita <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Registration Management Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-user-plus text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Kelola Pendaftaran
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            Halaman Pendaftaran
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.registration.index') }}" class="font-medium text-blue-700 hover:text-blue-900">
                                Kelola Pendaftaran <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kelola Foto Kegiatan -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <i class="fas fa-images text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Kelola Foto Kegiatan
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            Galeri Foto Kegiatan
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.activities.index') }}" class="font-medium text-yellow-700 hover:text-yellow-900">
                                Kelola Foto Kegiatan <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ganti Password -->
    <div 
        x-cloak
        x-show="openPasswordModal" 
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div 
            @click.away="openPasswordModal = false"
            class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Ganti Password</h3>
                <button @click="openPasswordModal = false" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                        <input type="password" name="current_password" id="current_password" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" name="password" id="password" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Jika ada error, buka modal password
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                window.dispatchEvent(new CustomEvent('alpine:init'));
                setTimeout(function() {
                    window.Alpine.store('openPasswordModal', true);
                }, 100);
            });
        @endif
    </script>
</body>
</html> 