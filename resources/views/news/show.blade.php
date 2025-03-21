@extends('layouts.app')

@section('title', $news->title . ' - Pondok Pesantren Miftahul Huda')

@section('content')
<div class="container py-5" style="margin-top: 80px;">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-green-700">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}" class="text-decoration-none text-green-700">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($news->title, 40) }}</li>
                </ol>
            </nav>

            <div class="bg-white p-4 shadow rounded">
                <h1 class="text-green-700 fw-bold mb-3">{{ $news->title }}</h1>
                
                <div class="d-flex align-items-center text-muted mb-4">
                    <span><i class="fas fa-calendar-alt me-2"></i>{{ $news->published_at->format('d M Y') }}</span>
                </div>

                @if($news->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid rounded">
                </div>
                @endif

                <div class="news-content">
                    {!! nl2br(e($news->content)) !!}
                </div>

                <div class="mt-5 pt-4 border-top">
                    <a href="{{ route('news.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 