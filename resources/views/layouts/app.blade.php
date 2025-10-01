<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKS - SMKN 8 JAKARTA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logouks.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }
        .nav-link.active {
            font-weight: 600;
            color: #ffc107 !important;
        }
        .content-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #0d6efd, #0b5ed7);
        }
        .user-info {
            font-size: 0.95rem;
            color: #fff;
        }
        .user-info i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logouks.png') }}" alt="Logo" width="60" height="40" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kunjungan.index') }}">Kunjungan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('obat.index') }}">Obat</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}">Berita</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('petugas.index') }}">Kelola User</a></li>
                        @elseif(auth()->user()->role === 'petugas')
                            <li class="nav-item"><a class="nav-link" href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kunjungan.index') }}">Input Kunjungan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('obat.index') }}">Inventaris Obat</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}">Berita</a></li>
                        @elseif(auth()->user()->role === 'siswa')
                            <li class="nav-item"><a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('obat.index') }}">Obat</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}">Berita</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('siswa.riwayat') }}">Riwayat Kunjungan</a></li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex align-items-center">
                    @auth
                        <span class="user-info me-3">
                            <i class="bi bi-person-circle"></i> 
                            Halo, {{ auth()->user()->name }}
                        </span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm">Login</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="content-card">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
