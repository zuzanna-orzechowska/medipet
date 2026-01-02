<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
                {{ __('Wizyty w MediPet') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-2 transition focus:ring-2 focus:ring-emerald-500 rounded-lg p-1" aria-label="Powrót do panelu administratora">
                <span>&larr;</span> {{ __('Powrót do panelu') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div role="alert" aria-live="polite" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm font-medium">
                    <span class="text-xl" aria-hidden="true">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-2xl border border-emerald-100 overflow-hidden">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 id="table-title" class="text-lg font-bold text-emerald-900">Pełny rejestr kliniki</h3>
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black italic">Tryb Nadzorcy</p>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" aria-labelledby="table-title">
                            <thead>
                                <tr class="bg-slate-50 text-emerald-900 uppercase text-[10px] font-black tracking-wider border-b border-emerald-100">
                                    <th scope="col" class="p-4">Data wizyty</th>
                                    <th scope="col" class="p-4">Pacjent i Właściciel</th>
                                    <th scope="col" class="p-4">Lekarz i Usługa</th>
                                    <th scope="col" class="p-4 text-center">Status (Zmień)</th>
                                    <th scope="col" class="p-4 text-right">Akcje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-emerald-50">
                                @foreach($appointments as $app)
                                <tr class="hover:bg-emerald-50/20 transition duration-150">
                                    <td class="p-4">
                                        <time datetime="{{ \Carbon\Carbon::parse($app->appointment_date)->toIso8601String() }}" class="font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($app->appointment_date)->format('d.m.Y') }}
                                        </time>
                                        <span class="block text-xs text-emerald-600 font-black">{{ \Carbon\Carbon::parse($app->appointment_date)->format('H:i') }}</span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900">{{ $app->pet->name }}</span>
                                            <span class="text-xs text-slate-500">{{ $app->client->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <p class="text-sm font-semibold text-slate-700">lek. wet. {{ $app->doctor->name }}</p>
                                        <p class="text-xs italic text-slate-500">{{ $app->service->name }}</p>
                                    </td>
                                    
                                    <td class="p-4 text-center">
                                        <form action="{{ route('admin.appointments.updateStatus', $app) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <label for="status-{{ $app->id }}" class="sr-only">Zmień status wizyty dla {{ $app->pet->name }}</label>
                                            <select id="status-{{ $app->id }}" name="status" onchange="this.form.submit()" 
                                                class="text-[10px] font-black uppercase tracking-widest rounded-full px-4 py-1.5 border-none focus:ring-4 focus:ring-emerald-100 cursor-pointer shadow-sm transition-all
                                                {{ in_array($app->status, ['oczekująca', 'scheduled', 'pending']) ? 'bg-amber-100 text-amber-800' : '' }}
                                                {{ in_array($app->status, ['zatwierdzona', 'confirmed']) ? 'bg-emerald-100 text-emerald-800' : '' }}
                                                {{ in_array($app->status, ['zakończona', 'completed']) ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ in_array($app->status, ['odwołana', 'cancelled', 'rejected']) ? 'bg-rose-100 text-rose-800' : '' }}">
                                                
                                                <option value="oczekująca" {{ $app->status == 'oczekująca' ? 'selected' : '' }}>Oczekująca</option>
                                                <option value="zatwierdzona" {{ $app->status == 'zatwierdzona' ? 'selected' : '' }}>Zatwierdzona</option>
                                                <option value="zakończona" {{ $app->status == 'zakończona' ? 'selected' : '' }}>Zakończona</option>
                                                <option value="odwołana" {{ $app->status == 'odwołana' ? 'selected' : '' }}>Odwołana</option>
                                            </select>
                                        </form>
                                    </td>

                                    <td class="p-4 text-right">
                                        <form action="{{ route('admin.appointments.destroy', $app) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz trwale usunąć tę wizytę z bazy?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                class="text-red-600 hover:text-red-800 font-black text-[10px] uppercase tracking-tighter transition-colors focus:ring-2 focus:ring-red-500 rounded p-1"
                                                aria-label="Usuń wizytę pacjenta {{ $app->pet->name }} z dnia {{ $app->appointment_date }}">
                                                Usuń wpis
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($appointments->isEmpty())
                        <div class="text-center py-12 text-slate-400 italic" role="status">
                            Brak wizyt zarejestrowanych w systemie.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>