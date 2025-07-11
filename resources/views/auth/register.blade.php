<x-guest-layout>
    <div class="w-screen h-screen mx-auto bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
        <!-- Left: Register Form -->
        <div class="p-10 mb-auto mt-auto mr-10 ml-10">
            <h2 class="text-3xl font-bold mb-8 text-center">Register</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="name" :value="old('name')" required autofocus placeholder="Masukkan nama" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="email" name="email" :value="old('email')" required placeholder="Masukkan email aktif" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Masukkan password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Ulangi password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <div>
                    <x-primary-button class="w-full justify-center bg-blue-700 hover:bg-blue-800 text-white font-semibold text-lg py-3 rounded-xl">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>

                <!-- Already have an account -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Right: Illustration -->
        <div class="bg-gray-50 hidden md:flex items-center justify-center p-6">
            <img src="{{ asset('images/Login.png') }}" alt="Register Illustration" class="max-w-full h-auto">
        </div>
    </div>
</x-guest-layout>
