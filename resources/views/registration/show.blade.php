@extends('layouts.app')

@section('title', $registrationPage->title . ' - Pondok Pesantren Miftahul Huda')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('registration.index') }}" class="text-decoration-none">Pendaftaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $registrationPage->title }}</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body p-4">
            <h1 class="card-title display-5 text-success mb-4">{{ $registrationPage->title }}</h1>
            
            @php
                $isOpen = \App\Http\Controllers\RegistrationController::isRegistrationOpen($registrationPage);
            @endphp
            
            <div class="alert {{ $isOpen ? 'alert-success' : 'alert-secondary' }} mb-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas {{ $isOpen ? 'fa-calendar-check' : 'fa-calendar-times' }} fa-2x me-3"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading mb-1">
                            {{ $isOpen ? 'Pendaftaran Sedang Dibuka' : 'Pendaftaran Ditutup' }}
                        </h5>
                        <p class="mb-0">
                            @if($registrationPage->registration_start && $registrationPage->registration_end)
                                Periode Pendaftaran: {{ \Carbon\Carbon::parse($registrationPage->registration_start)->format('d F Y') }} - 
                                {{ \Carbon\Carbon::parse($registrationPage->registration_end)->format('d F Y') }}
                            @else
                                Periode pendaftaran belum ditentukan
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="content-section mb-5">
                <h3 class="text-success mb-3">Informasi Pendaftaran</h3>
                <div class="p-6">
                    <div class="prose max-w-none prose-headings:font-semibold prose-h3:text-lg prose-p:text-base prose-ul:my-2 prose-li:my-0.5">
                        {!! $registrationPage->content !!}
                    </div>
                </div>
            </div>

            @if(!empty($registrationPage->requirements))
            <div class="requirements-section mb-5">
                <h3 class="text-success mb-3">Persyaratan</h3>
                <ul class="list-group list-group-flush">
                    @foreach($registrationPage->requirements as $requirement)
                    <li class="list-group-item bg-light py-3">
                        <i class="fas fa-check-circle text-success me-2"></i> {{ $requirement }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($registrationPage->procedures))
            <div class="procedures-section mb-5">
                <h3 class="text-success mb-3">Prosedur Pendaftaran</h3>
                <ol class="list-group list-group-numbered">
                    @foreach($registrationPage->procedures as $procedure)
                    <li class="list-group-item d-flex justify-content-between align-items-start border-0 bg-light py-3">
                        <div class="ms-2 me-auto">
                            <div>{{ $procedure }}</div>
                        </div>
                    </li>
                    @endforeach
                </ol>
            </div>
            @endif

            @if(!empty($registrationPage->documents))
            <div class="documents-section mb-5">
                <h3 class="text-success mb-3">Dokumen yang Diperlukan</h3>
                <ul class="list-group list-group-flush">
                    @foreach($registrationPage->documents as $document)
                    <li class="list-group-item bg-light py-3">
                        <i class="fas fa-file-alt text-success me-2"></i> {{ $document }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($registrationPage->contacts))
            <div class="contacts-section mb-5">
                <h3 class="text-success mb-3">Kontak Pendaftaran</h3>
                <div class="row">
                    @foreach($registrationPage->contacts as $contact)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-0 bg-light">
                            <div class="card-body">
                                <i class="fas fa-user text-success me-2"></i> {{ $contact }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="d-flex gap-3 mt-5">
                <a href="{{ route('registration.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                @if($isOpen)
                <a href="#" class="btn btn-success">
                    <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 