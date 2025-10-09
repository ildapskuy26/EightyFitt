@extends('layouts.app')

@section('content')
<div class="container fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-gradient d-flex align-items-center gap-2">
            💊 Inventaris Obat
        </h3>

        {{-- ✅ Tombol tambah obat hanya muncul kalau admin/petugas --}}
        @if(in_array(Auth::user()->role, ['admin','petugas']))
            <a href="{{ route('obat.create') }}" 
               class="btn btn-primary shadow-sm d-flex align-items-center gap-2 btn-hover-animate">
                <i class="bi bi-plus-circle"></i> Tambah Obat
            </a>
        @endif
    </div>

    {{-- ✅ Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm animate-alert" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ✅ Tabel obat --}}
    <div class="table-responsive shadow rounded-4 overflow-hidden card-animate">
        <table class="table align-middle table-hover mb-0">
            <thead class="table-info text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Jenis</th>
                    <th>Bentuk</th>
                    <th>Dosis/Hari</th>
                    <th>Stok</th>
                    @if(in_array(Auth::user()->role, ['admin','petugas']))
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($obats as $o)
                <tr class="table-row-hover">
                    <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                    <td>{{ $o->nama }}</td>
                    <td>{{ $o->jenis_obat ?? '-' }}</td>
                    <td>{{ $o->bentuk_obat ?? '-' }}</td>
                    <td>{{ $o->dosis_per_hari ?? '-' }}</td>
                    <td>
                        @if($o->stock <= 5)
                            <span class="badge bg-danger">⚠️ {{ $o->stock }}</span>
                        @elseif($o->stock <= 10)
                            <span class="badge bg-warning text-dark">⚡ {{ $o->stock }}</span>
                        @else
                            <span class="badge bg-success">✔️ {{ $o->stock }}</span>
                        @endif
                    </td>

                    {{-- ✅ Aksi hanya admin/petugas --}}
                    @if(in_array(Auth::user()->role, ['admin','petugas']))
                    <td class="text-center">
                        <a href="{{ route('obat.edit', $o->id) }}" 
                           class="btn btn-sm btn-warning me-1 shadow-sm d-inline-flex align-items-center gap-1 btn-hover-animate">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('obat.destroy', $o->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger shadow-sm d-inline-flex align-items-center gap-1 btn-hover-animate"
                                    onclick="return confirm('Yakin hapus obat ini?')">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">😷 Tidak ada data obat</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- CSS Custom --}}
<style>
    /* 🌈 Gradient text */
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ✨ Fade-in animasi masuk */
    .fade-in-up {
        opacity: 0;
        transform: translateY(25px);
        animation: fadeInUp 0.7s ease forwards;
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* 🌟 Efek hover baris tabel */
    .table-row-hover {
        transition: all 0.2s ease-in-out;
    }
    .table-row-hover:hover {
        background-color: #f8f9fa !important;
        transform: scale(1.01);
        cursor: pointer;
    }

    /* 💫 Efek hover tombol */
    .btn-hover-animate {
        transition: all 0.2s ease;
    }
    .btn-hover-animate:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* 🪄 Animasi alert */
    .animate-alert {
        animation: popIn 0.5s ease;
    }
    @keyframes popIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    /* 💎 Animasi kartu tabel */
    .card-animate {
        animation: fadeSlideIn 0.6s ease-in-out;
    }
    @keyframes fadeSlideIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
