@extends('layouts.app')

@section('title', $news->title . ' - Pondok Pesantren Miftahul Huda')

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

            <div class="bg-white p-4 shadow rounded">
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