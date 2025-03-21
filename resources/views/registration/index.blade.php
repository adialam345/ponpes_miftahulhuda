@extends('layouts.app')

@section('title', 'Pendaftaran - Pondok Pesantren Miftahul Huda')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-success">Informasi Pendaftaran</h1>
        <p class="lead">Informasi lengkap mengenai pendaftaran santri baru di Pondok Pesantren Miftahul Huda</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title text-success">Pendaftaran Pondok</h3>
                        @if($pondokPage && \App\Http\Controllers\RegistrationController::isRegistrationOpen($pondokPage))
                            <span class="badge bg-success">Pendaftaran Dibuka</span>
                        @else
                            <span class="badge bg-secondary">Pendaftaran Ditutup</span>
                        @endif
                    </div>
                    <p class="card-text">Informasi pendaftaran santri baru untuk Pondok Pesantren Miftahul Huda</p>
                    <a href="{{ route('registration.show', ['type' => 'pondok']) }}" class="btn btn-outline-success mt-3">Lihat Informasi</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title text-primary">Pendaftaran SMP</h3>
                        @if($smpPage && \App\Http\Controllers\RegistrationController::isRegistrationOpen($smpPage))
                            <span class="badge bg-success">Pendaftaran Dibuka</span>
                        @else
                            <span class="badge bg-secondary">Pendaftaran Ditutup</span>
                        @endif
                    </div>
                    <p class="card-text">Informasi pendaftaran siswa baru untuk SMP Miftahul Huda</p>
                    <a href="{{ route('registration.show', ['type' => 'smp']) }}" class="btn btn-outline-primary mt-3">Lihat Informasi</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-light rounded shadow-sm">
        <h3 class="text-success mb-4">Kontak Informasi</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success p-3 rounded-circle text-white">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="ms-3">
                        <h5>Telepon</h5>
                        <p class="mb-0">+62 812-3456-7890</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success p-3 rounded-circle text-white">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="ms-3">
                        <h5>Email</h5>
                        <p class="mb-0">info@miftahulhuda.sch.id</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success p-3 rounded-circle text-white">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="ms-3">
                        <h5>Alamat</h5>
                        <p class="mb-0">Jl. Pondok Pesantren No. 123, Sleman, Yogyakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 