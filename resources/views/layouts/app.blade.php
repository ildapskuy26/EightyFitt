<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKS - MyApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link.active {
            font-weight: 600;
            color: #ffc107 !important;
        }
        .content-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">UKS MyApp</a>
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
                            <li class="nav-item"><a class="nav-link" href="#">Kelola User</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Laporan</a></li>
                        @elseif(auth()->user()->role === 'petugas')
                            <li class="nav-item"><a class="nav-link" href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kunjungan.index') }}">Input Kunjungan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('obat.index') }}">Inventaris Obat</a></li>
                        @elseif(auth()->user()->role === 'siswa')
                            <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Lihat Data</a></li>
                        @endif
                    @endauth
                </ul>

                @auth
                    <div class="d-flex align-items-center">
                        <span class="text-light me-3">Halo, {{ auth()->user()->name }}</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-warning btn-sm">Logout</button>
                        </form>
                    </div>
                @endauth
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
