<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
            {{ __('Panel Klienta MediPet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-emerald-100">
                <div class="p-8">
                    <header class="mb-8">
                        <h3 class="text-3xl font-black text-emerald-950 mb-2">
                            Witaj, {{ Auth::user()->name }}! <span aria-hidden="true">👋</span>
                        </h3>
                        <p class="text-slate-600 text-lg">Z poziomu tego panelu możesz zarządzać swoimi pupilami oraz umawiać wizyty w naszej klinice.</p>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <section aria-labelledby="pets-card-title" class="p-8 bg-emerald-50/50 rounded-[2rem] border border-emerald-100 hover:shadow-lg transition-all duration-300 group">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <span class="text-2xl" aria-hidden="true">🐾</span>
                                </div>
                                <h4 id="pets-card-title" class="text-xl font-bold text-emerald-950">Twoje Zwierzęta</h4>
                            </div>
                            
                            <p class="text-slate-600 mb-6">
                                Masz zarejestrowanych <strong class="text-emerald-700">{{ Auth::user()->pets->count() }}</strong> zwierząt. 
                                Dbaj o ich zdrowie, trzymając wszystkie dane w jednym miejscu.
                            </p>
                            
                            <a href="{{ route('pets.index') }}" 
                               class="inline-flex items-center font-black text-emerald-600 hover:text-emerald-800 transition-colors focus:ring-2 focus:ring-emerald-500 rounded-lg p-1 outline-none">
                                Zarządzaj zwierzakami <span class="ml-2" aria-hidden="true">&rarr;</span>
                            </a>
                        </section>

                        <section aria-labelledby="appointments-card-title" class="p-8 bg-white rounded-[2rem] border border-emerald-100 shadow-sm hover:shadow-lg transition-all duration-300 group">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <span class="text-2xl" aria-hidden="true">🗓️</span>
                                </div>
                                <h4 id="appointments-card-title" class="text-xl font-bold text-emerald-950">Wizyty i Terminy</h4>
                            </div>
                            
                            @php
                                $appointmentsCount = \App\Models\Appointment::where('client_id', Auth::id())->count();
                            @endphp

                            <p class="text-slate-600 mb-6">
                                @if($appointmentsCount > 0)
                                    Masz zaplanowane <strong class="text-emerald-700">{{ $appointmentsCount }}</strong> wizyty w naszym rejestrze.
                                @else
                                    Nie masz jeszcze umówionych żadnych wizyt. Chętnie pomożemy Twojemu pupilowi!
                                @endif
                            </p>

                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <a href="{{ route('appointments.create') }}" 
                                   class="w-full sm:w-auto text-center bg-emerald-600 text-white px-6 py-3 rounded-xl font-black shadow-md hover:bg-emerald-700 transition-all focus:ring-4 focus:ring-emerald-100 outline-none">
                                    + Umów nową wizytę
                                </a>
                                <a href="{{ route('appointments.index') }}" 
                                   class="w-full sm:w-auto text-center font-bold text-slate-500 hover:text-emerald-700 transition-colors p-2 focus:ring-2 focus:ring-emerald-500 rounded-lg outline-none">
                                    Zobacz historię
                                </a>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>