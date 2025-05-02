@extends('layouts.app')

@section('title', $news->title . ' - Pondok Pesantren Miftahul Huda')

@push('styles')
<style>
    .news-content {
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: pre-wrap;
        max-width: 100%;
        line-height: 1.6;
    }
    
    .news-content img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
    }
    
    /* Fix for long strings without spaces */
    .news-content * {
        max-width: 100%;
        overflow-wrap: break-word;
        word-wrap: break-word;
        -ms-word-break: break-all;
        word-break: break-word;
        -ms-hyphens: auto;
        -moz-hyphens: auto;
        -webkit-hyphens: auto;
        hyphens: auto;
    }

    /* Container styles */
    .news-container {
        max-width: 100%;
        padding: 1.5rem;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Text formatting */
    .news-content p {
        margin-bottom: 1rem;
    }

    .news-content a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .news-content a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container pt-2 pb-4" style="margin-top: 0px;">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-green-700">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}" class="text-decoration-none text-green-700">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($news->title, 40) }}</li>
                </ol>
            </nav>

            <div class="news-container">
                <h1 class="text-green-700 fw-bold mb-2">{{ $news->title }}</h1>
                
                <div class="d-flex align-items-center text-muted mb-3">
                    <span><i class="fas fa-calendar-alt me-2"></i>{{ $news->published_at->format('d M Y') }}</span>
                </div>

                @if($news->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid rounded">
                </div>
                @endif

                <div class="news-content">
                    {!! nl2br(e($news->content)) !!}
                </div>

                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('news.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 