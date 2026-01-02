<nav class="bg-white border-b border-emerald-100" aria-label="Menu panelu użytkownika">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    @php
                        $logoRoute = 'dashboard';
                        if(Auth::user()->role->name === 'lekarz') $logoRoute = 'doctor.dashboard';
                        if(Auth::user()->role->name === 'admin') $logoRoute = 'admin.dashboard';
                    @endphp
                    <a href="{{ route($logoRoute) }}" aria-label="Powrót do panelu MediPet">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo MediPet" class="block h-10 w-auto rounded-lg shadow-sm">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role->name === 'klient')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="focus:text-emerald-600">
                            {{ __('Panel Klienta') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pets.index')" :active="request()->routeIs('pets.*')" class="focus:text-emerald-600">
                            {{ __('Moje Zwierzęta') }}
                        </x-nav-link>
                        <x-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')" class="focus:text-emerald-600">
                            {{ __('Moje Wizyty') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role->name === 'lekarz')
                        <x-nav-link :href="route('doctor.dashboard')" :active="request()->routeIs('doctor.dashboard')">
                            {{ __('Panel Lekarza') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role->name === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Panel Admina') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users*')">
                            {{ __('Użytkownicy') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.appointments')" :active="request()->routeIs('admin.appointments*')">
                            {{ __('Wszystkie Wizyty') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.pets')" :active="request()->routeIs('admin.pets*')">
                            {{ __('Baza Zwierząt') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button aria-haspopup="true" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 bg-white hover:text-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition ease-in-out duration-150">
                            <span class="flex items-center gap-2">
                                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase" aria-hidden="true">
                                    {{ Auth::user()->role->name }}
                                </span>
                                <span>{{ Auth::user()->name }}</span>
                            </span>

                            <span class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Konto') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Wyloguj się') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        aria-expanded="false" 
                        :aria-expanded="open.toString()"
                        aria-label="Otwórz menu nawigacji"
                        class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role->name === 'klient')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pets.index')" :active="request()->routeIs('pets.*')">
                    {{ __('Moje Zwierzęta') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role->name === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Panel Admina') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                    {{ __('Użytkownicy') }}
                </x-responsive-nav-link>
            @endif
        </div>
        ...
    </div>
</nav>