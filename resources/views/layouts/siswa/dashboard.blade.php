@extends('layouts.app')

@section('content')
<h1>Dashboard Siswa</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>

<div class="card mt-3">
    <div class="card-body">
        <h5>Menu Siswa</h5>
        <ul>
            <li><a href="#">Lihat Nilai</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </div>
</div>
@endsection
