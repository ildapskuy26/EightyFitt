@extends('layouts.app')

@section('content')
<div class="container py-5 fade-in">
    <h3 class="mb-4 fw-bold text-success">📬 Kontak UKS SMKN 8 Jakarta</h3>

    <form action="{{ route('kontak.send') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
        </div>
        <div class="col-md-6">
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="col-12">
            <textarea name="pesan" class="form-control" rows="5" placeholder="Pesan" required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">Kirim Pesan via WA</button>
        </div>
    </form>
</div>

<style>
.fade-in { opacity: 0; transform: translateY(20px); animation: fadeIn 0.8s ease forwards; }
@keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
