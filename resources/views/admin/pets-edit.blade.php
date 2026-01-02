<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight">Edycja danych pacjenta: {{ $pet->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl p-8 border border-emerald-100">
                
                @if ($errors->any())
                    <div role="alert" class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-medium">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.pets.update', $pet) }}" method="POST" aria-label="Formularz edycji zwierzaka">
                    @csrf @method('PUT')

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" value="Imię zwierzaka" class="font-bold text-slate-700" />
                                <x-text-input id="name" name="name" type="text" 
                                              class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" 
                                              :value="old('name', $pet->name)" required aria-required="true" />
                            </div>
                            <div>
                                <x-input-label for="species" value="Gatunek" class="font-bold text-slate-700" />
                                <x-text-input id="species" name="species" type="text" 
                                              class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" 
                                              :value="old('species', $pet->species)" required aria-required="true" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="breed" value="Rasa (opcjonalnie)" class="font-bold text-slate-700" />
                                <x-text-input id="breed" name="breed" type="text" 
                                              class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" 
                                              :value="old('breed', $pet->breed)" />
                            </div>
                            <div>
                                <x-input-label for="birth_date" value="Data urodzenia" class="font-bold text-slate-700" />
                                <x-text-input id="birth_date" 
                                            name="birth_date" 
                                            type="date" 
                                            class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" 
                                            :value="old('birth_date', \Carbon\Carbon::parse($pet->birth_date)->format('Y-m-d'))" 
                                            required 
                                            aria-required="true" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="user_id" value="Właściciel (przypisz do użytkownika)" class="font-bold text-slate-700" />
                            <select id="user_id" name="user_id" 
                                    class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm transition-all cursor-pointer">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $pet->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-between items-center mt-8 pt-6 border-t border-emerald-50">
                            <a href="{{ route('admin.pets') }}" class="text-sm font-bold text-slate-500 hover:text-emerald-700 hover:underline transition">
                                Anuluj
                            </a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-black shadow-lg shadow-emerald-100 transition-all focus:ring-4 focus:ring-emerald-100">
                                Zapisz zmiany
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>