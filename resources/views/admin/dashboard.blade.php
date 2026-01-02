<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight">
            {{ __('Centrum Dowodzenia MediPet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" aria-label="Statystyki ogólne systemu">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Użytkownicy</p>
                        <p class="text-3xl font-black text-emerald-700">{{ $stats['users'] }}</p>
                    </div>
                    <span class="text-4xl" aria-hidden="true">👥</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Zwierzęta</p>
                        <p class="text-3xl font-black text-emerald-700">{{ $stats['pets'] }}</p>
                    </div>
                    <span class="text-4xl" aria-hidden="true">🐶</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Wszystkie Wizyty</p>
                        <p class="text-3xl font-black text-emerald-700">{{ $stats['appointments'] }}</p>
                    </div>
                    <span class="text-4xl" aria-hidden="true">📅</span>
                </div>
            </section>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-emerald-100 p-8">
                <h3 id="mgmt-heading" class="text-xl font-bold text-emerald-950 mb-6">Zarządzanie systemem</h3>
                
                <nav class="grid grid-cols-1 md:grid-cols-2 gap-4" aria-labelledby="mgmt-heading">
                    <a href="{{ route('admin.users') }}" 
                       class="p-5 border border-emerald-50 rounded-xl hover:bg-emerald-50 hover:border-emerald-200 transition-all group flex items-center gap-4 focus:ring-4 focus:ring-emerald-100 outline-none">
                        <div class="bg-emerald-100 p-3 rounded-lg text-emerald-700 font-black group-hover:scale-110 transition-transform">U</div>
                        <div>
                            <p class="font-bold text-slate-900">Zarządzaj Użytkownikami</p>
                            <p class="text-sm text-slate-500">Usuwanie kont, wgląd w role lekarzy i klientów.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.appointments') }}" 
                       class="p-5 border border-emerald-50 rounded-xl hover:bg-emerald-50 hover:border-emerald-200 transition-all group flex items-center gap-4 focus:ring-4 focus:ring-emerald-100 outline-none">
                        <div class="bg-emerald-100 p-3 rounded-lg text-emerald-700 font-black group-hover:scale-110 transition-transform">W</div>
                        <div>
                            <p class="font-bold text-slate-900">Monitoruj Wizyty</p>
                            <p class="text-sm text-slate-500">Pełna historia wszystkich zapisów w klinice.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.pets') }}" 
                       class="p-5 border border-emerald-50 rounded-xl hover:bg-emerald-50 hover:border-emerald-200 transition-all group flex items-center gap-4 focus:ring-4 focus:ring-emerald-100 outline-none">
                        <div class="bg-emerald-100 p-3 rounded-lg text-emerald-700 font-black group-hover:scale-110 transition-transform">Z</div>
                        <div>
                            <p class="font-bold text-slate-900">Zarządzaj Zwierzętami</p>
                            <p class="text-sm text-slate-500">Edytuj dane pacjentów i przypisuj ich do właścicieli.</p>
                        </div>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</x-app-layout>