@extends('layouts.app')

@section('content')
<div class="container py-4 fade-in-up">
    <h3 class="fw-bold text-gradient mb-3">
        <i class="bi bi-envelope-paper"></i> Daftar Tanggapan Pengguna
    </h3>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0 text-center">
                <thead class="table-success">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tanggapans as $t)
                    <tr>
                        <td>{{ $t->nama }}</td>
                        <td>{{ $t->email }}</td>
                        <td class="text-start">{{ $t->pesan }}</td>
                        <td>
                            <span class="badge bg-{{ $t->status == 'baru' ? 'warning' : ($t->status == 'dibaca' ? 'info' : 'success') }}">
                                {{ ucfirst($t->status) }}
                            </span>
                        </td>
                        <td>
                            @if($t->status == 'baru')
                            <form action="{{ route('tanggapan.read', $t->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-primary">Tandai Dibaca</button>
                            </form>
                            @else
                            <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-muted py-3">Belum ada tanggapan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-light">
            <div class="d-flex justify-content-center">
                {{ $tanggapans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
