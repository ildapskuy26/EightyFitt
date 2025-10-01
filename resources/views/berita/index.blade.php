@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        @if(in_array(auth()->user()->role, ['admin','petugas']))
            <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">+ Tambah Berita</a>
        @endif
    @endauth

    @forelse($berita as $b)
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                @if($b->gambar)
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('storage/'.$b->gambar) }}" class="img-fluid rounded-start" style="max-height:150px;object-fit:cover;">
                    </div>
                @endif
                <div class="{{ $b->gambar ? 'col-md-9' : 'col-md-12' }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $b->judul }}</h5>
                        <p class="card-text">{{ Str::limit($b->isi, 120) }}</p>
                        <a href="{{ route('berita.show', $b->id) }}" class="btn btn-sm btn-info">Baca</a>
                        @auth
                            @if(in_array(auth()->user()->role, ['admin','petugas']))
                                <a href="{{ route('berita.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('berita.destroy', $b->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada berita.</div>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $berita->links() }}
    </div>
</div>
@endsection