<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UKS - SMKN 8 Jakarta</title>
<link rel="icon" type="image/png" href="{{ asset('images/logouks.png') }}">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap CSS & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    :root {
        --bg-body: linear-gradient(135deg, #DCEFE4 0%, #F5F9F6 100%);
        --bg-sidebar: linear-gradient(180deg, #2E7D32 80%, #256228 100%);
        --bg-navbar: rgba(255,255,255,0.85);
        --text-color: #1B5E20;
        --text-light: #fff;
    }

    body.dark-mode {
        --bg-body: linear-gradient(135deg, #0d1117, #161b22);
        --bg-sidebar: linear-gradient(180deg, #1b4d1e, #122d14);
        --bg-navbar: rgba(22,27,34,0.9);
        --text-color: #e6edf3;
        --text-light: #fff;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: var(--bg-body);
        color: var(--text-color);
        transition: background 0.4s ease, color 0.4s ease;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* === SIDEBAR === */
    .sidebar {
        position: fixed;
        top: 0; left: 0;
        height: 100vh;
        width: 250px;
        background: var(--bg-sidebar);
        padding-top: 80px;
        box-shadow: 2px 0 18px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        z-index: 1040;
    }
    .sidebar-header {
        text-align: center;
    }
    .sidebar-header img {
        width: 60px;
        margin-bottom: 5px;
    }
    .sidebar .nav-link {
        color: var(--text-light);
        padding: 12px 20px;
        margin: 6px 12px;
        border-radius: 10px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.25s ease;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background: rgba(255,255,255,0.18);
        transform: translateX(6px) scale(1.02);
    }

    /* === NAVBAR === */
    .navbar {
        position: fixed;
        top: 0; left: 0;
        width: 100%;
        z-index: 1050;
        background: var(--bg-navbar) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .navbar .navbar-brand {
        font-weight: 700;
        font-size: 1.3rem;
        color: var(--text-color) !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .navbar .nav-link {
        color: var(--text-color) !important;
        margin: 0 10px;
        font-weight: 500;
        border-radius: 8px;
    }
    .navbar .nav-link:hover,
    .navbar .nav-link.active {
        color: #2E7D32 !important;
        background: rgba(46,125,50,0.08);
    }

    /* === CONTENT === */
    .content-wrapper {
        margin-left: 250px;
        padding: 90px 30px 40px;
        transition: margin-left 0.3s ease;
    }

    /* === DARK MODE TOGGLE === */
    .dark-toggle {
        cursor: pointer;
        background: none;
        border: none;
        font-size: 1.4rem;
        color: var(--text-color);
        transition: transform 0.3s ease;
    }
    .dark-toggle:hover {
        transform: rotate(15deg) scale(1.1);
    }

    /* === BUTTONS === */
    .btn-success, .btn-primary {
        background: linear-gradient(135deg, #2E7D32, #256228);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-success:hover, .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }
    .btn-danger {
        background-color: #E53935;
        border-radius: 8px;
    }
    .btn-danger:hover {
        background-color: #c62828;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            padding-top: 10px;
        }
        .content-wrapper {
            margin-left: 0;
            padding: 90px 15px;
        }
    }
</style>
</head>
<body>

@auth
    {{-- === ADMIN / PETUGAS VIEW === --}}
    @if(in_array(auth()->user()->role, ['admin','petugas']))
        <div class="sidebar animate__animated animate__fadeInLeft">
            <div class="sidebar-header text-center text-white mb-4">
                <img src="{{ asset('images/logouks.png') }}" alt="Logo">
                <h5 class="fw-bold">UKS</h5>
            </div>
            <ul class="nav flex-column">
                @if(auth()->user()->role === 'admin')
                    <li><a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    <li><a class="nav-link" href="{{ route('kunjungan.index') }}"><i class="bi bi-clipboard-heart"></i> Kunjungan</a></li>
                    <li><a class="nav-link" href="{{ route('obat.index') }}"><i class="bi bi-capsule"></i> Obat</a></li>
                    <li><a class="nav-link" href="{{ route('berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a></li>
                    <li><a class="nav-link" href="{{ route('petugas.index') }}"><i class="bi bi-people"></i> Kelola User</a></li>
                @elseif(auth()->user()->role === 'petugas')
                    <li><a class="nav-link {{ request()->is('petugas/dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    <li><a class="nav-link" href="{{ route('kunjungan.index') }}"><i class="bi bi-clipboard-plus"></i> Input Kunjungan</a></li>
                    <li><a class="nav-link" href="{{ route('obat.index') }}"><i class="bi bi-capsule"></i> Inventaris Obat</a></li>
                    <li><a class="nav-link" href="{{ route('berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a></li>
                @endif
                <li class="mt-3 px-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-light text-danger w-100 fw-semibold">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        
        <div class="content-wrapper">
            <div class="d-flex justify-content-end mb-3">
                <button id="toggleDarkMode" class="dark-toggle" title="Ubah Tema">
                    <i class="bi bi-moon"></i>
                </button>
            </div>
            @if(session('error'))
                <div class="alert alert-danger text-center mb-3">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>

    {{-- === SISWA VIEW === --}}
    @elseif(auth()->user()->role === 'siswa')
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('siswa.dashboard') }}">
                    <img src="{{ asset('images/logouks.png') }}" alt="Logo" width="32"> UKS
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavSiswa">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavSiswa">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('obat.index') }}">Obat</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}">Berita</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('siswa.riwayat') }}">Riwayat</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('kontak.index') }}">Kontak</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <button id="toggleDarkMode" class="dark-toggle me-3" title="Ubah Tema">
                            <i class="bi bi-moon"></i>
                        </button>
                        <span><i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="ms-2">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm fw-semibold">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container mt-5 pt-5">
            @yield('content')
        </div>
    @endif
@endauth

@guest
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logouks.png') }}" alt="Logo" width="32"> UKS
            </a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <button id="toggleDarkMode" class="dark-toggle" title="Ubah Tema">
                    <i class="bi bi-moon"></i>
                </button>
                <a href="{{ route('login') }}" class="btn btn-success btn-sm fw-semibold">Login</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        @yield('content')
    </div>
@endguest

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // 🌙 Dark Mode Toggle
    const toggleBtn = document.getElementById('toggleDarkMode');
    const icon = toggleBtn?.querySelector('i');

    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
        if (icon) icon.classList.replace('bi-moon', 'bi-sun');
    }

    toggleBtn?.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        const enabled = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', enabled ? 'enabled' : 'disabled');
        icon?.classList.toggle('bi-moon', !enabled);
        icon?.classList.toggle('bi-sun', enabled);
    });
</script>
</body>
</html>
