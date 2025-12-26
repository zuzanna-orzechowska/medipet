<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                {{ __('Zarządzanie Zwierzętami') }}
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
                    <span>{!! session('success') !!}</span>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-2xl border border-indigo-100 overflow-hidden">
                <div class="p-8">
                    <h3 class="text-lg font-bold mb-6 text-slate-800">Baza pacjentów MediPet</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-indigo-50/50 text-indigo-900 uppercase text-xs font-black tracking-wider">
                                    <th class="p-4 border-b">Zwierzak</th>
                                    <th class="p-4 border-b">Właściciel</th>
                                    <th class="p-4 border-b">Rasa</th>
                                    <th class="p-4 border-b">Data urodzenia</th>
                                    <th class="p-4 border-b text-right">Akcje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($pets as $pet)
                                <tr class="hover:bg-indigo-50/30 transition">
                                    <td class="p-4">
                                        <p class="font-bold text-lg leading-none text-indigo-900">{{ $pet->name }}</p>
                                        <p class="text-[10px] text-indigo-500 font-black uppercase mt-1 tracking-widest">{{ $pet->species }}</p>
                                    </td>
                                    <td class="p-4 text-sm text-slate-600">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-slate-900">{{ $pet->user->name }}</span>
                                            <span class="text-xs text-slate-400">{{ $pet->user->email }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm text-gray-500 italic">
                                        {{ $pet->breed ?? 'Nie podano' }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($pet->birth_date)->format('d.m.Y') }}
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex justify-end gap-4 items-center">
                                            <a href="{{ route('admin.pets.edit', $pet) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm transition-colors">
                                                Edytuj
                                            </a>
                                            
                                            <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć zwierzaka {{ $pet->name }}?')">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm transition-colors">
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

                    @if($pets->isEmpty())
                        <div class="text-center py-12 text-gray-400 italic">
                            Brak zarejestrowanych zwierząt w systemie.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>