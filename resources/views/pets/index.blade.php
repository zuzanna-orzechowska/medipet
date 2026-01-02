<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
            {{ __('Twoje Zwierzęta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div role="alert" aria-live="polite" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm font-medium">
                    <span class="text-xl" aria-hidden="true">✅</span>
                    <span>{!! session('success') !!}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                    <div>
                        <h3 id="pets-list-title" class="text-3xl font-black text-emerald-950">Lista podopiecznych</h3>
                        <p class="text-slate-600 mt-2">Tutaj znajdziesz wszystkie swoje zwierzęta zarejestrowane w klinice MediPet.</p>
                    </div>
                    <a href="{{ route('pets.create') }}" 
                       class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white rounded-2xl font-black shadow-xl shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-1 transition-all focus:ring-4 focus:ring-emerald-100 outline-none">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Dodaj zwierzę
                    </a>
                </div>

                @if($pets->isEmpty())
                    <div class="bg-emerald-50/50 border-2 border-dashed border-emerald-200 rounded-[2rem] p-16 text-center">
                        <span class="text-6xl mb-6 block" aria-hidden="true">🐾</span>
                        <p class="text-emerald-900 text-xl font-bold">Nie masz jeszcze żadnych zwierząt w naszej bazie.</p>
                        <p class="text-slate-600 mt-3">Dodaj swojego pierwszego pupila, aby móc umawiać wizyty online.</p>
                        <a href="{{ route('pets.create') }}" class="mt-8 inline-block text-emerald-600 font-black hover:text-emerald-800 underline focus:ring-2 focus:ring-emerald-500 rounded p-1">
                            Zarejestruj zwierzę teraz
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-3xl border border-emerald-50 shadow-sm">
                        <table class="w-full text-left border-collapse" aria-labelledby="pets-list-title">
                            <caption class="sr-only">Lista Twoich zwierząt zarejestrowanych w systemie</caption>
                            <thead>
                                <tr class="bg-slate-50 border-b border-emerald-100">
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Imię</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Gatunek</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Rasa</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest">Data urodzenia</th>
                                    <th scope="col" class="p-6 font-black text-emerald-900 uppercase text-xs tracking-widest text-right">Akcje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-emerald-50">
                                @foreach($pets as $pet)
                                    <tr class="hover:bg-emerald-50/30 transition-colors group">
                                        <td class="p-6">
                                            <span class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">{{ $pet->name }}</span>
                                        </td>
                                        <td class="p-6">
                                            <span class="inline-flex items-center px-3 py-1 bg-white border border-emerald-100 rounded-lg text-sm font-semibold text-emerald-700 shadow-sm">
                                                {{ $pet->species }}
                                            </span>
                                        </td>
                                        <td class="p-6 text-slate-600 font-medium">
                                            {{ $pet->breed ?? 'Mieszaniec' }}
                                        </td>
                                        <td class="p-6">
                                            <time datetime="{{ \Carbon\Carbon::parse($pet->birth_date)->format('Y-m-d') }}" class="text-sm text-slate-600 font-medium">
                                                {{ \Carbon\Carbon::parse($pet->birth_date)->format('d.m.Y') }}
                                            </time>
                                        </td>
                                        <td class="p-6 text-right">
                                            <div class="flex justify-end items-center gap-6">
                                                <a href="{{ route('pets.edit', $pet) }}" 
                                                   class="font-black text-sm text-emerald-600 hover:text-emerald-800 transition-colors focus:ring-2 focus:ring-emerald-500 rounded p-1 outline-none"
                                                   aria-label="Edytuj dane zwierzaka: {{ $pet->name }}">
                                                    Edytuj
                                                </a>

                                                <form method="POST" action="{{ route('pets.destroy', $pet) }}" 
                                                      onsubmit="return confirm('Czy na pewno chcesz usunąć {{ $pet->name }} z systemu? Tej operacji nie można cofnąć.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="font-black text-sm text-rose-600 hover:text-rose-800 transition-colors focus:ring-2 focus:ring-rose-500 rounded p-1 outline-none"
                                                            aria-label="Usuń zwierzaka: {{ $pet->name }}">
                                                        Usuń
                                                    </button>
                                                </form>
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