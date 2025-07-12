<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center">
                {{-- Logo Kota Batam --}}
                <img class="h-20 w-auto mx-auto mb-4" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Lambang_Kota_Batam.png" alt="Logo Kota Batam">

                <h2 class="text-2xl font-extrabold text-gray-800">Selamat Datang di Portal Batam</h2>
                <p class="mt-1 text-sm text-gray-600">Silakan daftar untuk membuat akun baru</p>
            </div>

            <form class="bg-white shadow-md rounded-lg px-6 py-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <div>
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="mt-1 block w-full"
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation" class="mt-1 block w-full"
                                  type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- Tombol Register --}}
                <div>
                    <x-primary-button class="w-full justify-center">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center text-sm text-gray-600 mt-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">
                    Masuk di sini
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
