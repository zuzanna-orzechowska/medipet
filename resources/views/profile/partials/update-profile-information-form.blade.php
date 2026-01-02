<section aria-labelledby="profile-info-heading">
    <header>
        <h2 id="profile-info-heading" class="text-xl font-bold text-emerald-900">
            Informacje o profilu
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Zaktualizuj swoje dane osobowe oraz adres e-mail.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" aria-label="Formularz aktualizacji danych profilowych">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Imię i Nazwisko" class="font-semibold text-slate-700" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" aria-required="true" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" aria-live="polite" />
        </div>

        <div>
            <x-input-label for="email" value="Adres e-mail" class="font-semibold text-slate-700" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('email', $user->email)" required autocomplete="username" aria-required="true" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" aria-live="polite" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div role="alert" class="mt-2">
                    <p class="text-sm text-slate-800">
                        Twój adres e-mail nie jest zweryfikowany.

                        <button form="send-verification" class="font-bold text-emerald-600 hover:text-emerald-700 underline focus:ring-2 focus:ring-emerald-500 rounded-md">
                            Kliknij tutaj, aby wysłać ponownie link weryfikacyjny.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-emerald-600">
                            Nowy link weryfikacyjny został wysłany na Twój adres e-mail.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-xl shadow-md transition-all">
                Zapisz zmiany
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-emerald-600"
                    role="status"
                    aria-live="polite"
                >Zapisano pomyślnie.</p>
            @endif
        </div>
    </form>
</section>