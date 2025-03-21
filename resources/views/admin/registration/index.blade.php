@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Kelola Halaman Pendaftaran</h1>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="py-4">
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Daftar Halaman Pendaftaran
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Kelola halaman pendaftaran untuk Pondok dan SMP.
                        </p>
                    </div>
                    <a href="{{ route('admin.registration.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-plus mr-2"></i> Tambah Baru
                    </a>
                </div>

                @if(session('success'))
                <div class="rounded-md bg-green-50 p-4 mx-4 mt-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button type="button" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                                    <span class="sr-only">Dismiss</span>
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="bg-gray-50 p-4 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Card for Pondok Registration -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Pendaftaran Pondok</h3>
                                        <div class="mt-1 flex items-center">
                                            @php
                                                $pondokPage = $registrationPages->where('page_type', 'pondok')->first();
                                                $isOpen = $pondokPage ? \App\Http\Controllers\RegistrationController::isRegistrationOpen($pondokPage) : false;
                                            @endphp
                                            
                                            @if($pondokPage)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isOpen ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $isOpen ? 'Terbuka' : 'Tertutup' }}
                                                </span>
                                                <span class="ml-2 text-sm text-gray-500">
                                                    Terakhir diperbarui: {{ $pondokPage->updated_at->format('d M Y H:i') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Belum Dibuat
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <img src="https://cdn-icons-png.flaticon.com/512/3771/3771417.png" class="h-16 w-16 text-green-600" alt="Pondok Icon">
                                </div>
                                
                                <div class="mt-4 border-t border-gray-200 pt-4">
                                    <div class="flex justify-between">
                                        <div class="space-y-2">
                                            @if($pondokPage)
                                                <span class="text-sm text-gray-500">
                                                    <i class="fas fa-calendar-alt text-gray-400 mr-1"></i>
                                                    Periode: 
                                                    @if($pondokPage->registration_start && $pondokPage->registration_end)
                                                        {{ \Carbon\Carbon::parse($pondokPage->registration_start)->format('d M Y') }} - 
                                                        {{ \Carbon\Carbon::parse($pondokPage->registration_end)->format('d M Y') }}
                                                    @else
                                                        Belum diatur
                                                    @endif
                                                </span>
                                                <p class="text-sm text-gray-500">
                                                    <i class="fas fa-align-left text-gray-400 mr-1"></i>
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($pondokPage->content), 50) }}
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-500">Belum ada informasi pendaftaran.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center border-t border-gray-200">
                                <a href="{{ $pondokPage ? route('registration.show', ['type' => 'pondok']) : '#' }}" 
                                   class="text-sm font-medium text-green-600 hover:text-green-500 {{ !$pondokPage ? 'opacity-50 cursor-not-allowed' : '' }}" 
                                   {{ !$pondokPage ? 'disabled' : '' }}
                                   target="{{ $pondokPage ? '_blank' : '_self' }}">
                                    <i class="fas fa-external-link-alt mr-1"></i> Lihat Halaman
                                </a>
                                <div class="flex space-x-3">
                                    @if($pondokPage)
                                        <a href="{{ route('admin.registration.edit', $pondokPage->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.registration.show', $pondokPage->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    @else
                                        <a href="{{ route('admin.registration.create') }}?type=pondok" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <i class="fas fa-plus mr-1"></i> Buat Baru
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card for SMP Registration -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Pendaftaran SMP</h3>
                                        <div class="mt-1 flex items-center">
                                            @php
                                                $smpPage = $registrationPages->where('page_type', 'smp')->first();
                                                $isOpen = $smpPage ? \App\Http\Controllers\RegistrationController::isRegistrationOpen($smpPage) : false;
                                            @endphp
                                            
                                            @if($smpPage)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isOpen ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $isOpen ? 'Terbuka' : 'Tertutup' }}
                                                </span>
                                                <span class="ml-2 text-sm text-gray-500">
                                                    Terakhir diperbarui: {{ $smpPage->updated_at->format('d M Y H:i') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Belum Dibuat
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <img src="https://cdn-icons-png.flaticon.com/512/2602/2602414.png" class="h-16 w-16 text-blue-600" alt="SMP Icon">
                                </div>
                                
                                <div class="mt-4 border-t border-gray-200 pt-4">
                                    <div class="flex justify-between">
                                        <div class="space-y-2">
                                            @if($smpPage)
                                                <span class="text-sm text-gray-500">
                                                    <i class="fas fa-calendar-alt text-gray-400 mr-1"></i>
                                                    Periode: 
                                                    @if($smpPage->registration_start && $smpPage->registration_end)
                                                        {{ \Carbon\Carbon::parse($smpPage->registration_start)->format('d M Y') }} - 
                                                        {{ \Carbon\Carbon::parse($smpPage->registration_end)->format('d M Y') }}
                                                    @else
                                                        Belum diatur
                                                    @endif
                                                </span>
                                                <p class="text-sm text-gray-500">
                                                    <i class="fas fa-align-left text-gray-400 mr-1"></i>
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($smpPage->content), 50) }}
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-500">Belum ada informasi pendaftaran.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center border-t border-gray-200">
                                <a href="{{ $smpPage ? route('registration.show', ['type' => 'smp']) : '#' }}" 
                                   class="text-sm font-medium text-blue-600 hover:text-blue-500 {{ !$smpPage ? 'opacity-50 cursor-not-allowed' : '' }}" 
                                   {{ !$smpPage ? 'disabled' : '' }}
                                   target="{{ $smpPage ? '_blank' : '_self' }}">
                                    <i class="fas fa-external-link-alt mr-1"></i> Lihat Halaman
                                </a>
                                <div class="flex space-x-3">
                                    @if($smpPage)
                                        <a href="{{ route('admin.registration.edit', $smpPage->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.registration.show', $smpPage->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    @else
                                        <a href="{{ route('admin.registration.create') }}?type=smp" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-plus mr-1"></i> Buat Baru
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 