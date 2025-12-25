<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
            {{ __('Moje Wizyty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-xl" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-emerald-100 p-8">
                
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900">Zaplanowane wizyty</h3>
                        <p class="text-slate-500">Zarządzaj terminami badań Twoich pupili.</p>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Umów nową wizytę
                    </a>
                </div>

                @if($appointments->isEmpty())
                    <div class="text-center py-12 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                        <p class="text-slate-500 italic">Brak nadchodzących wizyt w systemie MediPet.</p>
                    </div>
                @else
                    <div class="grid gap-4">
                        @foreach($appointments as $appointment)
                            <div class="flex flex-col md:flex-row md:items-center justify-between p-6 bg-white border border-emerald-100 rounded-2xl hover:shadow-md transition gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="p-3 bg-emerald-50 rounded-lg text-2xl" aria-hidden="true">🗓️</div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-lg">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y — H:i') }}
                                        </p>
                                        <p class="text-sm text-emerald-600 font-semibold uppercase tracking-wide">
                                            {{ $appointment->service->name }} — {{ $appointment->pet->name }}
                                        </p>
                                        @if($appointment->notes)
                                            <p class="text-xs text-slate-400 mt-1 italic">Notatka: {{ Str::limit($appointment->notes, 60) }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center justify-between md:justify-end gap-6">
                                    <span class="px-4 py-1 rounded-full text-xs font-bold uppercase 
                                        {{ $appointment->status == 'oczekująca' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $appointment->status == 'zatwierdzona' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $appointment->status == 'zakończona' ? 'bg-slate-100 text-slate-600' : '' }}
                                        {{ $appointment->status == 'odwołana' ? 'bg-rose-100 text-rose-700' : '' }}">
                                        {{ $appointment->status }}
                                    </span>

                                    @if($appointment->status == 'oczekująca')
                                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz odwołać tę wizytę w MediPet?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-sm transition-colors border-b border-transparent hover:border-rose-800">
                                                Odwołaj wizytę
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>