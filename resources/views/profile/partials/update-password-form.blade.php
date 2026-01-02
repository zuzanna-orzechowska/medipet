<section aria-labelledby="update-password-heading">
    <header>
        <h2 id="update-password-heading" class="text-xl font-bold text-emerald-900">
            Aktualizacja hasła
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Upewnij się, że Twoje konto używa długiego, losowego hasła, aby pozostać bezpiecznym.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" aria-label="Formularz zmiany hasła">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Obecne hasło" class="font-semibold text-slate-700" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" autocomplete="current-password" aria-required="true" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" aria-live="polite" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Nowe hasło" class="font-semibold text-slate-700" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" autocomplete="new-password" aria-required="true" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" aria-live="polite" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Potwierdź nowe hasło" class="font-semibold text-slate-700" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" autocomplete="new-password" aria-required="true" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" aria-live="polite" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-xl transition-all">
                Zmień hasło
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-emerald-600"
                    role="status"
                    aria-live="polite"
                >Hasło zostało zmienione.</p>
            @endif
        </div>
    </form>
</section>