<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
                {{ __('Zarządzanie Zwierzętami') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-2 transition focus:ring-2 focus:ring-emerald-500 rounded-lg p-1" aria-label="Powrót do panelu administratora">
                <span>&larr;</span> {{ __('Powrót do panelu') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 bg-white p-6 rounded-[2rem] shadow-sm border border-emerald-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <form action="{{ route('admin.pets') }}" method="GET" class="w-full md:w-1/2 relative flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Szukaj imienia zwierzaka lub właściciela..." 
                           class="w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-2xl py-3 pl-6 pr-14 transition-all text-sm">
                    @if(request('species'))
                        <input type="hidden" name="species" value="{{ request('species') }}">
                    @endif
                    <button type="submit" class="absolute right-2 bg-emerald-600 text-white w-10 h-10 flex items-center justify-center rounded-xl hover:bg-emerald-700 transition shadow-sm shadow-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div role="alert" aria-live="polite" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm font-medium">
                    <span class="text-xl" aria-hidden="true">✅</span>
                    <span>{!! session('success') !!}</span>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-2xl border border-emerald-100 overflow-hidden">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 id="pets-table-title" class="text-lg font-bold text-emerald-900">Baza pacjentów MediPet</h3>
                        @if(request()->anyFilled(['search', 'species']))
                            <a href="{{ route('admin.pets') }}" class="text-[10px] font-black text-rose-600 uppercase tracking-widest hover:underline">Wyczyść filtry</a>
                        @endif
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" aria-labelledby="pets-table-title">
                            <thead>
                                <tr class="bg-slate-50 text-emerald-900 uppercase text-xs font-black tracking-widest border-b border-emerald-100">
                                    <th scope="col" class="p-4">Zwierzak</th>
                                    <th scope="col" class="p-4">Właściciel</th>
                                    <th scope="col" class="p-4">Rasa</th>
                                    <th scope="col" class="p-4">Data urodzenia</th>
                                    <th scope="col" class="p-4 text-right">Akcje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-emerald-50">
                                @forelse($pets as $pet)
                                <tr class="hover:bg-emerald-50/30 transition duration-150">
                                    <td class="p-4">
                                        <p class="font-black text-lg leading-none text-emerald-900">{{ $pet->name }}</p>
                                        <p class="text-[10px] text-emerald-600 font-black uppercase mt-1 tracking-widest">{{ $pet->species }}</p>
                                    </td>
                                    <td class="p-4 text-sm">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900">{{ $pet->user->name }}</span>
                                            <span class="text-xs text-slate-500">{{ $pet->user->email }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm text-slate-600 italic">
                                        {{ $pet->breed ?? 'Nie podano' }}
                                    </td>
                                    <td class="p-4 text-sm text-slate-600 font-medium">
                                        <time datetime="{{ \Carbon\Carbon::parse($pet->birth_date)->format('Y-m-d') }}">
                                            {{ \Carbon\Carbon::parse($pet->birth_date)->format('d.m.Y') }}
                                        </time>
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex justify-end gap-4 items-center">
                                            <a href="{{ route('admin.pets.edit', $pet) }}" 
                                               class="text-emerald-700 hover:text-emerald-950 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-emerald-500 rounded p-1"
                                               aria-label="Edytuj dane pacjenta {{ $pet->name }}">
                                                Edytuj
                                            </a>
                                            
                                            <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć zwierzaka {{ $pet->name }}?')">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-red-500 rounded p-1"
                                                        aria-label="Usuń pacjenta {{ $pet->name }} z systemu">
                                                    Usuń
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400 italic">
                                        Nie znaleziono pacjentów spełniających kryteria.
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