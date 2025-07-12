<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard Admin') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.perusahaan.index')" :active="request()->routeIs('admin.perusahaan.*')">
                            {{ __('Manajemen Perusahaan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.lowongan.index')" :active="request()->routeIs('admin.lowongan.*')">
                            {{ __('Manajemen Lowongan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.datamaster.kategori.index')" :active="request()->routeIs('admin.datamaster.*')">
                            {{ __('Data Master') }}
                        </x-nav-link>
                    @elseif (Auth::user()->role === 'perusahaan')
                        <x-nav-link :href="route('perusahaan.dashboard')" :active="request()->routeIs('perusahaan.dashboard')">
                            {{ __('Dashboard Perusahaan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('perusahaan.profil.edit')" :active="request()->routeIs('perusahaan.profil.edit')">
                            {{ __('Profil Perusahaan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('perusahaan.lowongan.index')" :active="request()->routeIs('perusahaan.lowongan.*')">
                            {{ __('Manajemen Lowongan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('perusahaan.lamaran.index')" :active="request()->routeIs('perusahaan.lamaran.*')">
                            {{ __('Manajemen Lamaran') }}
                        </x-nav-link>
                    @elseif (Auth::user()->role === 'pelamar')
                        <x-nav-link :href="route('pelamar.dashboard')" :active="request()->routeIs('pelamar.dashboard')">
                            {{ __('Dashboard Pelamar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pelamar.profil.edit')" :active="request()->routeIs('pelamar.profil.edit')">
                            {{ __('Profil Saya') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pelamar.lowongan.index')" :active="request()->routeIs('pelamar.lowongan.index')">
                            {{ __('Cari Lowongan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pelamar.lamaran.index')" :active="request()->routeIs('pelamar.lamaran.index')">
                            {{ __('Riwayat Lamaran') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    @if (Auth::user()->role !== 'admin') {{-- Notifikasi lonceng untuk non-admin --}}
                        <div class="relative mr-4">
                            <a href="{{ route(Auth::user()->role . '.notifications.index') }}" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 4.36 6 6.93 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.21 1.79-4 4-4s4 1.79 4 4v6z"></path>
                                </svg>
                                @php
                                    $unreadCount = Auth::user()->unreadNotifications->count();
                                @endphp
                                @if ($unreadCount > 0)
                                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    @endif
                @endauth

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.perusahaan.index')" :active="request()->routeIs('admin.perusahaan.*')">
                    {{ __('Manajemen Perusahaan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.lowongan.index')" :active="request()->routeIs('admin.lowongan.*')">
                    {{ __('Manajemen Lowongan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.datamaster.kategori.index')" :active="request()->routeIs('admin.datamaster.*')">
                    {{ __('Data Master') }}
                </x-responsive-nav-link>
            @elseif (Auth::user()->role === 'perusahaan')
                <x-responsive-nav-link :href="route('perusahaan.dashboard')" :active="request()->routeIs('perusahaan.dashboard')">
                    {{ __('Dashboard Perusahaan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('perusahaan.profil.edit')" :active="request()->routeIs('perusahaan.profil.edit')">
                    {{ __('Profil Perusahaan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('perusahaan.lowongan.index')" :active="request()->routeIs('perusahaan.lowongan.*')">
                    {{ __('Manajemen Lowongan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('perusahaan.lamaran.index')" :active="request()->routeIs('perusahaan.lamaran.*')">
                    {{ __('Manajemen Lamaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('perusahaan.notifications.index')" :active="request()->routeIs('perusahaan.notifications.*')">
                    {{ __('Notifikasi') }}
                    @php $unreadCount = Auth::user()->unreadNotifications->count(); @endphp
                    @if ($unreadCount > 0)
                        <span class="ml-2 px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </x-responsive-nav-link>
            @elseif (Auth::user()->role === 'pelamar')
                <x-responsive-nav-link :href="route('pelamar.dashboard')" :active="request()->routeIs('pelamar.dashboard')">
                    {{ __('Dashboard Pelamar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pelamar.profil.edit')" :active="request()->routeIs('pelamar.profil.edit')">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pelamar.lowongan.index')" :active="request()->routeIs('pelamar.lowongan.index')">
                    {{ __('Cari Lowongan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pelamar.lamaran.index')" :active="request()->routeIs('pelamar.lamaran.index')">
                    {{ __('Riwayat Lamaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pelamar.notifications.index')" :active="request()->routeIs('pelamar.notifications.*')">
                    {{ __('Notifikasi') }}
                    @php $unreadCount = Auth::user()->unreadNotifications->count(); @endphp
                    @if ($unreadCount > 0)
                        <span class="ml-2 px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
