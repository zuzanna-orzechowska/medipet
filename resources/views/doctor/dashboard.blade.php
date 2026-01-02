<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
            {{ __('Panel Lekarski MediPet — Twoje Wizyty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div role="alert" aria-live="polite" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm font-medium">
                    <span class="text-xl" aria-hidden="true">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12">
                
                <header class="mb-8">
                    <h3 id="schedule-title" class="text-3xl font-black text-emerald-950">Harmonogram pacjentów</h3>
                    <p class="text-slate-600 mt-2">Zarządzaj statusem nadchodzących wizyt i obsługuj zgłoszenia klientów kliniki.</p>
                </header>

                @if($appointments->isEmpty())
                    <div class="text-center py-16 bg-emerald-50/30 rounded-[2rem] border-2 border-dashed border-emerald-200">
                        <span class="text-5xl mb-4 block" aria-hidden="true">☕</span>
                        <p class="text-emerald-800 font-bold text-lg">Brak przypisanych wizyt na najbliższy czas.</p>
                        <p class="text-emerald-600 text-sm mt-1">Chwila przerwy? Twój harmonogram jest obecnie pusty.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-3xl border border-emerald-50 shadow-sm">
                        <table class="w-full text-left border-collapse" aria-labelledby="schedule-title">
                            <thead>
                                <tr class="bg-slate-50 border-b border-emerald-100">
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Termin</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Pacjent</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Właściciel</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Usługa</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest text-center">Status</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest text-right">Zarządzaj</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-emerald-50">
                                @foreach($appointments as $app)
                                <tr class="hover:bg-emerald-50/30 transition-colors group">
                                    <td class="p-6">
                                        <time datetime="{{ \Carbon\Carbon::parse($app->appointment_date)->toIso8601String() }}" class="font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($app->appointment_date)->format('d.m.Y') }}
                                        </time>
                                        <span class="block text-xs text-emerald-600 font-black">{{ \Carbon\Carbon::parse($app->appointment_date)->format('H:i') }}</span>
                                    </td>
                                    <td class="p-6">
                                        <span class="block font-black text-emerald-900 leading-none">{{ $app->pet->name }}</span>
                                        <span class="text-[10px] text-emerald-500 uppercase font-black tracking-widest mt-1 block">{{ $app->pet->species }}</span>
                                    </td>
                                    <td class="p-6">
                                        <span class="text-sm font-semibold text-slate-700">{{ $app->client->name }}</span>
                                    </td>
                                    <td class="p-6">
                                        <span class="text-sm text-slate-600 italic font-medium">{{ $app->service->name }}</span>
                                    </td>
                                    <td class="p-6 text-center">
                                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest inline-block shadow-sm
                                            {{ in_array($app->status, ['pending', 'oczekująca', 'scheduled']) ? 'bg-amber-100 text-amber-800' : '' }}
                                            {{ $app->status == 'zatwierdzona' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                            {{ $app->status == 'odwołana' ? 'bg-rose-100 text-rose-800' : '' }}
                                            {{ $app->status == 'zakończona' ? 'bg-blue-100 text-blue-800' : '' }}">
                                            {{ $app->status }}
                                        </span>
                                    </td>
                                    <td class="p-6 text-right">
                                        <div class="flex justify-end gap-3 items-center">
                                            @if(in_array($app->status, ['pending', 'oczekująca', 'scheduled']))
                                                <form action="{{ route('doctor.appointments.status', $app) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="zatwierdzona">
                                                    <button type="submit" 
                                                            class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 outline-none focus:ring-4 focus:ring-emerald-100"
                                                            aria-label="Zatwierdź wizytę pacjenta {{ $app->pet->name }}">
                                                        Zatwierdź
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('doctor.appointments.status', $app) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="odwołana">
                                                    <button type="submit" 
                                                            class="text-rose-600 hover:text-rose-800 font-black text-[10px] uppercase tracking-widest p-2 outline-none focus:ring-2 focus:ring-rose-500 rounded-lg transition-colors"
                                                            aria-label="Odrzuć wizytę pacjenta {{ $app->pet->name }}">
                                                        Odrzuć
                                                    </button>
                                                </form>
                                            @elseif($app->status == 'zatwierdzona')
                                                <form action="{{ route('doctor.appointments.status', $app) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="zakończona">
                                                    <button type="submit" 
                                                            class="bg-blue-600 text-white px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-100 outline-none focus:ring-4 focus:ring-blue-100"
                                                            aria-label="Zakończ wizytę pacjenta {{ $app->pet->name }}">
                                                        Zakończ wizytę
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-[10px] font-black text-slate-300 uppercase italic">Brak akcji</span>
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