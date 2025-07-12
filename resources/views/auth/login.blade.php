<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center">
                {{-- Logo Kota Batam --}}
                <img class="h-20 w-auto mx-auto mb-4" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Lambang_Kota_Batam.png" alt="Logo Kota Batam">

                <h2 class="text-2xl font-extrabold text-gray-800">Selamat Datang di Portal Batam</h2>
                <p class="mt-1 text-sm text-gray-600">Silakan masuk untuk melanjutkan ke dashboard</p>
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="bg-white shadow-md rounded-lg px-6 py-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="mt-1 block w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>

                {{-- Tombol Login --}}
                <div>
                    <x-primary-button class="w-full justify-center">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center text-sm text-gray-600 mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">
                    Daftar di sini
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
