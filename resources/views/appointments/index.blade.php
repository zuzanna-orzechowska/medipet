<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
            {{ __('Moje Wizyty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm font-medium" role="alert" aria-live="polite">
                    <span aria-hidden="true">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                    <div>
                        <h3 id="appointments-list-title" class="text-3xl font-black text-emerald-950">Zaplanowane wizyty</h3>
                        <p class="text-slate-600 mt-2">Zarządzaj terminami badań Twoich pupili w klinice MediPet.</p>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white rounded-2xl font-black shadow-xl shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-1 transition-all focus:ring-4 focus:ring-emerald-100 outline-none">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Umów nową wizytę
                    </a>
                </div>

                @if($appointments->isEmpty())
                    <div class="text-center py-16 bg-slate-50/50 rounded-[2rem] border-2 border-dashed border-slate-200">
                        <span class="text-5xl mb-4 block" aria-hidden="true">🗓️</span>
                        <p class="text-slate-500 font-medium italic text-lg">Brak nadchodzących wizyt w systemie MediPet.</p>
                        <a href="{{ route('appointments.create') }}" class="mt-4 inline-block text-emerald-600 font-bold hover:underline">Zaplanuj pierwszą wizytę już teraz</a>
                    </div>
                @else
                    <div class="grid gap-6" role="list" aria-labelledby="appointments-list-title">
                        @foreach($appointments as $appointment)
                            <article class="flex flex-col lg:flex-row lg:items-center justify-between p-8 bg-white border border-emerald-100 rounded-3xl hover:shadow-lg transition-all duration-300 gap-6 group" role="listitem">
                                <div class="flex items-start sm:items-center gap-6">
                                    <div class="hidden sm:flex p-4 bg-emerald-50 rounded-2xl text-3xl group-hover:scale-110 transition-transform" aria-hidden="true">
                                        🗓️
                                    </div>
                                    <div>
                                        <time datetime="{{ \Carbon\Carbon::parse($appointment->appointment_date)->toIso8601String() }}" class="font-black text-emerald-950 text-xl block mb-1">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y — H:i') }}
                                        </time>
                                        <p class="text-sm text-emerald-600 font-black uppercase tracking-widest">
                                            {{ $appointment->service->name }} — <span class="text-slate-900">{{ $appointment->pet->name }}</span>
                                        </p>
                                        @if($appointment->notes)
                                            <p class="text-sm text-slate-400 mt-2 italic flex items-center gap-2">
                                                <span class="font-bold not-italic">Notatka:</span> {{ Str::limit($appointment->notes, 80) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center justify-between lg:justify-end gap-6 border-t lg:border-t-0 pt-4 lg:pt-0">
                                    <span class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm
                                        {{ in_array($appointment->status, ['oczekująca', 'scheduled']) ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $appointment->status == 'zatwierdzona' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ in_array($appointment->status, ['zakończona', 'completed']) ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ in_array($appointment->status, ['odwołana', 'cancelled']) ? 'bg-rose-100 text-rose-800' : '' }}">
                                        {{ $appointment->status }}
                                    </span>

                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('appointments.show', $appointment) }}" 
                                           class="text-emerald-700 hover:text-emerald-900 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-emerald-500 rounded p-1 outline-none transition-colors"
                                           aria-label="Szczegóły wizyty {{ $appointment->pet->name }} z dnia {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y') }}">
                                            Szczegóły
                                        </a>

                                        @if(in_array($appointment->status, ['oczekująca', 'scheduled']))
                                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz odwołać tę wizytę?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-rose-600 hover:text-rose-800 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-rose-500 rounded p-1 outline-none transition-colors"
                                                        aria-label="Odwołaj wizytę {{ $appointment->pet->name }} z dnia {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y') }}">
                                                    Odwołaj
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>