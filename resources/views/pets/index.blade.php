<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
            {{ __('Twoje Zwierzęta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-emerald-100 p-8">
                
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900">Lista podopiecznych</h3>
                        <p class="text-slate-500">Tutaj znajdziesz wszystkie swoje zwierzęta zarejestrowane w MediPet.</p>
                    </div>
                    <a href="{{ route('pets.create') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Dodaj zwierzę
                    </a>
                </div>

                @if($pets->isEmpty())
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-12 text-center">
                        <p class="text-emerald-800 font-medium">Nie masz jeszcze żadnych zwierząt w naszej bazie.</p>
                        <p class="text-emerald-600 text-sm mt-2">Dodaj pierwszego pupila, aby móc umówić wizytę.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-2xl border border-slate-100">
                        <table class="w-full text-left border-collapse" aria-label="Tabela Twoich zwierząt">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="p-4 font-bold text-slate-700 border-b">Imię</th>
                                    <th scope="col" class="p-4 font-bold text-slate-700 border-b">Gatunek</th>
                                    <th scope="col" class="p-4 font-bold text-slate-700 border-b">Rasa</th>
                                    <th scope="col" class="p-4 font-bold text-slate-700 border-b text-right">Akcje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($pets as $pet)
                                    <tr class="hover:bg-emerald-50/30 transition">
                                        <td class="p-4 text-slate-900 font-medium">{{ $pet->name }}</td>
                                        <td class="p-4 text-slate-600">{{ $pet->species }}</td>
                                        <td class="p-4 text-slate-600">{{ $pet->breed ?? '-' }}</td>
                                        <td class="p-4 text-right flex justify-end gap-3">
                                            <a href="{{ route('pets.edit', $pet) }}" class="text-emerald-600 hover:text-emerald-800 font-bold text-sm">
                                                Edytuj
                                            </a>

                                            <form method="POST" action="{{ route('pets.destroy', $pet) }}" onsubmit="return confirm('Czy na pewno chcesz usunąć tego zwierzaka?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-sm">
                                                    Usuń
                                                </button>
                                            </form>
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