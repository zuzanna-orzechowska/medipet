<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
            {{ __('Centrum Dowodzenia MediPet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" aria-label="Statystyki ogólne systemu">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-emerald-100 flex items-center justify-between group hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Użytkownicy</p>
                        <p class="text-4xl font-black text-emerald-700 mt-1">{{ $stats['users'] }}</p>
                    </div>
                    <span class="text-5xl group-hover:scale-110 transition-transform" aria-hidden="true">👥</span>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-emerald-100 flex items-center justify-between group hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Zwierzęta</p>
                        <p class="text-4xl font-black text-emerald-700 mt-1">{{ $stats['pets'] }}</p>
                    </div>
                    <span class="text-5xl group-hover:scale-110 transition-transform" aria-hidden="true">🐶</span>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-emerald-100 flex items-center justify-between group hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Wszystkie Wizyty</p>
                        <p class="text-4xl font-black text-emerald-700 mt-1">{{ $stats['appointments'] }}</p>
                    </div>
                    <span class="text-5xl group-hover:scale-110 transition-transform" aria-hidden="true">📅</span>
                </div>
            </section>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12 mb-8">
                <header class="mb-6">
                    <h3 class="text-xl font-bold text-emerald-950 flex items-center gap-2">
                        <span aria-hidden="true">🔍</span> Szybka lokalizacja danych
                    </h3>
                    <p class="text-sm text-slate-500">Przeszukaj bazę pacjentów i personelu bez przechodzenia do szczegółowych list.</p>
                </header>

                <form action="{{ route('admin.dashboard') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Wpisz imię zwierzaka, nazwisko lekarza lub adres e-mail..."
                           class="w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-2xl py-5 px-8 shadow-sm transition-all text-lg"
                           aria-label="Wyszukiwarka użytkowników i zwierząt">
                    <button type="submit" class="absolute right-4 top-4 bg-emerald-600 text-white px-8 py-3 rounded-xl font-black shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition-all focus:ring-4 focus:ring-emerald-100 outline-none">
                        Szukaj
                    </button>
                </form>

                @if(request('search'))
                    <div class="mt-10 space-y-8 animate-in fade-in slide-in-from-top-4 duration-500">
                        @if($searchResults['users']->isNotEmpty())
                            <section>
                                <h4 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-4">Dopasowani Użytkownicy</h4>
                                <div class="grid gap-4">
                                    @foreach($searchResults['users'] as $user)
                                        <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-200 transition-colors group">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 font-bold" aria-hidden="true">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-900 leading-none">{{ $user->name }}</p>
                                                    <p class="text-xs text-slate-500 mt-1">{{ $user->email }} — <span class="text-emerald-600 font-black uppercase text-[10px]">{{ $user->role->name }}</span></p>
                                                </div>
                                            </div>
                                            <a href="{{ route('admin.users') }}?search={{ $user->email }}" class="px-4 py-2 text-xs font-black text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                                                Zarządzaj &rarr;
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if($searchResults['pets']->isNotEmpty())
                            <section>
                                <h4 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-4">Dopasowani Pacjenci</h4>
                                <div class="grid gap-4">
                                    @foreach($searchResults['pets'] as $pet)
                                        <div class="flex items-center justify-between p-5 bg-emerald-50/30 rounded-2xl border border-emerald-100 hover:bg-emerald-50 transition-colors">
                                            <div class="flex items-center gap-4">
                                                <span class="text-2xl" aria-hidden="true">🐾</span>
                                                <div>
                                                    <p class="font-bold text-emerald-950 leading-none">{{ $pet->name }}</p>
                                                    <p class="text-xs text-emerald-700 mt-1 font-medium">{{ $pet->species }} ({{ $pet->breed ?? 'Mieszaniec' }})</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('admin.pets.edit', $pet) }}" class="px-4 py-2 text-xs font-black text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                                                Edytuj dane &rarr;
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if($searchResults['users']->isEmpty() && $searchResults['pets']->isEmpty())
                            <div class="text-center py-10 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <p class="text-slate-500 italic">Brak wyników dla frazy: <span class="font-bold text-emerald-700">"{{ request('search') }}"</span></p>
                            </div>
                        @endif
                        
                        <div class="text-center pt-4">
                            <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-widest">Wyczyść wyniki</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12">
                <h3 id="mgmt-heading" class="text-xl font-bold text-emerald-950 mb-8">Narzędzia Administracyjne</h3>
                
                <nav class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" aria-labelledby="mgmt-heading">
                    <a href="{{ route('admin.users') }}" 
                       class="p-6 border border-emerald-50 rounded-3xl hover:bg-emerald-50 hover:border-emerald-200 transition-all group flex flex-col gap-4 focus:ring-4 focus:ring-emerald-100 outline-none">
                        <div class="bg-emerald-100 w-12 h-12 rounded-2xl flex items-center justify-center text-emerald-700 font-black text-xl group-hover:scale-110 transition-transform">U</div>
                        <div>
                            <p class="font-black text-emerald-950">Baza Użytkowników</p>
                            <p class="text-sm text-slate-500 mt-1 leading-relaxed">Zarządzaj kontami klientów i personelu. Kontroluj uprawnienia i dostęp do systemu.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.appointments') }}" 
                       class="p-6 border border-emerald-50 rounded-3xl hover:bg-emerald-50 hover:border-emerald-200 transition-all group flex flex-col gap-4 focus:ring-4 focus:ring-emerald-100 outline-none">
                        <div class="bg-emerald-100 w-12 h-12 rounded-2xl flex items-center justify-center text-emerald-700 font-black text-xl group-hover:scale-110 transition-transform">W</div>
                        <div>
                            <p class="font-black text-emerald-950">Harmonogram Wizyt</p>
                            <p class="text-sm text-slate-500 mt-1 leading-relaxed">Globalny podgląd wszystkich zapisów. Możliwość ręcznej korekty terminów i statusów.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.pets') }}" 
                       class="p-6 border border-emerald-50 rounded-3xl hover:bg-emerald-50 hover:border-emerald-200 transition-all group flex flex-col gap-4 focus:ring-4 focus:ring-emerald-100 outline-none md:col-span-2 lg:col-span-1">
                        <div class="bg-emerald-100 w-12 h-12 rounded-2xl flex items-center justify-center text-emerald-700 font-black text-xl group-hover:scale-110 transition-transform">Z</div>
                        <div>
                            <p class="font-black text-emerald-950">Katalog Pacjentów</p>
                            <p class="text-sm text-slate-500 mt-1 leading-relaxed">Centralny spis zwierząt. Edycja metryk, ras oraz przypisywanie właścicieli.</p>
                        </div>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</x-app-layout>