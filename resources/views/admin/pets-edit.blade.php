<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">Edycja danych: {{ $pet->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl p-8 border border-indigo-100">
                <form action="{{ route('admin.pets.update', $pet) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" value="Imię zwierzaka" />
                                <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="$pet->name" required />
                            </div>
                            <div>
                                <x-input-label for="species" value="Gatunek" />
                                <x-text-input id="species" name="species" type="text" class="block mt-1 w-full" :value="$pet->species" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="breed" value="Rasa" />
                                <x-text-input id="breed" name="breed" type="text" class="block mt-1 w-full" :value="$pet->breed" />
                            </div>
                            <div>
                                <x-input-label for="birth_date" value="Data urodzenia" />
                                <x-text-input id="birth_date" name="birth_date" type="date" class="block mt-1 w-full" :value="\Carbon\Carbon::parse($pet->birth_date)->format('Y-m-d')" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="user_id" value="Właściciel" />
                            <select name="user_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $pet->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-between items-center mt-8 pt-6 border-t">
                            <a href="{{ route('admin.pets') }}" class="text-sm text-gray-500 hover:underline">Anuluj</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-2 rounded-xl font-bold shadow-lg shadow-indigo-100 transition">
                                Zapisz zmiany
                            </button>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            </div>
        </div>
    </div>
</x-app-layout>