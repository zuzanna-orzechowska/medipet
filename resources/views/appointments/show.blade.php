<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
                {{ __('Szczegóły wizyty') }}
            </h2>
            <a href="{{ route('appointments.index') }}" 
               class="text-sm font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-2 transition focus:ring-2 focus:ring-emerald-500 rounded-lg p-1 outline-none"
               aria-label="Powrót do listy Twoich wizyt">
                <span>&larr;</span> {{ __('Powrót do listy') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12">
                
                <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-10 pb-8 border-b border-emerald-50 gap-6">
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Data i godzina wizyty</p>
                        <time datetime="{{ \Carbon\Carbon::parse($appointment->appointment_date)->toIso8601String() }}" 
                              class="text-3xl font-black text-emerald-950">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y — H:i') }}
                        </time>
                    </div>
                    <div class="text-right">
                        <span class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm
                            {{ $appointment->status == 'oczekująca' ? 'bg-amber-100 text-amber-800' : '' }}
                            {{ $appointment->status == 'zatwierdzona' ? 'bg-emerald-100 text-emerald-800' : '' }}
                            {{ $appointment->status == 'odwołana' ? 'bg-rose-100 text-rose-800' : '' }}
                            {{ $appointment->status == 'zakończona' ? 'bg-blue-100 text-blue-800' : '' }}">
                            {{ $appointment->status }}
                        </span>
                    </div>
                </header>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    <section class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-2xl shadow-sm" aria-hidden="true">🐾</div>
                        <div>
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Pacjent</h3>
                            <p class="font-bold text-xl text-emerald-950">{{ $appointment->pet->name }}</p>
                            <p class="text-sm text-slate-500 font-medium">{{ $appointment->pet->species }} ({{ $appointment->pet->breed ?? 'Mieszaniec' }})</p>
                        </div>
                    </section>

                    <section class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-2xl shadow-sm" aria-hidden="true">👨‍⚕️</div>
                        <div>
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Lekarz prowadzący</h3>
                            <p class="font-bold text-xl text-emerald-950">lek. wet. {{ $appointment->doctor->name }}</p>
                            <p class="text-sm text-slate-500 font-medium italic">Specjalista MediPet</p>
                        </div>
                    </section>

                    <section class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-2xl shadow-sm" aria-hidden="true">💉</div>
                        <div>
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Rodzaj usługi</h3>
                            <p class="font-bold text-xl text-emerald-950">{{ $appointment->service->name }}</p>
                            <p class="text-sm font-black text-emerald-600 tracking-tighter">{{ number_format($appointment->service->price, 2) }} zł</p>
                        </div>
                    </section>

                    <section class="col-span-full bg-slate-50/80 p-8 rounded-[2rem] border border-slate-100">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Opis / Twoje uwagi do wizyty</h3>
                        <p class="text-slate-700 leading-relaxed font-medium italic">
                            {{ $appointment->notes ?: 'Brak dodatkowych uwag do tej wizyty.' }}
                        </p>
                    </section>
                </div>

                @if(in_array($appointment->status, ['oczekująca', 'scheduled']))
                    <footer class="mt-12 pt-8 border-t border-emerald-50">
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" 
                              onsubmit="return confirm('Czy na pewno chcesz odwołać tę wizytę w MediPet?')">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="w-full sm:w-auto px-8 py-4 text-rose-600 font-black text-sm uppercase tracking-widest hover:bg-rose-50 rounded-2xl transition-all focus:ring-4 focus:ring-rose-100 outline-none">
                                Odwołaj tę wizytę
                            </button>
                        </form>
                    </footer>
                @endif
            </article>
        </div>
    </div>
</x-app-layout>