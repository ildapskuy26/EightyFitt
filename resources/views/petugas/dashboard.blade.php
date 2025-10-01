@extends('layouts.app')

@section('content')
<h1>Dashboard Petugas</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>

<div class="card mt-3">
    <div class="card-body">
        <h5>Menu Petugas</h5>
        <ul>
            <li><a href="{{ route('kunjungan.index') }}">Input Kunjungan</a></li>
            <li><a href="{{ route('obat.index') }}">Input Obat</a></li>
        </ul>
    </div>
</div>
@endsection
