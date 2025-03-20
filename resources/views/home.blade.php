@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Miftahul Huda')

@section('content')
<style>
    .navbar-custom {
        background-color: #006400; /* Hijau tua */
        color: white;
        padding: 15px;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
    }
    .navbar-custom .logo {
        display: flex;
        align-items: center;
    }
    .navbar-custom .logo img {
        height: 40px;
        margin-right: 10px;
    }
    .navbar-custom a {
        color: white;
        font-weight: bold;
        text-decoration: none;
        margin: 0 10px;
    }
    .navbar-custom a:hover {
        color: #d4edda; /* Warna hijau muda */
    }
    .navbar-custom .menu {
        display: flex;
        align-items: center;
    }
    .navbar-custom .dropdown {
        position: relative;
    }
    .navbar-custom .dropdown-content {
        display: none;
        position: absolute;
        background-color: #228B22; /* Hijau terang */
        color: white;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        min-width: 160px;
        z-index: 1000;
        border-radius: 5px;
        padding: 10px 0;
    }
    .navbar-custom .dropdown-content a {
        color: white;
        padding: 10px 20px;
        display: block;
        text-decoration: none;
    }
    .navbar-custom .dropdown-content a:hover {
        background-color: #006400;
    }
    .navbar-custom .dropdown:hover .dropdown-content {
        display: block;
    }
    .footer {
        width: 100%;
        background-color: #006400;
        color: white;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        left: 0;
    }
    .content-wrapper {
        padding-bottom: 60px; /* Memberi ruang agar konten tidak tertutup footer */
    }
</style>

<nav class="navbar-custom">
    <div class="logo">
        <img src="/images/logo.png" alt="Logo">
        <span>Pondok Pesantren Miftahul Huda</span>
    </div>
    <div class="menu">
        <a href="{{ url('/') }}">Beranda</a>
        <div class="dropdown">
            <a href="{{ url('/profil') }}">Profil</a>
            <div class="dropdown-content">
                <a href="{{ url('/pimpinan') }}">Pimpinan</a>
                <a href="{{ url('/pesantren') }}">Pesantren</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="{{ url('/pendidikan') }}">Pendidikan</a>
            <div class="dropdown-content">
                <a href="{{ url('/kegiatan') }}">Kegiatan</a>
                <a href="{{ url('/madin') }}">Madin</a>
                <a href="{{ url('/smp') }}">SMP</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="{{ url('/pendaftaran') }}">Pendaftaran</a>
            <div class="dropdown-content">
                <a href="{{ url('/pondok') }}">Pondok</a>
                <a href="{{ url('/smp') }}">SMP</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="{{ url('/pembayaran') }}">Pembayaran</a>
            <div class="dropdown-content">
                <a href="{{ url('/syariah-pondok') }}">Syariah Pondok</a>
                <a href="{{ url('/syariah-smp') }}">Syariah SMP</a>
            </div>
        </div>
        <a href="{{ url('/kontak') }}">Kontak & Alamat</a>
    </div>
</nav>

<div class="container py-5 content-wrapper" style="margin-top: 80px;">
    <div class="text-center">
        <h1 class="text-green-700 fw-bold display-4">Selamat Datang di Pondok Pesantren Miftahul Huda</h1>
        <p class="text-gray-600 mt-3 fs-5">Menjadi lembaga pendidikan Islam yang mencetak generasi berakhlak mulia dan berilmu.</p>
    </div>

    <div class="mt-5 d-flex justify-content-center">
        <img src="https://via.placeholder.com/800x400" alt="Pondok Pesantren" class="rounded shadow w-100 w-md-75 w-lg-66">
    </div>

    <div class="mt-5 row text-center">
        <div class="col-md-4 mb-3">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-green-700 fw-semibold">Pendidikan</h3>
                <p class="text-gray-600 mt-2">Kami menyediakan berbagai program pendidikan berbasis keislaman.</p>
                <a href="{{ url('/pendidikan') }}" class="text-green-600 fw-bold d-block mt-3">Selengkapnya</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-green-700 fw-semibold">Pendaftaran</h3>
                <p class="text-gray-600 mt-2">Informasi pendaftaran santri baru dan prosedur penerimaan.</p>
                <a href="{{ url('/pendaftaran') }}" class="text-green-600 fw-bold d-block mt-3">Selengkapnya</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-green-700 fw-semibold">Kontak</h3>
                <p class="text-gray-600 mt-2">Hubungi kami untuk informasi lebih lanjut mengenai pondok pesantren.</p>
                <a href="{{ url('/kontak') }}" class="text-green-600 fw-bold d-block mt-3">Selengkapnya</a>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    &copy; 2025 Pondok Pesantren Miftahul Huda. Semua Hak Dilindungi.
</footer>

@endsection
