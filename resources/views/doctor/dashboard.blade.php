<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Panel Lekarski MediPet — Twoje Wizyty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl font-bold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-blue-100 p-8">
                
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900">Harmonogram pacjentów</h3>
                        <p class="text-slate-500 text-sm">Zarządzaj statusem nadchodzących wizyt i obsługuj zgłoszenia klientów.</p>
                    </div>
                    
                </div>

                @if($appointments->isEmpty())
                    <div class="text-center py-16 bg-blue-50/50 rounded-2xl border-2 border-dashed border-blue-200">
                        <p class="text-blue-400 font-medium italic text-lg">Brak przypisanych wizyt na najbliższy czas.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-xl shadow-sm border border-slate-100">
                        <table class="w-full text-left border-collapse" aria-label="Lista pacjentów do obsłużenia">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="p-4 font-bold text-blue-900 border-b">Termin</th>
                                    <th class="p-4 font-bold text-blue-900 border-b">Pacjent</th>
                                    <th class="p-4 font-bold text-blue-900 border-b">Właściciel</th>
                                    <th class="p-4 font-bold text-blue-900 border-b">Usługa</th>
                                    <th class="p-4 font-bold text-blue-900 border-b text-center">Status</th>
                                    <th class="p-4 font-bold text-blue-900 border-b text-right">Zarządzaj</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($appointments as $app)
                                <tr class="hover:bg-blue-50/30 transition">
                                    <td class="p-4 font-medium text-slate-900">
                                        {{ \Carbon\Carbon::parse($app->appointment_date)->format('d.m.Y H:i') }}
                                    </td>
                                    <td class="p-4">
                                        <span class="block font-bold text-blue-700 leading-none">{{ $app->pet->name }}</span>
                                        <span class="text-[10px] text-slate-500 uppercase font-bold tracking-tight">{{ $app->pet->species }}</span>
                                    </td>
                                    <td class="p-4 text-slate-600 text-sm">{{ $app->client->name }}</td>
                                    <td class="p-4 text-slate-600 text-sm font-semibold">{{ $app->service->name }}</td>
                                    <td class="p-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest inline-block
                                            {{ in_array($app->status, ['pending', 'oczekująca', 'scheduled']) ? 'bg-amber-100 text-amber-700' : '' }}
                                            {{ $app->status == 'zatwierdzona' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                            {{ $app->status == 'odwołana' ? 'bg-rose-100 text-rose-700' : '' }}
                                            {{ $app->status == 'zakończona' ? 'bg-blue-100 text-blue-700' : '' }}">
                                            {{ $app->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            {{-- Akcje dla nowych wizyt --}}
                                            @if(in_array($app->status, ['pending', 'oczekująca', 'scheduled']))
                                                <form action="{{ route('doctor.appointments.status', $app) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="zatwierdzona">
                                                    <button type="submit" class="bg-emerald-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-emerald-700 transition shadow-sm shadow-emerald-100">
                                                        Zatwierdź
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('doctor.appointments.status', $app) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="odwołana">
                                                    <button type="submit" class="border border-rose-200 text-rose-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-rose-50 transition">
                                                        Odrzuć
                                                    </button>
                                                </form>
                                            {{-- Akcja dla zatwierdzonych --}}
                                            @elseif($app->status == 'zatwierdzona')
                                                <form action="{{ route('doctor.appointments.status', $app) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="zakończona">
                                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-700 transition shadow-sm shadow-blue-100">
                                                        Zakończ wizytę
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>