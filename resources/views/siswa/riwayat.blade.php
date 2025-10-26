@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Riwayat Kunjungan Saya</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Obat</th>
                <th>Waktu Keluar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayats as $r)
            <tr>
                <td>{{ $r->waktu_kedatangan }}</td>
                <td>{{ $r->keluhan ?? '-' }}</td>
                <td>{{ optional($r->obat)->nama ?? '-' }}</td>
                <td>{{ $r->waktu_keluar ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada riwayat kunjungan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
