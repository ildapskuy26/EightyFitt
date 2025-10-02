    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKS - SMKN 8 JAKARTA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logouks.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
    background-color: #DCEFE4; /* hijau pastel agak gelap, lebih adem */
    color: #333;
    font-family: 'Quicksand', sans-serif;
}


        /* Navbar */
        .navbar {
            background-color: #FFF9ED !important; /* cream aesthetic */
            border-bottom: 1px solid #f1e7d0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .navbar .navbar-brand span {
            color: #2E7D32 !important; /* hijau tua brand */
            font-weight: 700;
            letter-spacing: 1px;
        }
        .navbar .nav-link {
            color: #444 !important;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }
        .navbar .nav-link.active,
        .navbar .nav-link:hover {
            color: #2E7D32 !important;
            background-color: rgba(192, 247, 193, 0.3);
            border-radius: 6px;
            padding: 6px 12px;
        }
        .user-info {
            color: #2e4730 !important;
            font-weight: 600;
        }

        /* Card & Table */
        .card, .table {
            background-color: rgba(255, 255, 255, 0.85); 
            color: #333;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }
        .table thead {
            background-color: #2E7D32;
            color: #fff;
        }

        /* Buttons */
        .btn-primary, .btn-success {
            background: linear-gradient(135deg, #2E7D32, #256228);
            border: none;
            color: #fff !important;
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover, .btn-success:hover {
            background: linear-gradient(135deg, #256228, #1B4D1E);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .btn-primary:active, .btn-success:active {
            background: linear-gradient(135deg, #1B4D1E, #2E7D32);
            transform: translateY(0);
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2) inset;
        }

        .btn-warning {
            background-color: #FFCA28;
            border: none;
            color: #000;
            transition: all 0.3s ease-in-out;
        }
        .btn-warning:hover {
            background-color: #f9a825;
        }

        .btn-danger {
            background-color: #E53935;
            border: none;
            transition: all 0.3s ease-in-out;
        }
        .btn-danger:hover {
            background-color: #c62828;
        }

        /* Forms */
        .form-control, .form-select {
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
        }
        .form-control:focus, .form-select:focus {
            background-color: #F1F8F5;
            border-color: #43A047;
            box-shadow: none;
        }
    </style>
    </head>

    <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logouks.png') }}" alt="Logo" width="60" height="40" class="me-2">
                <span class="fw-bold">UKS</span>
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
                        <span class="user-info me-3 text-dark">
                            <i class="bi bi-person-circle"></i> 
                            Halo, {{ auth()->user()->name }}
                        </span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success btn-sm">Login</a>
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
