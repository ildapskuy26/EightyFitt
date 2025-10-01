@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Dashboard Siswa</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="content-card mb-4">
                <h5>Informasi UKS</h5>
                <p>Selamat datang di aplikasi UKS MyApp. Silakan cek data kunjungan atau informasi kesehatan terbaru.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="content-card">
                <h5>Berita Terbaru</h5>
                @forelse($berita as $item)
                    <div class="mb-3 border-bottom pb-2">
                        <h6>{{ $item->judul }}</h6>
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                 alt="{{ $item->judul }}" 
                                 class="img-fluid mb-2" 
                                 style="max-height: 200px; object-fit: cover;">
                        @endif
                        <a href="{{ route('berita.show', $item->id) }}" class="btn btn-sm btn-primary">
    Baca Selengkapnya
</a>

                    </div>
                @empty
                    <p>Belum ada berita tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
