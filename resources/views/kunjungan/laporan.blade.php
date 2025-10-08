@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📊 Laporan Kunjungan {{ ucfirst($filter) }}</h3>

    <form method="GET" action="{{ route('kunjungan.laporan') }}" class="mb-3">
        <select name="filter" class="form-select w-auto d-inline-block">
            <option value="mingguan" {{ $filter=='mingguan' ? 'selected' : '' }}>Mingguan</option>
            <option value="bulanan" {{ $filter=='bulanan' ? 'selected' : '' }}>Bulanan</option>
            <option value="tahunan" {{ $filter=='tahunan' ? 'selected' : '' }}>Tahunan</option>
        </select>
        <button class="btn btn-primary">Tampilkan</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Periode</th>
                <th>Total Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr>
                <td>{{ $row->periode }}</td>
                <td>{{ $row->total }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center">Belum ada data kunjungan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
