<x-guest-layout>
        <div class="w-screen h-screen mx-auto bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
            <!-- Left: Login Form -->
            <div class="p-10 item-center mb-auto mt-auto mr-10 ml-10">
                <h2 class="text-3xl font-bold mb-8 text-center">Login</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email / Username -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="email" :value="old('email')" required autofocus placeholder="Masukan E-mail" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required
                            placeholder="Masukan password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    {{-- <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div> --}}

                    <!-- Login Button -->
                    <div>
                        <x-primary-button class="w-full justify-center bg-blue-700 hover:bg-blue-800 text-white font-semibold text-lg py-3 rounded-xl">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>
                    {{-- <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register di sini</a>
                    </p>
                </div> --}}
                </form>
            </div>

            <!-- Right: Illustration -->
            <div class="bg-gray-50 hidden md:flex items-center justify-center p-6">
                <img src="{{ asset('images/Login.png') }}" alt="Login Illustration" class="max-w-full h-auto">
            </div>
        </div>
    </div>
</x-guest-layout>
