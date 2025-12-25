<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                {{ __('Szczegóły wizyty #') }}{{ $appointment->id }}
            </h2>
            <a href="{{ route('appointments.index') }}" class="text-sm text-emerald-600 hover:underline">
                &larr; Powrót do listy
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-emerald-100">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Data i godzina</p>
                            <p class="text-2xl font-black text-slate-800">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y H:i') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest
                                {{ $appointment->status == 'oczekująca' ? 'bg-amber-100 text-amber-700' : '' }}
                                {{ $appointment->status == 'zatwierdzona' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                {{ $appointment->status == 'odwołana' ? 'bg-rose-100 text-rose-700' : '' }}
                                {{ $appointment->status == 'zakończona' ? 'bg-blue-100 text-blue-700' : '' }}">
                                {{ $appointment->status }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-start gap-4">
                            <div class="text-3xl">🐾</div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Pacjent</p>
                                <p class="font-bold text-lg text-slate-900">{{ $appointment->pet->name }}</p>
                                <p class="text-sm text-gray-500">{{ $appointment->pet->species }} ({{ $appointment->pet->breed }})</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="text-3xl">👨‍⚕️</div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Lekarz prowadzący</p>
                                <p class="font-bold text-lg text-slate-900">lek. wet. {{ $appointment->doctor->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="text-3xl">💉</div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Rodzaj usługi</p>
                                <p class="font-bold text-lg text-slate-900">{{ $appointment->service->name }}</p>
                            </div>
                        </div>

                        <div class="col-span-full bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Opis / Uwagi klienta</p>
                            <p class="text-slate-700 leading-relaxed">
                                {{ $appointment->notes ?: 'Brak dodatkowych uwag do tej wizyty.' }}
                            </p>
                        </div>
                    </div>

                    @if($appointment->status == 'oczekująca')
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz odwołać tę wizytę?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-600 font-bold text-sm hover:text-rose-800 transition">
                                    Odwołaj wizytę &rarr;
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>