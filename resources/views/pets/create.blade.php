<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
            {{ __('Dodaj nowego podopiecznego') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-emerald-100 p-8">
                
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-slate-900">Formularz rejestracji zwierzęcia</h3>
                    <p class="text-slate-500">Wprowadź podstawowe dane o swoim pupilu, abyśmy mogli założyć mu kartę pacjenta.</p>
                </div>

                <form method="POST" action="{{ route('pets.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Imię zwierzaka')" class="text-emerald-900 font-bold" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('name')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="species" :value="__('Gatunek')" class="text-emerald-900 font-bold" />
                            <select id="species" name="species" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" required>
                                <option value="" disabled selected>Wybierz gatunek</option>
                                <option value="Pies">Pies</option>
                                <option value="Kot">Kot</option>
                                <option value="Królik">Królik</option>
                                <option value="Inny">Inny</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('species')" />
                        </div>

                        <div>
                            <x-input-label for="breed" :value="__('Rasa (opcjonalnie)')" class="text-emerald-900 font-bold" />
                            <x-text-input id="breed" name="breed" type="text" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('breed')" />
                            <x-input-error class="mt-2" :messages="$errors->get('breed')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="birth_date" :value="__('Data urodzenia (szacunkowa)')" class="text-emerald-900 font-bold" />
                        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('birth_date')" />
                        <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t border-emerald-50 pt-6 gap-4">
                        <a href="{{ route('pets.index') }}" class="text-slate-500 hover:text-slate-700 font-semibold px-4 py-2 transition">
                            Anuluj
                        </a>
                        <button type="submit" class="inline-flex items-center px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 focus:ring-4 focus:ring-emerald-200 outline-none">
                            Zarejestruj pupila
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>