<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pondok Pesantren Miftahul Huda')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f8fff0;
        }
        .navbar {
            background-color: #006400;
        }
        .navbar a {
            color: white;
        }
    </style>
</head>
<body class="bg-green-50">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Miftahul Huda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/profil/pimpinan') }}">Pimpinan</a></li>
                            <li><a class="dropdown-item" href="{{ url('/profil/pesantren') }}">Pesantren</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pendidikanDropdown" role="button" data-bs-toggle="dropdown">Pendidikan</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/pendidikan/kegiatan') }}">Kegiatan</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pendidikan/madin') }}">Madin</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pendidikan/smp') }}">SMP</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pendaftaranDropdown" role="button" data-bs-toggle="dropdown">Pendaftaran</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/pendaftaran/pondok') }}">Pondok</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pendaftaran/smp') }}">SMP</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pembayaranDropdown" role="button" data-bs-toggle="dropdown">Pembayaran</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/pembayaran/syariah-pondok') }}">Syariah Pondok</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pembayaran/syariah-smp') }}">Syariah SMP</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/kontak') }}">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/alamat') }}">Alamat</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
