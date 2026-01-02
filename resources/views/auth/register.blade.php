<x-guest-layout>
    <div class="mb-8 text-center">
        <a href="/" class="inline-flex flex-col items-center gap-2" aria-label="Powrót do strony głównej MediPet">
            <img src="{{ asset('images/logo.jpg') }}" alt="MediPet Logo" class="w-16 h-16 rounded-2xl shadow-lg object-cover">
            <span class="text-2xl font-extrabold tracking-tight text-emerald-900">Medi<span class="text-emerald-500">Pet</span></span>
        </a>
        <h2 class="mt-6 text-xl font-bold text-slate-800">Dołącz do MediPet</h2>
        <p class="text-sm text-slate-500">Stwórz konto, aby dbać o zdrowie swoich pupili online.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" aria-label="Formularz rejestracji nowego konta">
        @csrf

        <div>
            <x-input-label for="name" value="Imię i Nazwisko" class="text-slate-700 font-semibold" />
            <x-text-input id="name" 
                          class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" 
                          type="text" 
                          name="name" 
                          :value="old('name')" 
                          required 
                          autofocus 
                          autocomplete="name" 
                          aria-required="true" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" aria-live="polite" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" class="text-slate-700 font-semibold" />
            <x-text-input id="email" 
                          class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
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
                          autocomplete="new-password" 
                          aria-required="true" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" aria-live="polite" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Potwierdź hasło" class="text-slate-700 font-semibold" />
            <x-text-input id="password_confirmation" 
                          class="block mt-1 w-full border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl"
                          type="password"
                          name="password_confirmation" 
                          required 
                          autocomplete="new-password" 
                          aria-required="true" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" aria-live="polite" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 transition-all">
                Załóż konto
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-slate-600">
                Masz już konto? 
                <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 focus:underline">Zaloguj się</a>
            </p>
        </div>
    </form>
</x-guest-layout>