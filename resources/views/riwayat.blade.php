@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Riwayat Kunjungan UKS</h1>

    @if($riwayats->isEmpty())
        <p class="text-gray-500">Belum ada data kunjungan.</p>
    @else
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Kelas</th>
                    <th class="border px-4 py-2">Keluhan</th>
                    <th class="border px-4 py-2">Obat</th>
                    <th class="border px-4 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayats as $r)
                    <tr>
                        <td class="border px-4 py-2">{{ $r->nama }}</td>
                        <td class="border px-4 py-2">{{ $r->kelas }}</td>
                        <td class="border px-4 py-2">{{ $r->keluhan }}</td>
                        <td class="border px-4 py-2">{{ $r->obat ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $r->tanggal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
