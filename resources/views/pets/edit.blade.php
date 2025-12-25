<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
            {{ __('Edytuj dane: ') }} {{ $pet->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-emerald-100 p-8">
                
                <form method="POST" action="{{ route('pets.update', $pet) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" :value="__('Imię zwierzaka')" class="text-emerald-900 font-bold" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('name', $pet->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="species" :value="__('Gatunek')" class="text-emerald-900 font-bold" />
                            <select id="species" name="species" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" required>
                                <option value="Pies" {{ $pet->species == 'Pies' ? 'selected' : '' }}>Pies</option>
                                <option value="Kot" {{ $pet->species == 'Kot' ? 'selected' : '' }}>Kot</option>
                                <option value="Królik" {{ $pet->species == 'Królik' ? 'selected' : '' }}>Królik</option>
                                <option value="Inny" {{ $pet->species == 'Inny' ? 'selected' : '' }}>Inny</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('species')" />
                        </div>

                        <div>
                            <x-input-label for="breed" :value="__('Rasa')" class="text-emerald-900 font-bold" />
                            <x-text-input id="breed" name="breed" type="text" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('breed', $pet->breed)" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t border-emerald-50 pt-6 gap-4">
                        <a href="{{ route('pets.index') }}" class="text-slate-500 hover:text-slate-700 font-semibold px-4 py-2 transition">Anuluj</a>
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                            Zapisz zmiany
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>