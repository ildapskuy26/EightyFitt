@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Riwayat Kunjungan</h1>

    @if ($riwayats->isEmpty())
        <!-- Tampilan jika belum ada data -->
        <div class="text-center bg-white p-10 rounded-lg shadow">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" 
                 alt="Empty" class="mx-auto w-32 mb-4 opacity-70">
            <h2 class="text-xl font-semibold text-gray-600">Belum Ada Data</h2>
            <p class="text-gray-500 mt-2">Riwayat kunjungan akan muncul di sini setelah ada data baru.</p>
        </div>
    @else
        <!-- Tampilan jika ada data -->
        <table class="w-full bg-white border border-gray-200 shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border-b">Nama</th>
                    <th class="p-3 border-b">Keluhan</th>
                    <th class="p-3 border-b">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $r)
                    <tr>
                        <td class="p-3 border-b">{{ $r->nama }}</td>
                        <td class="p-3 border-b">{{ $r->keluhan }}</td>
                        <td class="p-3 border-b">{{ $r->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
