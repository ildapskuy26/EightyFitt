@extends('layouts.app')

@section('content')
<div class="container py-4 fade-in-up">

    {{-- 🧭 Judul & Tombol Aksi --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h3 class="fw-bold text-gradient mb-0">Kelola User</h3>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('petugas.create') }}" class="btn btn-success shadow-sm d-flex align-items-center gap-2 btn-hover-animate">
                <i class="bi bi-person-plus"></i> Tambah Petugas
            </a>
        </div>
    </div>

    {{-- ======================== PETUGAS ======================== --}}
    <div class="slide-up mb-5">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden hover-card">
            <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center flex-wrap">
                <span><i class="bi bi-shield-check"></i> Data Petugas</span>

                {{-- 🔍 Search Petugas (Realtime) --}}
                <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                    <input type="text" id="searchPetugas" class="form-control form-control-sm rounded-pill"
                           placeholder="Cari nama atau email..." style="width: 220px;">
                    <button class="btn btn-light btn-sm rounded-pill px-3 shadow-sm" onclick="document.getElementById('searchPetugas').value=''; filterTable('petugas')">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table id="tablePetugas" class="table align-middle table-hover mb-0">
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
        </div>
    </div>

    {{-- ======================== USER SISWA ======================== --}}
    <div class="slide-up" style="animation-delay: .2s;">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden hover-card">
            <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center flex-wrap">
                <span><i class="bi bi-people-fill"></i> Data User</span>

                {{-- 🔍 Search User (Realtime) --}}
                <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                    <input type="text" id="searchUser" class="form-control form-control-sm rounded-pill"
                           placeholder="Cari nama atau email..." style="width: 220px;">
                    <button class="btn btn-light btn-sm rounded-pill px-3 shadow-sm" onclick="document.getElementById('searchUser').value=''; filterTable('user')">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table id="tableUser" class="table align-middle table-hover mb-0">
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
                                            onclick="return confirm('Hapus user ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Tidak ada data user.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ✨ CSS Animasi & Hover --}}
<style>
    .fade-in-up { opacity: 0; transform: translateY(20px); animation: fadeInUp 0.8s ease forwards; }
    @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

    .slide-up { opacity: 0; transform: translateY(25px); animation: slideUp 0.8s ease forwards; }
    .slide-up:nth-child(1){ animation-delay: 0.1s; }
    .slide-up:nth-child(2){ animation-delay: 0.3s; }
    @keyframes slideUp { to { opacity: 1; transform: translateY(0); } }

    .table-row-hover { transition: all 0.25s ease-in-out; }
    .table-row-hover:hover { background-color: #f1fdf6 !important; transform: scale(1.01); }

    .btn-hover-animate { transition: all 0.25s ease-in-out; }
    .btn-hover-animate:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.12); }

    .hover-card { transition: all 0.3s ease-in-out; }
    .hover-card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.12) !important; }

    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

{{-- 🔍 JS Filter --}}
<script>
function filterTable(type) {
    let input, filter, table, tr, td, i, txtValue;
    if (type === 'petugas') {
        input = document.getElementById("searchPetugas");
        table = document.getElementById("tablePetugas");
    } else {
        input = document.getElementById("searchUser");
        table = document.getElementById("tableUser");
    }

    filter = input.value.toLowerCase();
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        let tds = tr[i].getElementsByTagName("td");
        let found = false;
        for (let j = 0; j < 2; j++) { // hanya kolom Nama & Email
            if (tds[j]) {
                txtValue = tds[j].textContent || tds[j].innerText;
                if (txtValue.toLowerCase().includes(filter)) {
                    found = true;
                    break;
                }
            }
        }
        tr[i].style.display = found ? "" : "none";
    }
}

document.getElementById("searchPetugas").addEventListener("keyup", () => filterTable('petugas'));
document.getElementById("searchUser").addEventListener("keyup", () => filterTable('user'));
</script>
@endsection
