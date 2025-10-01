<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-text-top" style="height:30px;" />
        </a>

        <!-- Toggle (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
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
                    @endif
                @endauth
            </ul>

            <!-- User Menu -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
