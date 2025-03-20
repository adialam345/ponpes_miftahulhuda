@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Miftahul Huda')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <h1 class="text-green-700 font-bold text-4xl">Selamat Datang di Pondok Pesantren Miftahul Huda</h1>
        <p class="text-gray-600 mt-3 text-lg">Menjadi lembaga pendidikan Islam yang mencetak generasi berakhlak mulia dan berilmu.</p>
    </div>

    <div class="mt-5 flex justify-center">
        <img src="https://via.placeholder.com/800x400" alt="Pondok Pesantren" class="rounded-lg shadow-lg w-full md:w-3/4 lg:w-2/3">
    </div>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
        <div class="bg-white p-5 shadow-md rounded-lg">
            <h3 class="text-green-700 text-xl font-semibold">Pendidikan</h3>
            <p class="text-gray-600 mt-2">Kami menyediakan berbagai program pendidikan berbasis keislaman.</p>
            <a href="{{ url('/pendidikan') }}" class="text-green-600 font-bold mt-3 block">Selengkapnya</a>
        </div>
        <div class="bg-white p-5 shadow-md rounded-lg">
            <h3 class="text-green-700 text-xl font-semibold">Pendaftaran</h3>
            <p class="text-gray-600 mt-2">Informasi pendaftaran santri baru dan prosedur penerimaan.</p>
            <a href="{{ url('/pendaftaran') }}" class="text-green-600 font-bold mt-3 block">Selengkapnya</a>
        </div>
        <div class="bg-white p-5 shadow-md rounded-lg">
            <h3 class="text-green-700 text-xl font-semibold">Kontak</h3>
            <p class="text-gray-600 mt-2">Hubungi kami untuk informasi lebih lanjut mengenai pondok pesantren.</p>
            <a href="{{ url('/kontak') }}" class="text-green-600 font-bold mt-3 block">Selengkapnya</a>
        </div>
    </div>

    <div class="mt-10 bg-green-700 text-white py-10 px-5 text-center rounded-lg">
        <h2 class="text-2xl font-semibold">Jadwal Kegiatan</h2>
        <p class="text-gray-200 mt-2">Ikuti berbagai kegiatan dan program pendidikan di pesantren.</p>
        <a href="{{ url('/kegiatan') }}" class="mt-4 inline-block bg-white text-green-700 px-5 py-2 rounded-full font-bold">Lihat Jadwal</a>
    </div>
</div>
@endsection
