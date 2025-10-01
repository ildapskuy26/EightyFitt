@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold mb-4 text-primary text-center text-md-start">Riwayat Kunjungan</h1>

    @if ($riwayats->isEmpty())
        <!-- Tampilan jika belum ada data -->
        <div class="card text-center shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" 
                     alt="Empty" class="mx-auto d-block mb-4 img-fluid" style="max-width: 120px; opacity: .7;">
                <h4 class="card-title text-muted">Belum Ada Data</h4>
                <p class="text-secondary">Riwayat kunjungan akan muncul di sini setelah ada data baru.</p>
            </div>
        </div>
    @else
        <!-- Tampilan jika ada data -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-primary text-center">
                            <tr>
                                <th class="text-nowrap">Nama</th>
                                <th class="text-nowrap">Keluhan</th>
                                <th class="text-nowrap">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayats as $r)
                                <tr>
                                    <td class="text-truncate" style="max-width: 150px;">{{ $r->nama }}</td>
                                    <td class="text-truncate" style="max-width: 250px;">{{ $r->keluhan }}</td>
                                    <td class="text-nowrap">{{ $r->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination responsif -->
        <div class="d-flex justify-content-center mt-3">
            {{ $riwayats->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
