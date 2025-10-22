<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKS - SMKN 8 Jakarta</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.8s ease-out; }

        .slider-container {
            position: relative;
            width: 100%;
            max-width: 1000px;
            height: 700px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border-radius: 25px;
            background: white;
        }
        
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.7s ease-in-out;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 30px;
        }
        .login-container { left: 0; width: 50%; z-index: 2; }
        .register-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
        .slider-container.active .login-container { transform: translateX(100%); opacity: 0; }
        .slider-container.active .register-container { transform: translateX(100%); opacity: 1; z-index: 5; }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.7s ease-in-out;
            z-index: 100;
        }
        .slider-container.active .overlay-container { transform: translateX(-100%); }

        .overlay {
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            background: linear-gradient(135deg, #16a34a 0%, #0d9488 50%, #0284c7 100%);
            transform: translateX(0);
            transition: transform 0.7s ease-in-out;
        }
        .slider-container.active .overlay { transform: translateX(50%); }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 60px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.7s ease-in-out;
            color: white;
        }
        .overlay-left { transform: translateX(-20%); }
        .slider-container.active .overlay-left { transform: translateX(0); }
        .overlay-right { right: 0; transform: translateX(0); }
        .slider-container.active .overlay-right { transform: translateX(20%); }

        .form-input {
            border-radius: 12px;
            border: 1.5px solid #e5e7eb;
            padding: 14px 16px;
            transition: all 0.3s;
            font-size: 15px;
        }
        .form-input:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
            outline: none;
        }

        .btn-primary {
            background: #16a34a;
            color: white;
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(22, 163, 74, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid white;
            cursor: pointer;
        }
        .btn-outline:hover {
            background: white;
            color: #16a34a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }

        /* Tombol Google baru (biru) */
        .google-btn {
            background-color: #0ea5e9 !important; /* Biru terang */
            border-color: #0284c7 !important;     /* Biru gelap */
            color: white !important;
        }
        .google-btn:hover {
            background-color: #0284c7 !important; /* Hover biru gelap */
            border-color: #0ea5e9 !important;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #9ca3af;
            font-size: 14px;
            margin: 20px 0;
        }
        .divider::before, .divider::after { content: ''; flex: 1; border-bottom: 1px solid #e5e7eb; }
        .divider::before { margin-right: 15px; }
        .divider::after { margin-left: 15px; }

        .checkbox-custom {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1.5px solid #d1d5db;
            appearance: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }
        .checkbox-custom:checked {
            background-color: #16a34a;
            border-color: #16a34a;
        }
        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 12px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .logo-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }
        .logo-badge {
            position: absolute;
            bottom: -5px;
            right: calc(50% - 70px);
            background: #16a34a;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .form-header { margin-top: -10px; margin-bottom: 10px; }
        .form-content { overflow-y: auto; max-height: 85%; padding: 5px; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-green-50 via-white to-blue-50 p-6">
    <div class="slider-container animate-fadeIn">
        <!-- Login Form -->
        <div class="form-container login-container">
            <div class="form-header">
                <div class="logo-container flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-lg">
                        <img src="{{ asset('images/smk.png') }}" alt="Logo UKS" class="w-full h-full object-cover">
                    </div>
                </div>
                <h1 class="text-xl font-bold text-gray-800 mt-9">Selamat Datang</h1>
                <p class="text-gray-500 text-sm mt-1">Masuk untuk melanjutkan ke sistem UKS</p>
            </div>

            <div class="form-content">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" type="email" name="email" class="form-input w-full" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <div>
                        <label for="password" class="block font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" class="form-input w-full" required autocomplete="current-password" />
                    </div>
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center text-sm text-gray-600 cursor-pointer">
                            <input id="remember_me" type="checkbox" class="checkbox-custom mr-2" name="remember">
                            <span>Ingat saya</span>
                        </label>
                        <a class="text-sm text-green-600 hover:text-green-700 font-medium transition-colors" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    </div>
                    <div class="pt-2">
                        <button class="btn-primary w-full text-lg py-3">Masuk</button>
                    </div>
                    <div class="divider">atau</div>
                    <!-- Google Button -->
                    <div>
                        <a href="{{ route('google.login') }}" class="w-full inline-flex justify-center items-center py-3 px-4 font-semibold rounded-lg shadow-sm transition-all duration-300 google-btn">
                            <i class="bi bi-google mr-3 text-lg text-white"></i>
                            Login dengan Google
                        </a>
                    </div>
                    <div class="text-center mt-4 text-sm">
                        <span class="text-gray-500">Belum punya akun?</span>
                        <button type="button" id="showRegister" class="text-green-600 hover:text-green-700 font-semibold ml-1 transition-colors focus:outline-none">Daftar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Register Form -->
        <div class="form-container register-container">
            <div class="form-header">
                <div class="logo-container flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-lg">
                        <img src="{{ asset('images/smk.png') }}" alt="Logo UKS" class="w-full h-full object-cover">
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Daftar Akun UKS</h1>
                <p class="text-gray-500 text-sm mt-1">Bergabunglah dengan kami dan daftarkan akun Anda</p>
            </div>

            <div class="form-content">
                <form method="POST" action="{{ route('register') }}" class="space-y-3">
                    @csrf
                    <div>
                        <label for="name" class="block font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input id="name" class="form-input w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <div>
                        <label for="email" class="block font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" class="form-input w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>
                    <div>
                        <label for="password" class="block font-medium text-gray-700 mb-2">Kata Sandi</label>
                        <input id="password" class="form-input w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="block font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" class="form-input w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    <div class="pt-2">
                        <button class="btn-primary w-full text-lg py-3">Daftar</button>
                    </div>
                    <div class="divider">atau</div>
                    <!-- Google Register Button -->
                    <a href="{{ route('google.login') }}" class="w-full inline-flex justify-center items-center py-3 px-4 font-semibold rounded-lg shadow-sm transition-all duration-300 google-btn">
                        <i class="bi bi-google mr-3 text-lg text-white"></i> 
                        Daftar dengan Google
                    </a>
                    <div class="text-center mt-4 text-sm">
                        <span class="text-gray-500">Sudah punya akun?</span>
                        <button type="button" id="showLogin" class="text-green-600 hover:text-green-700 font-semibold ml-1 transition-colors focus:outline-none">Masuk</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Overlay -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <div class="w-28 h-28 rounded-full bg-white/20 flex items-center justify-center mb-6 shadow-lg">
                        <i class="bi bi-person-check text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Selamat Datang Kembali!</h3>
                    <p class="text-base mb-6">Masuk untuk mengakses akun UKS Anda</p>
                    <button id="loginOverlay" class="btn-outline">Masuk</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <div class="w-28 h-28 rounded-full bg-white/20 flex items-center justify-center mb-6 shadow-lg">
                        <i class="bi bi-person-plus text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Halo, Sobat UKS!</h3>
                    <p class="text-base mb-6">Bergabunglah dengan kami dan daftarkan akun Anda</p>
                    <button id="registerOverlay" class="btn-outline">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.slider-container');
            const showRegisterBtn = document.getElementById('showRegister');
            const showLoginBtn = document.getElementById('showLogin');
            const loginOverlayBtn = document.getElementById('loginOverlay');
            const registerOverlayBtn = document.getElementById('registerOverlay');
            
            showRegisterBtn.addEventListener('click', () => { container.classList.add('active'); });
            showLoginBtn.addEventListener('click', () => { container.classList.remove('active'); });
            loginOverlayBtn.addEventListener('click', () => { container.classList.remove('active'); });
            registerOverlayBtn.addEventListener('click', () => { container.classList.add('active'); });
        });
    </script>
</body>
</html>
