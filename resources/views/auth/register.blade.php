<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-green-50 via-white to-green-100">
        <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8 relative overflow-hidden">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/uks-logo.png') }}" alt="Logo UKS" class="w-16 h-16">
            </div>

            <h2 class="text-center text-2xl font-bold text-green-700 mb-6">
                Daftar Akun UKS
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Kata Sandi')" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Tombol Register -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-green-700 transition">
                        Sudah punya akun?
                    </a>

                    <x-primary-button class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <div class="flex-grow h-px bg-gray-300"></div>
                <span class="px-3 text-gray-500 text-sm">atau</span>
                <div class="flex-grow h-px bg-gray-300"></div>
            </div>

            <!-- Google Sign Up -->
            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg transition">
                <i class="bi bi-google text-lg mr-2"></i> Daftar dengan Google
            </a>
        </div>
    </div>
</x-guest-layout>
