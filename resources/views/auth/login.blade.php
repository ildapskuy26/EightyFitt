<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-green-200 via-white to-blue-100">
        <div class="w-full max-w-md bg-white/80 backdrop-blur-lg shadow-2xl rounded-2xl p-8 space-y-6 border border-gray-200 animate-fadeIn">

            <!-- Header -->
            <div class="text-center mb-2">
                <a href="/" class="inline-block">
                    <img src="{{ asset('images/logouks.png') }}" 
                         alt="Logo UKS" 
                         class="h-24 mx-auto mb-3 drop-shadow-md transition-transform duration-300 hover:scale-105">
                </a>
                <h2 class="text-lg font-semibold text-green-700 tracking-wide uppercase">SMKN 8 Jakarta</h2>
                <h1 class="text-3xl font-extrabold text-gray-800 mt-1">Selamat Datang</h1>
                <p class="text-gray-500 text-sm mt-1">Masuk untuk melanjutkan ke sistem UKS</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
                    <x-text-input id="email" type="email" name="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
                    <x-text-input id="password" type="password" name="password"
                        class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" 
                            class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                            name="remember">
                        <span class="ml-2">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:text-green-700 underline font-medium"
                           href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>

                <!-- Tombol Login -->
                <div class="pt-3">
                    <x-primary-button class="w-full justify-center text-center py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-transform duration-300 hover:scale-[1.02]">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>

                <!-- Pemisah -->
                <div class="flex items-center justify-center space-x-2 mt-4">
                    <span class="border-b border-gray-300 w-1/3"></span>
                    <span class="text-gray-400 text-sm">atau</span>
                    <span class="border-b border-gray-300 w-1/3"></span>
                </div>

                <!-- Login Google -->
                <div>
                    <a href="{{ route('google.login') }}" 
                        class="w-full inline-flex justify-center items-center py-2 px-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition-transform duration-300 hover:scale-[1.02]">
                        <i class="bi bi-google mr-2 text-lg"></i>
                        Login dengan Google
                    </a>
                </div>

                <!-- Link Daftar -->
                <div class="text-center mt-4 text-sm">
                    <span class="text-gray-500">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">
                        Daftar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Animasi Fade In -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out;
        }
    </style>
</x-guest-layout>
