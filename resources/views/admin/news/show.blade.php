@extends('layouts.admin')

@section('title', 'Detail Berita - Admin')

@push('styles')
<style>
.news-content {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    line-height: 1.7;
    color: #374151;
}

.news-content h1, .news-content h2, .news-content h3, .news-content h4, .news-content h5, .news-content h6 {
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    color: #111827;
}

.news-content h1 { font-size: 2rem; }
.news-content h2 { font-size: 1.75rem; }
.news-content h3 { font-size: 1.5rem; }
.news-content h4 { font-size: 1.25rem; }
.news-content h5 { font-size: 1.125rem; }
.news-content h6 { font-size: 1rem; }

.news-content p {
    margin-bottom: 1rem;
}

.news-content ul, .news-content ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.news-content li {
    margin-bottom: 0.5rem;
}

.news-content blockquote {
    border-left: 4px solid #10b981;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background-color: #f0fdf4;
    padding: 1rem;
    border-radius: 0.5rem;
}

.news-content a {
    color: #10b981;
    text-decoration: underline;
}

.news-content a:hover {
    color: #059669;
}

.news-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1rem 0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.news-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.news-content th, .news-content td {
    border: 1px solid #e5e7eb;
    padding: 0.75rem;
    text-align: left;
}

.news-content th {
    background-color: #f9fafb;
    font-weight: 600;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.status-published {
    background-color: #dcfce7;
    color: #166534;
}

.status-draft {
    background-color: #f3f4f6;
    color: #374151;
}

.metadata-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    background-color: #f8fafc;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.metadata-item:hover {
    background-color: #f1f5f9;
    transform: translateY(-1px);
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(90deg, #10b981, #3b82f6);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(90deg, #059669, #2563eb);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.5);
}

.btn-warning {
    background: linear-gradient(90deg, #f59e0b, #f97316);
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(90deg, #d97706, #ea580c);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.5);
}

.btn-danger {
    background: linear-gradient(90deg, #ef4444, #dc2626);
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(90deg, #dc2626, #b91c1c);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.5);
}

.btn-secondary {
    background: white;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.btn-secondary:hover {
    background: #f8fafc;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.image-container {
    position: relative;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.image-container img {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-container:hover img {
    transform: scale(1.02);
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    color: white;
    padding: 1.5rem;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.image-container:hover .image-overlay {
    transform: translateY(0);
}

.fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.section-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.section-header {
    background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.reading-time {
    background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
    color: #92400e;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
}

@media print {
    .no-print {
        display: none !important;
    }

    .section-card {
        box-shadow: none;
        border: 1px solid #e5e7eb;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
    calculateReadingTime();

    // Show success message if exists
    @if(session('success'))
        showAlert('success', "{{ session('success') }}");
    @endif

    @if(session('error'))
        showAlert('error', "{{ session('error') }}");
    @endif
});

function calculateReadingTime() {
    const content = document.querySelector('.news-content');
    if (!content) return;

    const text = content.textContent || content.innerText;
    const wordsPerMinute = 200; // Average reading speed
    const words = text.trim().split(/\s+/).length;
    const readingTime = Math.ceil(words / wordsPerMinute);

    const readingTimeElement = document.getElementById('reading-time');
    if (readingTimeElement) {
        readingTimeElement.textContent = `${readingTime} menit`;
    }
}

function confirmDelete() {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `Apakah Anda yakin ingin menghapus berita <strong>"{{ $news->title }}"</strong>?<br><br>Tindakan ini tidak dapat dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Sedang menghapus berita',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit the form
            document.getElementById('delete-form').submit();
        }
    });
}

function printNews() {
    window.print();
}

function shareNews() {
    if (navigator.share) {
        navigator.share({
            title: "{{ $news->title }}",
            text: "{{ Str::limit(strip_tags($news->content), 100) }}",
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            showAlert('success', 'Link berhasil disalin ke clipboard');
        });
    }
}

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
</script>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-8 no-print">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-slate-900 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                        <i data-lucide="eye" class="w-5 h-5 text-white"></i>
                    </div>
                    Detail Berita
                </h1>
                <p class="text-slate-600 mt-1">Lihat detail lengkap berita yang dipilih</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <button onclick="shareNews()"
                        class="action-btn btn-secondary">
                    <i data-lucide="share-2" class="w-4 h-4 mr-2"></i>
                    Bagikan
                </button>
                <button onclick="printNews()"
                        class="action-btn btn-secondary">
                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                    Cetak
                </button>
                <a href="{{ route('admin.news.index') }}"
                   class="action-btn btn-secondary">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- News Content -->
    <div class="section-card fade-in">
        <div class="p-6 md:p-8">
            <!-- Title and Metadata -->
            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4 leading-tight">
                    {{ $news->title }}
                </h2>

                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-600">
                    <div class="metadata-item">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2 text-slate-400"></i>
                        <span>{{ $news->created_at->format('d M Y, H:i') }}</span>
                    </div>

                    @if($news->published_at)
                    <div class="metadata-item">
                        <i data-lucide="send" class="w-4 h-4 mr-2 text-slate-400"></i>
                        <span>Dipublikasikan: {{ $news->published_at->format('d M Y, H:i') }}</span>
                    </div>
                    @endif

                    <div class="metadata-item">
                        <i data-lucide="clock" class="w-4 h-4 mr-2 text-slate-400"></i>
                        <span>Waktu baca: <span id="reading-time">-</span></span>
                    </div>

                    <div class="status-badge {{ $news->status === 'published' ? 'status-published' : 'status-draft' }}">
                        <i data-lucide="{{ $news->status === 'published' ? 'check-circle' : 'clock' }}" class="w-3 h-3 mr-1"></i>
                        {{ $news->status === 'published' ? 'Dipublikasikan' : 'Draft' }}
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            @if($news->image)
            <div class="image-container">
                <img src="{{ asset('storage/' . $news->image) }}"
                     alt="{{ $news->title }}"
                     class="w-full">
                <div class="image-overlay">
                    <p class="text-sm opacity-90">{{ $news->title }}</p>
                </div>
            </div>
            @endif

            <!-- Content -->
            <div class="news-content">
                {!! $news->content !!}
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="section-card fade-in no-print" style="animation-delay: 0.1s;">
        <div class="section-header">
            <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                <i data-lucide="settings" class="w-5 h-5 mr-2 text-blue-600"></i>
                Tindakan
            </h3>
        </div>
        <div class="p-6">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.news.edit', $news->id) }}"
                   class="action-btn btn-warning">
                    <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                    Edit Berita
                </a>

                @if($news->status === 'draft')
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="published">
                    <input type="hidden" name="title" value="{{ $news->title }}">
                    <input type="hidden" name="content" value="{{ $news->content }}">
                    <button type="submit" class="action-btn btn-primary">
                        <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                        Publikasikan
                    </button>
                </form>
                @else
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="draft">
                    <input type="hidden" name="title" value="{{ $news->title }}">
                    <input type="hidden" name="content" value="{{ $news->content }}">
                    <button type="submit" class="action-btn btn-secondary">
                        <i data-lucide="archive" class="w-4 h-4 mr-2"></i>
                        Jadikan Draft
                    </button>
                </form>
                @endif

                <form id="delete-form" action="{{ route('admin.news.destroy', $news->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete()" class="action-btn btn-danger">
                        <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                        Hapus Berita
                    </button>
                </form>
            </div>

            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start">
                    <i data-lucide="info" class="w-5 h-5 text-blue-600 mr-2 mt-0.5"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium">Informasi:</p>
                        <ul class="mt-1 list-disc list-inside space-y-1">
                            <li>Gunakan tombol "Edit" untuk mengubah konten berita</li>
                            <li>Status publikasi dapat diubah langsung dari halaman ini</li>
                            <li>Berita yang dihapus tidak dapat dikembalikan</li>
                            <li>Gunakan tombol "Bagikan" untuk menyalin link berita</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="section-card fade-in no-print" style="animation-delay: 0.2s;">
        <div class="section-header">
            <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                <i data-lucide="info" class="w-5 h-5 mr-2 text-blue-600"></i>
                Informasi Tambahan
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-slate-900 mb-3">Detail Berita</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-slate-600">ID Berita:</span>
                            <span class="font-medium">#{{ $news->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Dibuat:</span>
                            <span class="font-medium">{{ $news->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Terakhir diubah:</span>
                            <span class="font-medium">{{ $news->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Status:</span>
                            <span class="font-medium">{{ $news->status === 'published' ? 'Dipublikasikan' : 'Draft' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-slate-900 mb-3">Statistik</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Jumlah karakter:</span>
                            <span class="font-medium">{{ strlen(strip_tags($news->content)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Jumlah kata:</span>
                            <span class="font-medium">{{ str_word_count(strip_tags($news->content)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Estimasi baca:</span>
                            <span class="font-medium">{{ ceil(str_word_count(strip_tags($news->content)) / 200) }} menit</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Gambar:</span>
                            <span class="font-medium">{{ $news->image ? 'Ada' : 'Tidak ada' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
