@extends('layouts.admin')

@section('title', 'Kelola Halaman Pendaftaran - Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50">
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 animate-fade-in">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-cyan-600 bg-clip-text text-transparent">
                            Kelola Halaman Pendaftaran
                        </h1>
                        <p class="mt-2 text-gray-600">
                            Kelola halaman pendaftaran untuk Pondok Pesantren dan SMP
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('admin.registration.create') }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-cyan-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Halaman Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 animate-slide-down">
                <div class="bg-gradient-to-r from-emerald-50 to-cyan-50 border border-emerald-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                        </div>
                        <div class="ml-4">
                            <button type="button" onclick="this.closest('.animate-slide-down').remove()"
                                    class="text-emerald-500 hover:text-emerald-700 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Registration Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Pondok Registration Card -->
                <div class="group animate-fade-in-up" style="animation-delay: 0.1s;">
                    @php
                        $pondokPage = $registrationPages->where('page_type', 'pondok')->first();
                        $isOpen = $pondokPage ? \App\Http\Controllers\RegistrationController::isRegistrationOpen($pondokPage) : false;
                    @endphp

                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group-hover:border-emerald-200">
                        <!-- Card Header -->
                        <div class="relative bg-gradient-to-br from-emerald-500 to-emerald-600 p-6 text-white">
                            <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-full h-full">
                                    <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"/>
                                </svg>
                            </div>
                            <div class="relative">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold">Pendaftaran Pondok</h3>
                                        <p class="text-emerald-100 mt-1">Pondok Pesantren Miftahul Huda</p>
                                    </div>
                                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="mt-4">
                                    @if($pondokPage)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $isOpen ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            <span class="w-2 h-2 rounded-full mr-2 {{ $isOpen ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                            {{ $isOpen ? 'Pendaftaran Terbuka' : 'Pendaftaran Tertutup' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <span class="w-2 h-2 bg-red-400 rounded-full mr-2"></span>
                                            Belum Dibuat
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            @if($pondokPage)
                                <!-- Registration Period -->
                                <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="font-medium">Periode Pendaftaran</span>
                                    </div>
                                    <div class="text-gray-800">
                                        @if($pondokPage->registration_start && $pondokPage->registration_end)
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($pondokPage->registration_start)->format('d M Y') }}</span>
                                            <span class="mx-2 text-gray-400">—</span>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($pondokPage->registration_end)->format('d M Y') }}</span>
                                        @else
                                            <span class="text-gray-500 italic">Periode belum diatur</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content Preview -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Preview Konten</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($pondokPage->content), 120) }}
                                    </p>
                                </div>

                                <!-- Last Updated -->
                                <div class="flex items-center text-xs text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Terakhir diperbarui: {{ $pondokPage->updated_at->format('d M Y, H:i') }}
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-gray-500 mb-2">Halaman pendaftaran pondok belum dibuat</p>
                                    <p class="text-sm text-gray-400">Klik tombol "Buat Halaman" untuk memulai</p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Actions -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <!-- View Page Link -->
                                <a href="{{ $pondokPage ? route('registration.show', ['type' => 'pondok']) : '#' }}"
                                   class="inline-flex items-center text-sm font-medium {{ $pondokPage ? 'text-emerald-600 hover:text-emerald-700' : 'text-gray-400 cursor-not-allowed' }} transition-colors duration-200"
                                   {{ $pondokPage ? 'target=_blank' : '' }}>
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Lihat Halaman
                                </a>

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    @if($pondokPage)
                                        <a href="{{ route('admin.registration.edit', $pondokPage->id) }}"
                                           class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="{{ route('admin.registration.show', $pondokPage->id) }}"
                                           class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 text-gray-700 text-xs font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail
                                        </a>
                                    @else
                                        <a href="{{ route('admin.registration.create') }}?type=pondok"
                                           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200 shadow-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Buat Halaman
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SMP Registration Card -->
                <div class="group animate-fade-in-up" style="animation-delay: 0.2s;">
                    @php
                        $smpPage = $registrationPages->where('page_type', 'smp')->first();
                        $isOpen = $smpPage ? \App\Http\Controllers\RegistrationController::isRegistrationOpen($smpPage) : false;
                    @endphp

                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group-hover:border-cyan-200">
                        <!-- Card Header -->
                        <div class="relative bg-gradient-to-br from-cyan-500 to-blue-600 p-6 text-white">
                            <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-full h-full">
                                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                                </svg>
                            </div>
                            <div class="relative">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold">Pendaftaran SMP</h3>
                                        <p class="text-cyan-100 mt-1">SMP Miftahul Huda</p>
                                    </div>
                                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="mt-4">
                                    @if($smpPage)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $isOpen ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            <span class="w-2 h-2 rounded-full mr-2 {{ $isOpen ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                            {{ $isOpen ? 'Pendaftaran Terbuka' : 'Pendaftaran Tertutup' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <span class="w-2 h-2 bg-red-400 rounded-full mr-2"></span>
                                            Belum Dibuat
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            @if($smpPage)
                                <!-- Registration Period -->
                                <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="font-medium">Periode Pendaftaran</span>
                                    </div>
                                    <div class="text-gray-800">
                                        @if($smpPage->registration_start && $smpPage->registration_end)
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($smpPage->registration_start)->format('d M Y') }}</span>
                                            <span class="mx-2 text-gray-400">—</span>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($smpPage->registration_end)->format('d M Y') }}</span>
                                        @else
                                            <span class="text-gray-500 italic">Periode belum diatur</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content Preview -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Preview Konten</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($smpPage->content), 120) }}
                                    </p>
                                </div>

                                <!-- Last Updated -->
                                <div class="flex items-center text-xs text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Terakhir diperbarui: {{ $smpPage->updated_at->format('d M Y, H:i') }}
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-gray-500 mb-2">Halaman pendaftaran SMP belum dibuat</p>
                                    <p class="text-sm text-gray-400">Klik tombol "Buat Halaman" untuk memulai</p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Actions -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <!-- View Page Link -->
                                <a href="{{ $smpPage ? route('registration.show', ['type' => 'smp']) : '#' }}"
                                   class="inline-flex items-center text-sm font-medium {{ $smpPage ? 'text-cyan-600 hover:text-cyan-700' : 'text-gray-400 cursor-not-allowed' }} transition-colors duration-200"
                                   {{ $smpPage ? 'target=_blank' : '' }}>
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Lihat Halaman
                                </a>

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    @if($smpPage)
                                        <a href="{{ route('admin.registration.edit', $smpPage->id) }}"
                                           class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="{{ route('admin.registration.show', $smpPage->id) }}"
                                           class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 text-gray-700 text-xs font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail
                                        </a>
                                    @else
                                        <a href="{{ route('admin.registration.create') }}?type=smp"
                                           class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white text-sm font-medium rounded-lg hover:bg-cyan-700 transition-colors duration-200 shadow-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Buat Halaman
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="mt-12 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Pendaftaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center p-4 bg-gradient-to-br from-emerald-50 to-cyan-50 rounded-xl">
                            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">{{ $registrationPages->count() }}</div>
                            <div class="text-sm text-gray-600">Total Halaman</div>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">
                                {{ $registrationPages->filter(function($page) {
                                    return \App\Http\Controllers\RegistrationController::isRegistrationOpen($page);
                                })->count() }}
                            </div>
                            <div class="text-sm text-gray-600">Pendaftaran Aktif</div>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">
                                @if($registrationPages->count() > 0)
                                    {{ $registrationPages->max('updated_at')->diffForHumans() }}
                                @else
                                    -
                                @endif
                            </div>
                            <div class="text-sm text-gray-600">Terakhir Update</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-down {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out forwards;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
    opacity: 0;
}

.animate-slide-down {
    animation: slide-down 0.4s ease-out forwards;
}

.group:hover .group-hover\:border-emerald-200 {
    border-color: rgb(167 243 208);
}

.group:hover .group-hover\:border-cyan-200 {
    border-color: rgb(165 243 252);
}
</style>
@endsection
