<nav x-data="{ open: false }" class="batik-navbar-bg shadow-legam sticky top-0 z-50">

    {{-- Garis aksen emas di bawah navbar --}}
    <div class="h-px bg-gradient-to-r from-transparent via-emas-400 to-transparent opacity-50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Kiri: Logo + Nav Links --}}
            <div class="flex items-center">

                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 shrink-0 group">
                    {{-- Ornamen ikon batik kecil --}}
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                         style="background: linear-gradient(135deg, #f0b429, #a87000);">
                        <svg class="w-4 h-4 text-legam-950" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            {{-- Icon mangkok/wajan sederhana --}}
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                        </svg>
                    </div>

                    <div class="leading-tight">
                        <span class="block text-sm font-bold tracking-tight text-gradient-emas font-serif">
                            Rasa Nusantara
                        </span>
                        <span class="block text-[10px] tracking-widest uppercase text-legam-400">
                            Sistem Admin
                        </span>
                    </div>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden sm:flex sm:items-center sm:ms-10 sm:space-x-1">
                    @can('manage-catering')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <svg class="w-3.5 h-3.5 mr-1.5 inline-block opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')">
                            <svg class="w-3.5 h-3.5 mr-1.5 inline-block opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            Kelola Data
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            {{-- Kanan: Dropdown User --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium
                                       text-legam-200 hover:text-emas-300 hover:bg-legam-800
                                       border border-transparent hover:border-emas-500/20
                                       transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-emas-500/30">
                            {{-- Avatar inisial --}}
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-legam-950"
                                  style="background: linear-gradient(135deg, #f0b429, #a87000);">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-legam-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <svg class="w-4 h-4 mr-2 inline-block text-legam-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-4 h-4 mr-2 inline-block text-tera-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger Mobile --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-lg
                               text-legam-300 hover:text-emas-300 hover:bg-legam-800
                               transition duration-150 focus:outline-none focus:ring-2 focus:ring-emas-500/30"
                        aria-expanded="false"
                        aria-label="Toggle menu">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Responsive Menu Mobile --}}
    <div :class="{'block': open, 'hidden': !open}"
         class="hidden sm:hidden border-t"
         style="border-color: rgba(240,180,41,0.15);">

        <div class="px-3 pt-2 pb-3 space-y-1">
            @can('manage-catering')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')">
                    Kelola Data
                </x-responsive-nav-link>
            @endcan
        </div>

        {{-- User info mobile --}}
        <div class="pt-3 pb-3 border-t" style="border-color: rgba(240,180,41,0.15);">
            <div class="px-4 flex items-center gap-3 mb-2">
                <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-legam-950"
                      style="background: linear-gradient(135deg, #f0b429, #a87000);">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
                <div>
                    <div class="text-sm font-semibold text-legam-100">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-legam-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="px-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profil
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

</nav>
