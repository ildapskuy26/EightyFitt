@extends('layouts.app')

@section('content')
<h1>Dashboard Petugas</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>

<div class="card mt-3">
    <div class="card-body">
        <h5>Menu Petugas</h5>
        <ul>
            <li><a href="#">Input Data</a></li>
            <li><a href="#">Kelola Transaksi</a></li>
        </ul>
    </div>
</div>
@endsection
