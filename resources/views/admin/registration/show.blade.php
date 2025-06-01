@extends('layouts.admin')

@section('title', 'Detail Halaman Pendaftaran - Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-r {{ $registrationPage->page_type == 'pondok' ? 'from-emerald-500 to-teal-600' : 'from-cyan-500 to-blue-600' }} rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas {{ $registrationPage->page_type == 'pondok' ? 'fa-mosque' : 'fa-graduation-cap' }} text-white text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Halaman Pendaftaran</h1>
                        <p class="text-gray-600 mt-1">Informasi lengkap halaman pendaftaran {{ $registrationPage->page_type == 'pondok' ? 'Pondok Pesantren' : 'SMP' }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.registration.edit', $registrationPage->id) }}"
                       class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Halaman
                    </a>
                    <a href="{{ route('admin.registration.index') }}"
                       class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Page Information Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r {{ $registrationPage->page_type == 'pondok' ? 'from-emerald-500 to-teal-600' : 'from-cyan-500 to-blue-600' }} px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            Informasi Halaman
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $registrationPage->title }}</h3>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                    <span class="flex items-center bg-gray-100 px-3 py-1.5 rounded-lg">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>
                                        Diperbarui: {{ $registrationPage->updated_at->format('d M Y H:i') }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-tag mr-2 text-gray-500"></i>
                                        Tipe:
                                        @if($registrationPage->page_type == 'pondok')
                                            <span class="ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                                <i class="fas fa-mosque mr-1"></i> Pondok Pesantren
                                            </span>
                                        @else
                                            <span class="ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-cyan-100 text-cyan-800">
                                                <i class="fas fa-graduation-cap mr-1"></i> SMP
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-file-alt mr-3"></i>
                            Konten Halaman
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="prose max-w-none">
                            <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-6 rounded-xl border border-gray-200">
                                {!! $registrationPage->content !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requirements Section -->
                @if(isset($registrationPage->requirements) && count($registrationPage->requirements) > 0)
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-emerald-500 to-green-600 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-list-check mr-3"></i>
                            Persyaratan Pendaftaran
                        </h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            @foreach($registrationPage->requirements as $index => $requirement)
                            <li class="flex items-start space-x-3 p-3 bg-emerald-50 rounded-lg border border-emerald-100 transform hover:scale-105 transition-all duration-200">
                                <div class="flex-shrink-0 w-6 h-6 bg-emerald-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <span class="text-gray-700 font-medium">{{ $requirement }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Procedures Section -->
                @if(isset($registrationPage->procedures) && count($registrationPage->procedures) > 0)
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-tasks mr-3"></i>
                            Prosedur Pendaftaran
                        </h3>
                    </div>
                    <div class="p-6">
                        <ol class="space-y-3">
                            @foreach($registrationPage->procedures as $index => $procedure)
                            <li class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg border border-blue-100 transform hover:scale-105 transition-all duration-200">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <span class="text-gray-700 font-medium">{{ $procedure }}</span>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                @endif

                <!-- Documents Section -->
                @if(isset($registrationPage->documents) && count($registrationPage->documents) > 0)
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-file-alt mr-3"></i>
                            Dokumen yang Dibutuhkan
                        </h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            @foreach($registrationPage->documents as $index => $document)
                            <li class="flex items-start space-x-3 p-3 bg-amber-50 rounded-lg border border-amber-100 transform hover:scale-105 transition-all duration-200">
                                <div class="flex-shrink-0 w-6 h-6 bg-amber-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <span class="text-gray-700 font-medium">{{ $document }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Contacts Section -->
                @if(isset($registrationPage->contacts) && count($registrationPage->contacts) > 0)
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-red-500 to-pink-600 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-address-book mr-3"></i>
                            Kontak Pendaftaran
                        </h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            @foreach($registrationPage->contacts as $index => $contact)
                            <li class="flex items-start space-x-3 p-3 bg-red-50 rounded-lg border border-red-100 transform hover:scale-105 transition-all duration-200">
                                <div class="flex-shrink-0 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <span class="text-gray-700 font-medium">{{ $contact }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Registration Status Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-chart-line mr-3"></i>
                            Status Pendaftaran
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($registrationPage->registration_start && $registrationPage->registration_end)
                            <div class="space-y-4">
                                <div class="text-center">
                                    @php
                                        $isOpen = \App\Http\Controllers\RegistrationController::isRegistrationOpen($registrationPage);
                                    @endphp
                                    @if($isOpen)
                                        <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-800 rounded-full font-semibold">
                                            <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                                            Pendaftaran Terbuka
                                        </div>
                                    @else
                                        <div class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 rounded-full font-semibold">
                                            <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                            Pendaftaran Tertutup
                                        </div>
                                    @endif
                                </div>

                                <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-4 rounded-xl border border-gray-200">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-600 mb-2">Periode Pendaftaran</p>
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-calendar-alt text-emerald-500"></i>
                                                <span class="font-semibold text-gray-900">{{ $registrationPage->registration_start->format('d M Y') }}</span>
                                            </div>
                                            <div class="text-gray-400">
                                                <i class="fas fa-arrow-down"></i>
                                            </div>
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-calendar-alt text-red-500"></i>
                                                <span class="font-semibold text-gray-900">{{ $registrationPage->registration_end->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <div class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-semibold">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Tanggal Belum Diatur
                                </div>
                                <p class="text-sm text-gray-600 mt-2">Silakan edit halaman untuk mengatur periode pendaftaran</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-teal-500 to-cyan-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-bolt mr-3"></i>
                            Tindakan Cepat
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('admin.registration.edit', $registrationPage->id) }}"
                           class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Halaman
                        </a>

                        @if($registrationPage->page_type == 'pondok')
                        <a href="{{ route('registration.show', ['type' => 'pondok']) }}" target="_blank"
                           class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat Halaman Publik
                        </a>
                        @elseif($registrationPage->page_type == 'smp')
                        <a href="{{ route('registration.show', ['type' => 'smp']) }}" target="_blank"
                           class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat Halaman Publik
                        </a>
                        @endif

                        <form action="{{ route('admin.registration.destroy', $registrationPage->id) }}" method="POST" class="w-full"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaman pendaftaran ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Halaman
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Page Statistics Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-chart-bar mr-3"></i>
                            Statistik Halaman
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-calendar-plus text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Dibuat</span>
                                </div>
                                <span class="text-blue-600 font-bold">{{ $registrationPage->created_at->format('d M Y') }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg border border-emerald-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-edit text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Terakhir Diperbarui</span>
                                </div>
                                <span class="text-emerald-600 font-bold">{{ $registrationPage->updated_at->format('d M Y') }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg border border-purple-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-tag text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Tipe</span>
                                </div>
                                <span class="text-purple-600 font-bold capitalize">{{ $registrationPage->page_type }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}

.animate-delay-100 {
    animation-delay: 0.1s;
}

.animate-delay-200 {
    animation-delay: 0.2s;
}

.animate-delay-300 {
    animation-delay: 0.3s;
}

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 600;
    margin-top: 1.5em;
    margin-bottom: 0.5em;
}

.prose p {
    margin-bottom: 1em;
}

.prose ul, .prose ol {
    margin-bottom: 1em;
    padding-left: 1.5em;
}

.prose li {
    margin-bottom: 0.5em;
}

.prose strong {
    font-weight: 600;
    color: #111827;
}

.prose em {
    font-style: italic;
}

.prose img {
    border-radius: 0.75rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    margin: 1.5em 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add staggered animation to cards
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.classList.add('animate-fade-in-up');
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Add smooth scroll behavior for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading state to buttons
    document.querySelectorAll('button[type="submit"]').forEach(button => {
        button.addEventListener('click', function() {
            if (this.form.checkValidity()) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                this.disabled = true;
            }
        });
    });
});
</script>
@endsection
