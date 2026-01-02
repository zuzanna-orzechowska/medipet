<x-guest-layout>
    <div class="mb-8 text-center">
        <a href="/" class="inline-flex flex-col items-center gap-2" aria-label="Powrót do strony głównej MediPet">
            <img src="{{ asset('images/logo.jpg') }}" alt="MediPet Logo" class="w-16 h-16 rounded-2xl shadow-lg object-cover">
            <span class="text-2xl font-extrabold tracking-tight text-emerald-900">Medi<span class="text-emerald-500">Pet</span></span>
        </a>
        <h2 class="mt-6 text-xl font-bold text-slate-800">Witaj ponownie!</h2>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" aria-label="Formularz logowania">
        @csrf

        <div>
            <x-input-label for="email" value="Email" class="text-slate-700 font-semibold" />
            <x-text-input id="email" 
                          class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          autocomplete="username" 
                          aria-required="true" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" aria-live="polite" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Hasło" class="text-slate-700 font-semibold" />
            <x-text-input id="password" 
                          class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl"
                          type="password"
                          name="password"
                          required 
                          autocomplete="current-password" 
                          aria-required="true" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" aria-live="polite" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500 w-5 h-5" name="remember">
                <span class="ms-2 text-sm text-slate-600">Zapamiętaj mnie</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-emerald-600 hover:text-emerald-700 font-semibold transition focus:outline-none focus:underline" href="{{ route('password.request') }}">
                    Zapomniałeś hasła?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 transition-all">
                Zaloguj się
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-slate-600">
                Nie masz jeszcze konta? 
                <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 focus:underline">Zarejestruj się</a>
            </p>
        </div>
    </form>
</x-guest-layout>