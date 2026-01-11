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
            
            <div class="mb-8 bg-white p-6 rounded-[2rem] shadow-sm border border-emerald-100 space-y-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <form action="{{ route('admin.appointments') }}" method="GET" class="w-full md:w-1/3 relative flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Szukaj pacjenta lub właściciela..." 
                               class="w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-2xl py-3 pl-6 pr-14 transition-all text-sm">
                        <button type="submit" class="absolute right-2 bg-emerald-600 text-white w-10 h-10 flex items-center justify-center rounded-xl hover:bg-emerald-700 transition shadow-sm shadow-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>

                    <div class="flex gap-2 p-1.5 bg-slate-50 rounded-2xl border border-slate-100">
                        <a href="{{ route('admin.appointments', array_merge(request()->query(), ['sort' => 'desc'])) }}" 
                           class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ request('sort', 'desc') == 'desc' ? 'bg-white shadow-sm text-emerald-700' : 'text-slate-500 hover:text-emerald-600' }}">
                            Najnowsze
                        </a>
                        <a href="{{ route('admin.appointments', array_merge(request()->query(), ['sort' => 'asc'])) }}" 
                           class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ request('sort') == 'asc' ? 'bg-white shadow-sm text-emerald-700' : 'text-slate-500 hover:text-emerald-600' }}">
                            Najstarsze
                        </a>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 border-t border-emerald-50 pt-4">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Filtruj lekarza:</span>
                    <a href="{{ route('admin.appointments', array_merge(request()->query(), ['doctor' => ''])) }}" 
                       class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase transition-all {{ !request('doctor') ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-emerald-50' }}">
                        Wszyscy
                    </a>
                    @foreach($doctors as $doc)
                        <a href="{{ route('admin.appointments', array_merge(request()->query(), ['doctor' => $doc->id])) }}" 
                           class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase transition-all {{ request('doctor') == $doc->id ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-emerald-50' }}">
                            {{ $doc->name }}
                        </a>
                    @endforeach
                </div>
            </div>

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
                        @if(request()->anyFilled(['search', 'doctor']))
                            <a href="{{ route('admin.appointments') }}" class="text-[10px] font-black text-rose-600 uppercase tracking-widest hover:underline">Wyczyść filtry</a>
                        @endif
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" aria-labelledby="table-title">
                            <thead>
                                <tr class="bg-slate-50 text-emerald-900 uppercase text-[10px] font-black tracking-wider border-b border-emerald-100">
                                    <th scope="col" class="p-4 font-black">Data wizyty</th>
                                    <th scope="col" class="p-4 font-black">Pacjent i Właściciel</th>
                                    <th scope="col" class="p-4 font-black">Lekarz i Usługa</th>
                                    <th scope="col" class="p-4 text-center font-black">Status (Zmień)</th>
                                    <th scope="col" class="p-4 text-right font-black">Akcje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-emerald-50">
                                @forelse($appointments as $app)
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
                                                {{ $app->status == 'zatwierdzona' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                                {{ $app->status == 'zakończona' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $app->status == 'odwołana' ? 'bg-rose-100 text-rose-800' : '' }}">
                                                
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
                                                class="text-red-600 hover:text-red-800 font-black text-[10px] uppercase tracking-tighter transition-colors focus:ring-2 focus:ring-red-500 rounded p-1">
                                                Usuń wpis
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400 italic">
                                        Brak wizyt spełniających kryteria wyszukiwania.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>