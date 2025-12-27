<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                {{ __('Wszystkie Wizyty w MediPet') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600 hover:underline flex items-center gap-1">
                &larr; {{ __('Powrót do panelu') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 shadow-sm">
                    <span class="text-xl">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-2xl border border-indigo-100 overflow-hidden">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-slate-800">Pełny rejestr kliniki</h3>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold italic">Tryb Nadzorcy</p>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-indigo-50/50 text-indigo-900 uppercase text-[10px] font-black tracking-wider">
                                    <th class="p-4 border-b">Data wizyty</th>
                                    <th class="p-4 border-b">Pacjent i Właściciel</th>
                                    <th class="p-4 border-b">Lekarz</th>
                                    <th class="p-4 border-b">Usługa</th>
                                    <th class="p-4 border-b text-center">Status (Zmień)</th>
                                    <th class="p-4 border-b text-right">Akcje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($appointments as $app)
                                <tr class="hover:bg-indigo-50/20 transition duration-150">
                                    <td class="p-4 font-bold text-slate-700">
                                        {{ \Carbon\Carbon::parse($app->appointment_date)->format('d.m.Y H:i') }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-indigo-700">{{ $app->pet->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $app->client->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm font-medium text-slate-600">
                                        lek. wet. {{ $app->doctor->name }}
                                    </td>
                                    <td class="p-4 text-sm italic text-gray-600">
                                        {{ $app->service->name }}
                                    </td>
                                    
                                    <td class="p-4 text-center">
                                        <form action="{{ route('admin.appointments.updateStatus', $app) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" 
                                                class="text-[10px] font-black uppercase tracking-widest rounded-full px-3 py-1 border-none focus:ring-2 focus:ring-indigo-500 cursor-pointer shadow-sm
                                                {{ in_array($app->status, ['oczekująca', 'scheduled', 'pending']) ? 'bg-amber-100 text-amber-700' : '' }}
                                                {{ in_array($app->status, ['zatwierdzona', 'confirmed']) ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                {{ in_array($app->status, ['zakończona', 'completed']) ? 'bg-blue-100 text-blue-700' : '' }}
                                                {{ in_array($app->status, ['odwołana', 'cancelled', 'rejected']) ? 'bg-rose-100 text-rose-700' : '' }}">
                                                
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
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-[10px] uppercase tracking-tighter transition-colors">
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
                        <div class="text-center py-12 text-gray-400 italic">
                            Brak wizyt zarejestrowanych w systemie.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>