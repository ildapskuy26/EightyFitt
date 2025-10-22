@extends('layouts.app')

@section('content')
<div class="container fade-in-up">

    {{-- 🌿 Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-gradient d-flex align-items-center gap-2 mb-0">
            <i class="bi bi-prescription2"></i> Inventaris Obat UKS
        </h3>

        {{-- ✅ Tombol tambah hanya untuk admin/petugas --}}
        @if(in_array(Auth::user()->role, ['admin','petugas']))
            <a href="{{ route('obat.create') }}" 
               class="btn btn-success shadow-sm d-flex align-items-center gap-2 btn-hover-animate px-3 py-2 rounded-3">
                <i class="bi bi-plus-lg"></i> Tambah Obat
            </a>
        @endif
    </div>

    {{-- ✅ Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm animate-alert rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- 💊 Tabel Data Obat --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden card-animate">
        <div class="table-responsive">
            <table class="table align-middle mb-0 text-center">
                <thead class="table-header-custom">
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Jenis</th>
                        <th>Bentuk</th>
                        <th>Dosis/Hari</th>
                        <th>Stok Awal</th>
                        <th>Stok Terpakai</th>
                        <th>Kadar</th>
                        @if(in_array(Auth::user()->role, ['admin','petugas']))
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($obats as $o)
                    <tr class="table-row-hover">
                        <td class="fw-semibold">{{ $loop->iteration }}</td>
                        <td class="text-start ps-4">{{ $o->nama }}</td>
                        <td>{{ $o->jenis_obat ?? '-' }}</td>
                        <td>{{ $o->bentuk_obat ?? '-' }}</td>
                        <td>{{ $o->dosis_per_hari ?? '-' }}</td>

                        {{-- Stok Awal --}}
                        <td>
                            @if($o->stock <= 5)
                                <span class="badge bg-danger-soft text-danger fw-semibold">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $o->stock }}
                                </span>
                            @elseif($o->stock <= 10)
                                <span class="badge bg-warning-soft text-dark fw-semibold">
                                    <i class="bi bi-lightning-charge-fill me-1"></i>{{ $o->stock }}
                                </span>
                            @else
                                <span class="badge bg-success-soft text-success fw-semibold">
                                    <i class="bi bi-check-circle-fill me-1"></i>{{ $o->stock }}
                                </span>
                            @endif
                        </td>

                        {{-- Stok Terpakai --}}
                        <td>
                            <span class="badge bg-primary-subtle text-primary fw-semibold">
                                {{ $o->stok_terpakai ?? 0 }}
                            </span>
                        </td>

                        {{-- Kadar --}}
                        <td>{{ $o->kadar ?? '-' }}</td>

                        {{-- Aksi --}}
                        @if(in_array(Auth::user()->role, ['admin','petugas']))
                        <td>
                            <a href="{{ route('obat.edit', $o->id) }}" 
                               class="btn btn-sm btn-outline-warning btn-hover-animate me-1 d-inline-flex align-items-center gap-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('obat.destroy', $o->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-hover-animate d-inline-flex align-items-center gap-1"
                                        onclick="return confirm('Yakin hapus obat ini?')">
                                    <i class="bi bi-trash3-fill"></i> Hapus
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="bi bi-emoji-frown me-2"></i> Tidak ada data obat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 🌸 CSS --}}
<style>
    .text-gradient {
        background: linear-gradient(90deg, #00c6ff, #007b55);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .table-header-custom {
        background: linear-gradient(90deg, #e8f9e9, #e3f2fd);
        color: #2f4858;
        font-weight: 600;
        letter-spacing: 0.4px;
        border-bottom: 2px solid #dceefc;
    }

    .bg-success-soft { background-color: #d4edda !important; }
    .bg-warning-soft { background-color: #fff3cd !important; }
    .bg-danger-soft  { background-color: #f8d7da !important; }
    .bg-primary-subtle { background-color: #e7f1ff !important; }

    .table-row-hover {
        transition: all 0.25s ease;
    }
    .table-row-hover:hover {
        background: #f9fff9;
        transform: scale(1.005);
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .card-animate {
        animation: fadeSlideIn 0.7s ease-in-out;
    }
    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .btn-hover-animate {
        transition: all 0.25s ease;
    }
    .btn-hover-animate:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .animate-alert {
        animation: popIn 0.4s ease;
    }
    @keyframes popIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease forwards;
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
