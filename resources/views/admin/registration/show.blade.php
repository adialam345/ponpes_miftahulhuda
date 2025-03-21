@extends('layouts.admin')

@section('title', 'Detail Halaman Pendaftaran - Admin')

@section('content')
<div class="container py-4">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Detail Halaman Pendaftaran</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.registration.edit', $registrationPage->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('admin.registration.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="mb-6 pb-4 border-b">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $registrationPage->title }}</h2>
                        <div class="flex items-center space-x-3 text-sm text-gray-500">
                            <span class="inline-flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i> Diperbarui: {{ $registrationPage->updated_at->format('d M Y H:i') }}
                            </span>
                            <span class="inline-flex items-center">
                                <i class="fas fa-tag mr-1"></i> Tipe: 
                                @if($registrationPage->page_type == 'pondok')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 ml-1">
                                        Pondok
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 ml-1">
                                        SMP
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-gray-100 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-700 mb-1">Status Pendaftaran</h3>
                        @if($registrationPage->registration_start && $registrationPage->registration_end)
                            <p class="text-sm text-gray-600">
                                {{ $registrationPage->registration_start->format('d M Y') }} - {{ $registrationPage->registration_end->format('d M Y') }}
                            </p>
                            @if($registrationPage->isRegistrationOpen())
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Terbuka
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Tertutup
                                </span>
                            @endif
                        @else
                            <p class="text-sm text-gray-500">Tanggal pendaftaran belum diatur</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-medium mb-3">Konten</h3>
                <div class="prose max-w-none bg-gray-50 p-4 rounded">
                    {!! nl2br(e($registrationPage->content)) !!}
                </div>
            </div>

            @if(isset($registrationPage->requirements) && count($registrationPage->requirements) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-3">Persyaratan Pendaftaran</h3>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($registrationPage->requirements as $requirement)
                    <li class="text-gray-700">{{ $requirement }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(isset($registrationPage->procedures) && count($registrationPage->procedures) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-3">Prosedur Pendaftaran</h3>
                <ol class="list-decimal pl-5 space-y-1">
                    @foreach($registrationPage->procedures as $procedure)
                    <li class="text-gray-700">{{ $procedure }}</li>
                    @endforeach
                </ol>
            </div>
            @endif

            @if(isset($registrationPage->documents) && count($registrationPage->documents) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-3">Dokumen yang Dibutuhkan</h3>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($registrationPage->documents as $document)
                    <li class="text-gray-700">{{ $document }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(isset($registrationPage->contacts) && count($registrationPage->contacts) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-3">Kontak Pendaftaran</h3>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($registrationPage->contacts as $contact)
                    <li class="text-gray-700">{{ $contact }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-3">Tindakan</h3>
        <div class="flex space-x-3">
            <a href="{{ route('admin.registration.edit', $registrationPage->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-edit mr-1"></i> Edit Halaman
            </a>
            <form action="{{ route('admin.registration.destroy', $registrationPage->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaman pendaftaran ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded">
                    <i class="fas fa-trash mr-1"></i> Hapus Halaman
                </button>
            </form>
            @if($registrationPage->page_type == 'pondok')
            <a href="{{ route('registration.pondok') }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-eye mr-1"></i> Lihat Halaman Publik
            </a>
            @elseif($registrationPage->page_type == 'smp')
            <a href="{{ route('registration.smp') }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-eye mr-1"></i> Lihat Halaman Publik
            </a>
            @endif
        </div>
    </div>
</div>
@endsection 