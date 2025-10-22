@extends('layouts.app')

@section('content')
<div class="container py-4 fade-in-up">

    {{-- Judul & Tombol Aksi --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h3 class="fw-bold text-gradient mb-0">Kelola User</h3>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('petugas.create') }}" class="btn btn-success shadow-sm d-flex align-items-center gap-2 btn-hover-animate">
                <i class="bi bi-person-plus"></i> Tambah Petugas
            </a>
        </div>
    </div>

    {{-- Data Petugas --}}
    <div class="slide-up mb-4">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden hover-card">
            <div class="card-header bg-success text-white fw-bold sticky-top">
                <i class="bi bi-shield-check"></i> Data Petugas
            </div>
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light text-center sticky-top" style="top: 0; z-index: 1;">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($petugas as $p)
                        <tr class="table-row-hover">
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('petugas.edit', $p->id) }}" 
                                   class="btn btn-warning btn-sm shadow-sm me-1 btn-hover-animate">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('petugas.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm shadow-sm btn-hover-animate"
                                            onclick="return confirm('Hapus petugas ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Tidak ada data petugas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-light py-2">
                <div class="d-flex justify-content-center">
                    {{ $petugas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Data Siswa --}}
    <div class="slide-up" style="animation-delay: .2s;">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden hover-card">
            <div class="card-header bg-primary text-white fw-bold sticky-top">
                <i class="bi bi-people-fill"></i> Data User
            </div>
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light text-center sticky-top" style="top: 0; z-index: 1;">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $s)
                        <tr class="table-row-hover">
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('siswa.edit', $s->id) }}" 
                                   class="btn btn-warning btn-sm shadow-sm me-1 btn-hover-animate">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm shadow-sm btn-hover-animate"
                                            onclick="return confirm('Hapus siswa ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Tidak ada data siswa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-light py-2">
                <div class="d-flex justify-content-center">
                    {{ $siswa->links('pagination::bootstrap-5', ['paginator' => $siswa, 'pageName' => 'siswa']) }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🌈 CSS Custom --}}
<style>
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease forwards;
    }
    @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

    .slide-up {
        opacity: 0;
        transform: translateY(25px);
        animation: slideUp 0.8s ease forwards;
    }
    .slide-up:nth-child(1) { animation-delay: 0.1s; }
    .slide-up:nth-child(2) { animation-delay: 0.3s; }
    @keyframes slideUp { to { opacity: 1; transform: translateY(0); } }

    .table-row-hover {
        transition: all 0.25s ease-in-out;
    }
    .table-row-hover:hover {
        background-color: #f1fdf6 !important;
        transform: scale(1.01);
    }

    .btn-hover-animate {
        transition: all 0.25s ease-in-out;
    }
    .btn-hover-animate:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .hover-card {
        transition: all 0.3s ease-in-out;
    }
    .hover-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12) !important;
    }

    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Scrollbar lembut */
    .table-responsive::-webkit-scrollbar {
        width: 8px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #cfd8dc;
        border-radius: 4px;
    }
</style>
@endsection
