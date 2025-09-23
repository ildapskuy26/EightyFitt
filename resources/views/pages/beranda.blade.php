<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKS App</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between">
        <div>
            <a href="{{ url('/') }}" class="mr-4">Beranda</a>
            <a href="{{ url('/riwayat') }}" class="mr-4">Riwayat Kunjungan</a>
            <a href="{{ url('/obat') }}" class="mr-4">Data Obat</a>
            <a href="{{ url('/tentang') }}" class="mr-4">Tentang</a>
        </div>
        <div>
            @guest
                <a href="{{ route('login') }}" class="text-blue-500">Login</a>
            @else
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500">Logout</button>
                </form>
            @endguest
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto p-6">
        @yield('content')
    </div>
</body>
</html>