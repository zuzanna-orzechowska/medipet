<section class="space-y-6" aria-labelledby="delete-account-heading">
    <header>
        <h2 id="delete-account-heading" class="text-xl font-bold text-red-800">
            Usuwanie konta
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Po usunięciu konta wszystkie jego zasoby i dane zostaną trwale usunięte. Przed usunięciem konta pobierz wszelkie dane, które chcesz zachować.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-xl transition-all"
        aria-label="Otwórz okno potwierdzenia usunięcia konta"
    >Usuń konto</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-slate-900">
                Czy na pewno chcesz usunąć swoje konto?
            </h2>

            <p class="mt-3 text-sm text-slate-600">
                Ta operacja jest nieodwracalna. Wprowadź swoje hasło, aby potwierdzić chęć trwałego usunięcia konta.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Hasło" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 border-slate-200 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm"
                    placeholder="Wprowadź hasło"
                    aria-required="true"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" aria-live="polite" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl border-slate-200 text-slate-700 hover:bg-slate-50 transition-all">
                    Anuluj
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-xl shadow-md transition-all">
                    Potwierdzam usunięcie
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>