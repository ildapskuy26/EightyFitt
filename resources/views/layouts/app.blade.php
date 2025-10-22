<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UKS - SMKN 8 Jakarta</title>
  <link rel="icon" type="image/png" href="{{ asset('images/smk.png') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
  :root {
    --green-main: #2E7D32;
    --green-btn: #1B5E20;
    --navbar-bg: rgba(255, 255, 255, 0.95);
    --sidebar-bg: linear-gradient(180deg, #2E7D32 0%, #1B5E20 100%);
    --text-color: #333;
    --text-light: #fff;
    --bg-body: linear-gradient(135deg, #DCEFE4 0%, #F5F9F6 100%);
    --sidebar-width: 260px;
    --sidebar-collapsed: 70px;
  }

  /* === GLOBAL === */
  body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg-body);
    color: var(--text-color);
    min-height: 100vh;
    overflow-x: hidden;
  }

  /* === SIDEBAR DENGAN ANIMASI === */
  .sidebar {
    position: fixed;
    top: 0; 
    left: 0;
    height: 100vh;
    width: var(--sidebar-width);
    background: var(--sidebar-bg);
    color: var(--text-light);
    padding-top: 20px;
    box-shadow: 3px 0 15px rgba(0,0,0,0.1);
    z-index: 1040;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
  }

  .sidebar.collapsed {
    width: var(--sidebar-collapsed);
  }

  .sidebar-header {
    text-align: center;
    margin-bottom: 25px;
    padding: 0 20px 20px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    transition: all 0.3s ease;
    flex-shrink: 0;
  }
  
  .sidebar-header img {
    width: 70px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
  }
  
  .sidebar.collapsed .sidebar-header img {
    width: 50px;
  }
  
  .sidebar-header h5 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 1.4rem;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
    transition: all 0.3s ease;
  }
  
  .sidebar.collapsed .sidebar-header h5 {
    opacity: 0;
    height: 0;
    margin: 0;
  }

  .sidebar-header p {
    font-size: 0.85rem;
    opacity: 0.8;
    margin: 0;
    transition: all 0.3s ease;
  }
  
  .sidebar.collapsed .sidebar-header p {
    opacity: 0;
    height: 0;
    margin: 0;
  }

  .sidebar .nav-link {
    color: var(--text-light);
    padding: 14px 20px;
    margin: 5px 15px;
    border-radius: 10px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.95rem;
    position: relative;
    white-space: nowrap;
  }
  
  .sidebar.collapsed .nav-link {
    justify-content: center;
    padding: 14px 10px;
    margin: 5px 10px;
  }
  
  .sidebar .nav-link i {
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
    transition: all 0.3s ease;
    flex-shrink: 0;
  }
  
  .sidebar.collapsed .nav-link i {
    font-size: 1.3rem;
    margin-right: 0;
  }
  
  .sidebar .nav-link span {
    transition: all 0.3s ease;
    white-space: nowrap;
  }
  
  .sidebar.collapsed .nav-link span {
    opacity: 0;
    width: 0;
    height: 0;
    overflow: hidden;
  }

  .sidebar .nav-link:hover,
  .sidebar .nav-link.active {
    background: rgba(255,255,255,0.18);
    transform: translateX(8px);
  }
  
  .sidebar.collapsed .nav-link:hover,
  .sidebar.collapsed .nav-link.active {
    transform: translateX(5px);
  }

  .sidebar .nav-link.active::before {
    content: '';
    position: absolute;
    left: -15px;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 70%;
    background: #fff;
    border-radius: 0 4px 4px 0;
  }

  /* Toggle Button */
  .sidebar-toggle {
    position: absolute;
    top: 25px;
    right: -15px;
    background: var(--green-main);
    color: white;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    z-index: 1050;
    font-size: 0.9rem;
  }

  .sidebar-toggle:hover {
    background: var(--green-btn);
    transform: scale(1.1);
  }

  .sidebar.collapsed .sidebar-toggle i {
    transform: rotate(180deg);
  }

  /* Tooltip untuk sidebar collapsed */
  .sidebar.collapsed .nav-link .tooltip {
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1060;
    margin-left: 10px;
  }

  .sidebar.collapsed .nav-link:hover .tooltip {
    opacity: 1;
    visibility: visible;
  }

  /* Badge Notifikasi */
  .badge {
    background: rgba(255,255,255,0.3);
    color: white;
    border-radius: 10px;
    padding: 4px 8px;
    font-size: 0.7rem;
    margin-left: auto;
    transition: all 0.3s ease;
    font-weight: 600;
    flex-shrink: 0;
  }
  
  .sidebar.collapsed .badge {
    opacity: 0;
    width: 0;
    height: 0;
    padding: 0;
    margin: 0;
  }

  /* Menu Items Container dengan Scroll */
  .sidebar-menu {
    flex: 1;
    overflow-y: auto;
    padding-bottom: 20px;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.3) transparent;
  }

  /* Custom Scrollbar untuk Webkit */
  .sidebar-menu::-webkit-scrollbar {
    width: 6px;
  }

  .sidebar-menu::-webkit-scrollbar-track {
    background: transparent;
  }

  .sidebar-menu::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.3);
    border-radius: 3px;
  }

  .sidebar-menu::-webkit-scrollbar-thumb:hover {
    background: rgba(255,255,255,0.5);
  }

  /* Logout Section */
  .logout-section {
    padding: 20px 15px;
    border-top: 1px solid rgba(255,255,255,0.1);
    margin-top: auto;
    flex-shrink: 0;
  }
  
  .btn-logout-sidebar {
    background: rgba(255,255,255,0.15);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 10px;
    padding: 12px 15px;
    font-weight: 600;
    width: 100%;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
  
  .sidebar.collapsed .btn-logout-sidebar span {
    opacity: 0;
    width: 0;
    height: 0;
    overflow: hidden;
  }
  
  .btn-logout-sidebar:hover {
    background: rgba(255,255,255,0.25);
  }

  /* === CONTENT AREA === */
  .content-wrapper {
    margin-left: var(--sidebar-width);
    padding: 30px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    min-height: 100vh;
  }

  .sidebar.collapsed ~ .content-wrapper {
    margin-left: var(--sidebar-collapsed);
  }

  /* === NAVBAR SISWA OVAL === */
  .navbar-rounded {
    background: var(--navbar-bg);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
    padding: 8px 25px;
    width: 65%;
    max-width: 850px;
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .navbar-brand {
    display: flex;
    align-items: center;
    font-weight: 700;
    font-size: 19px;
    color: var(--green-main) !important;
    margin-left: 15px;
  }
  .navbar-brand img {
    width: 32px;
    margin-right: 6px;
  }
  .navbar-nav {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
  .navbar-nav .nav-link {
    font-weight: 600;
    font-size: 15px;
    color: #333 !important;
    border-radius: 20px;
    display: flex;
    align-items: center;
    padding: 6px 12px;
    transition: all 0.3s ease;
    white-space: nowrap;
  }
  .navbar-nav .nav-link i {
    font-size: 18px;
    margin-right: 6px;
    color: var(--green-main);
  }
  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link.active {
    background: rgba(46, 125, 50, 0.08);
    color: var(--green-main) !important;
  }
  .user-info {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: var(--text-color);
    margin-right: 10px;
    white-space: nowrap;
  }
  .user-info i {
    font-size: 1.5rem;
    margin-right: 6px;
    color: var(--green-main);
  }
  .btn-logout {
    background: var(--green-btn);
    color: #fff;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 20px;
    border: none;
    transition: 0.3s;
    white-space: nowrap;
  }
  .btn-logout:hover {
    background: #009663;
    transform: translateY(-1px);
  }

  /* === CONTENT STYLING === */
  .page-title {
    color: var(--green-main);
    font-weight: 700;
    margin-bottom: 25px;
    font-family: 'Montserrat', sans-serif;
  }

  .content-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    padding: 25px;
    margin-bottom: 25px;
    border: none;
  }

  /* === RESPONSIVE STYLES === */
  @media (max-width: 992px) {
    .sidebar {
      width: 100%;
      height: auto;
      position: relative;
      transform: translateX(0) !important;
    }
    
    .sidebar.collapsed {
      width: 100%;
    }
    
    .content-wrapper {
      margin-left: 0 !important;
    }
    
    .navbar-rounded {
      width: 90%;
      padding: 10px 15px;
    }
    
    .navbar-toggler {
      border: none;
      padding: 4px 8px;
      font-size: 1.25rem;
      background: transparent;
    }
    
    .navbar-toggler:focus {
      box-shadow: none;
    }
    
    .navbar-collapse {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: var(--navbar-bg);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
      margin-top: 10px;
      padding: 15px;
      z-index: 1000;
    }
    
    .navbar-nav {
      flex-direction: column;
      gap: 5px;
    }
    
    .navbar-nav .nav-link {
      justify-content: center;
      padding: 8px 15px;
    }
    
    .user-info {
      margin-right: 0;
      margin-bottom: 10px;
      justify-content: center;
    }
    
    .btn-logout {
      width: 100%;
      text-align: center;
    }

    /* Nonaktifkan scroll di mobile */
    .sidebar-menu {
      overflow-y: visible;
    }
  }
  
  @media (max-width: 576px) {
    .navbar-brand span {
      display: none;
    }
    
    .navbar-brand img {
      margin-right: 0;
    }
  }
  </style>
</head>
<body>

@auth
  @php $role = auth()->user()->role; @endphp

  {{-- === SIDEBAR UNTUK ADMIN & PETUGAS === --}}
@if(in_array($role, ['admin','petugas']))
<div class="sidebar d-flex flex-column" id="adminSidebar">
  <div class="sidebar-header" id="sidebarLogo">
    <img src="{{ asset('images/logouks.png') }}" alt="Logo">
    <h5>UKS SMKN 8 Jakarta</h5>
    <p>Unit Kesehatan Sekolah</p>
  </div>

  <div class="sidebar-menu">
    <ul class="nav flex-column">
      @if($role === 'admin')
      <li><a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-chart-pie"></i><span>Dashboard</span></a></li>
      <li><a class="nav-link" href="{{ route('kunjungan.index') }}"><i class="fas fa-notes-medical"></i><span>Kunjungan</span></a></li>
      <li><a class="nav-link" href="{{ route('obat.index') }}"><i class="fas fa-capsules"></i><span>Obat</span></a></li>
      <li><a class="nav-link" href="{{ route('berita.index') }}"><i class="fas fa-bullhorn"></i><span>Berita</span></a></li>
      <li><a class="nav-link" href="{{ route('petugas.index') }}"><i class="fas fa-user-shield"></i><span>Kelola User</span></a></li>
      <li><a class="nav-link" href="{{ route('pembukuan.index') }}"><i class="fas fa-book-medical"></i><span>Pembukuan</span></a></li>
      @elseif($role === 'petugas')
      <li><a class="nav-link {{ request()->is('petugas/dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}">
        <i class="fas fa-chart-pie"></i><span>Dashboard</span></a></li>
      <li><a class="nav-link" href="{{ route('kunjungan.index') }}"><i class="fas fa-notes-medical"></i><span>Input Kunjungan</span></a></li>
      <li><a class="nav-link" href="{{ route('obat.index') }}"><i class="fas fa-capsules"></i><span>Inventaris Obat</span></a></li>
      <li><a class="nav-link" href="{{ route('berita.index') }}"><i class="fas fa-bullhorn"></i><span>Berita</span></a></li>
      <li><a class="nav-link" href="{{ route('pembukuan.index') }}"><i class="fas fa-book-medical"></i><span>Pembukuan</span></a></li>
      @endif
    </ul>
  </div>

  <div class="logout-section">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="btn btn-logout-sidebar"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </form>
  </div>
</div>

<div class="content-wrapper">
  <!-- === NAVBAR ADMIN === -->
  <div class="content-card">
    @yield('content')
  </div>
</div>

<style>
/* === Sidebar Header Logo Center Fix === */
.sidebar-header {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 15px 10px;
}

.sidebar-header img {
  display: block;
  margin: 0 auto 10px auto;
  max-width: 70px;
  height: auto;
}

.sidebar-header h5,
.sidebar-header p {
  color: #fff;
  margin: 0;
  line-height: 1.2;
}

/* === Sidebar === */
.sidebar {
  width: 240px;
  height: 100vh;
  background: linear-gradient(180deg, #1f5133, #2e6b45);
  color: #fff;
  position: fixed;
  top: 0;
  left: 0;
  overflow-y: auto;
  transition: all 0.3s ease;
}

.sidebar-menu .nav-link {
  color: #d9f0e1;
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 20px;
  border-radius: 10px;
  transition: all 0.3s ease;
}

.sidebar-menu .nav-link:hover,
.sidebar-menu .nav-link.active {
  background-color: #3e8a5b;
  color: #fff;
}

/* === Logout Button === */
.btn-logout-sidebar {
  width: 100%;
  background-color: #2e6b45;
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 10px 0;
  transition: all 0.3s ease;
}
.btn-logout-sidebar:hover {
  background-color: #3e8a5b;
  transform: scale(1.03);
}

/* === Navbar Admin === */
.navbar-admin {
  background: linear-gradient(90deg, #2e6b45, #3e8a5b);
  color: #fff;
  position: sticky;
  top: 0;
  z-index: 1020;
  border-bottom: none;
  height: 60px;
  display: flex;
  align-items: center;
  padding: 0 25px;
}
</style>


<script>
document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("adminSidebar");
  const sidebarLogo = document.getElementById("sidebarLogo");
  const miniToggle = document.getElementById("sidebarMiniToggle");

  // === Load State Sidebar ===
  const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
  if (isCollapsed) sidebar.classList.add("collapsed");

  // === Klik Logo di Sidebar ===
  if (sidebarLogo) {
    sidebarLogo.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed");
      localStorage.setItem("sidebarCollapsed", sidebar.classList.contains("collapsed"));
    });
  }

  // === Klik Mini Toggle ===
  if (miniToggle) {
    miniToggle.addEventListener("click", () => {
      sidebar.classList.remove("collapsed");
      localStorage.setItem("sidebarCollapsed", "false");
    });
  }
});
</script>


  {{-- === NAVBAR SISWA OVAL === --}}
  @elseif($role === 'siswa')
    <nav class="navbar navbar-expand-lg navbar-rounded">
      <a class="navbar-brand" href="{{ route('siswa.dashboard') }}">
        <img src="{{ asset('images/logouks.png') }}" alt="Logo">
        <span>UKS</span>
      </a>
      
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list" style="font-size: 1.5rem; color: var(--green-main);"></i>
      </button>
      
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}"><i class="bi bi-house-door"></i> Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('kontak.index') }}"><i class="bi bi-telephone"></i> Kontak</a></li>
        </ul>
        
        <div class="d-lg-none d-flex flex-column align-items-center mt-3 pt-3 border-top">
          <div class="user-info">
            <i class="bi bi-person-circle"></i>
            <span>{{ auth()->user()->nama ?? auth()->user()->name ?? 'Siswa' }}</span>
          </div>
          <form action="{{ route('logout') }}" method="POST" class="mt-2 w-100">@csrf
            <button class="btn btn-logout w-100">Logout</button>
          </form>
        </div>
      </div>
      
      <div class="d-none d-lg-flex align-items-center">
        <div class="user-info">
          <i class="bi bi-person-circle"></i>
          <span>{{ auth()->user()->nama ?? auth()->user()->name ?? 'Siswa' }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="ms-2">@csrf
          <button class="btn btn-logout btn-sm">Logout</button>
        </form>
      </div>
    </nav>

    <div class="container mt-5 pt-5">
      @yield('content')
    </div>
  @endif
@endauth

@guest
  <div class="container mt-5 pt-5">
    @yield('content')
  </div>
@endguest

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('adminSidebar');
  const toggleButton = document.getElementById('sidebarToggle');
  
  const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
  
  if (isCollapsed) {
    sidebar.classList.add('collapsed');
  }
  
  toggleButton.addEventListener('click', function() {
    sidebar.classList.toggle('collapsed');
    
    const isNowCollapsed = sidebar.classList.contains('collapsed');
    localStorage.setItem('sidebarCollapsed', isNowCollapsed);
  });
});
</script>
</body>
</html>