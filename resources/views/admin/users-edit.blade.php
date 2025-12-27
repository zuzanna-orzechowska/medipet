<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">Edycja użytkownika: {{ $user->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl p-8 border border-indigo-100">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="name" value="Imię i Nazwisko" />
                            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="$user->name" required />
                        </div>

                        <div>
                            <x-input-label for="email" value="Adres Email" />
                            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="$user->email" required />
                        </div>

                        <div>
                            <x-input-label for="role_id" value="Rola w systemie" />
                            <select name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-between items-center mt-8 pt-6 border-t">
                            <a href="{{ route('admin.users') }}" class="text-sm text-gray-500 hover:underline">Anuluj</a>
                            <button type="submit" class="bg-indigo-600 text-white px-8 py-2 rounded-xl font-bold shadow-lg shadow-indigo-100">
                                Zaktualizuj konto
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>