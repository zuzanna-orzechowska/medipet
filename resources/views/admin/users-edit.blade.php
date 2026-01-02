<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-emerald-950 leading-tight">Edycja użytkownika</h2>
            <p class="text-emerald-700 font-medium">{{ $user->name }}</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl p-8 border border-emerald-100">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" aria-label="Formularz edycji danych użytkownika">
                    @csrf @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="name" value="Imię i Nazwisko" class="font-bold text-slate-700" />
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" 
                                :value="old('name', $user->name)" required aria-required="true" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" aria-live="polite" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Adres Email" class="font-bold text-slate-700" />
                            <x-text-input id="email" name="email" type="email" 
                                class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" 
                                :value="old('email', $user->email)" required aria-required="true" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" aria-live="polite" />
                        </div>

                        <div>
                            <x-input-label for="role_id" value="Rola w systemie" class="font-bold text-slate-700" />
                            <select id="role_id" name="role_id" 
                                class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm"
                                aria-required="true">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" aria-live="polite" />
                        </div>

                        <div class="flex justify-between items-center mt-8 pt-6 border-t border-emerald-50">
                            <a href="{{ route('admin.users') }}" class="text-sm font-bold text-slate-500 hover:text-emerald-700 hover:underline transition">
                                Anuluj zmiany
                            </a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-black shadow-lg shadow-emerald-100 transition-all focus:ring-4 focus:ring-emerald-100">
                                Zaktualizuj konto
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>