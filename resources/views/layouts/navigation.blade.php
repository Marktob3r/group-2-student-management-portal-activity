<nav x-data="{ open: false }" class="bg-navy border-b-2 border-gold shadow-md" style="--navy:#1B2A4A; --gold:#C9A84C; background-color:#1B2A4A; border-bottom-color:#C9A84C;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <x-application-logo class="block h-10 w-auto" />
                        <div class="hidden sm:block leading-tight">
                            <div class="text-sm font-bold" style="color:#C9A84C;">Student Portal</div>
                            <div class="text-xs" style="color:rgba(255,255,255,0.5);">Gordon College</div>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-md transition-all duration-150
                        {{ request()->routeIs('dashboard')
                            ? 'text-white'
                            : 'text-gray-300 hover:text-white' }}"
                        style="{{ request()->routeIs('dashboard') ? 'color:#C9A84C; border-bottom:2px solid #C9A84C;' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Right side: User info + Logout Button -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">

                <!-- User name display -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-150"
                            style="color:rgba(255,255,255,0.8); background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12);"
                            onmouseover="this.style.background='rgba(255,255,255,0.12)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                            <svg class="h-4 w-4" style="color:#C9A84C;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-4 w-4 opacity-60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- Logout Button (always visible in navbar) -->
                <button
                    id="navbar-logout-btn"
                    @click="$dispatch('open-logout')"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg shadow transition-all duration-200 active:scale-95 focus:outline-none"
                    style="background:#C9A84C; color:#1B2A4A;"
                    onmouseover="this.style.background='#E2C170'"
                    onmouseout="this.style.background='#C9A84C'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </button>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out focus:outline-none" style="color:rgba(255,255,255,0.7);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background:#111D35; border-top:1px solid rgba(201,168,76,0.3);">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 rounded-md text-sm font-semibold transition"
                style="color:{{ request()->routeIs('dashboard') ? '#C9A84C' : 'rgba(255,255,255,0.75)' }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 px-4" style="border-top:1px solid rgba(255,255,255,0.08);">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold" style="background:#C9A84C; color:#1B2A4A;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-semibold text-sm text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs" style="color:rgba(255,255,255,0.45);">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-sm font-medium transition" style="color:rgba(255,255,255,0.7);">
                    Profile
                </a>

                <!-- Mobile Logout Button -->
                <button
                    id="mobile-navbar-logout-btn"
                    @click="$dispatch('open-logout')"
                    class="w-full flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg transition-all duration-200 active:scale-95"
                    style="background:#C9A84C; color:#1B2A4A;"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </button>
            </div>
        </div>
    </div>
</nav>
