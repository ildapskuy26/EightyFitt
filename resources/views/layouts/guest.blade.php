<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logouks.png') }}">
    <title>UKS - SMKN 8 Jakarta</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet">
    <!-- Tailwind + Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        /* Biru lebih gelap + gradient smooth */
        background: linear-gradient(135deg, #084298, #0b5ed7, #198754);
        background-attachment: fixed;
        color: #333;
        overflow-x: hidden;
    }

    /* Logo Animation */
    .logo {
        transition: transform 0.3s ease;
    }
    .logo:hover {
        transform: scale(1.05) rotate(2deg);
    }

    /* Glass Card */
    .glass-card {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.25);
    }

    /* Header Animation */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Floating Circles (Background Decoration) */
    .circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        filter: blur(80px);
        animation: float 10s infinite ease-in-out;
    }

    .circle:nth-child(1) {
        width: 220px;
        height: 220px;
        top: 10%;
        left: 12%;
        animation-delay: 0s;
    }

    .circle:nth-child(2) {
        width: 320px;
        height: 320px;
        bottom: 10%;
        right: 15%;
        animation-delay: 3s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-20px) scale(1.05); }
    }

    /* Footer Text */
    .footer-text {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.85);
        text-align: center;
        margin-top: 2rem;
    }
</style>

</head>

<body class="antialiased">
    <div class="relative min-h-screen flex flex-col justify-center items-center p-6 overflow-hidden">
        <!-- Floating Circles Background -->
        <div class="circle"></div>
        <div class="circle"></div>

        <!-- Logo -->
        <!-- <div class="fade-in mb-4 text-center">
            <a href="/">
                <img src="{{ asset('images/logouks.png') }}" alt="Logo UKS" class="logo h-24 mx-auto mb-2 object-contain">
            </a>
            <h2 class="text-white fw-bold fs-5 tracking-wide">Unit Kesehatan Sekolah</h2>
            <h5 class="text-white-50 fs-6">SMKN 8 Jakarta</h5>
        </div> -->

        <!-- Glass Card (Form Container) -->
        <div class="glass-card w-full sm:max-w-md p-6 fade-in">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <p class="footer-text fade-in">&copy; {{ date('Y') }} UKS SMKN 8 Jakarta — Powered by Laravel</p>
    </div>
</body>
</html>
