<x-guest-layout>
    <style>
        html { font-size: 16px; transition: font-size 0.2s; } 
        html.font-lg { font-size: 19px; }
        html.font-xl { font-size: 22px; }
        html.high-contrast {
                filter: invert(100%) hue-rotate(180deg) brightness(1.1) !important;
                background-color: #000 !important;
            }
        html.high-contrast img, 
        html.high-contrast svg,
        html.high-contrast .no-invert {
                filter: invert(100%) hue-rotate(180deg) !important;
            }
    </style>  

    <div class="mb-8 text-center">
        <a href="/" class="inline-flex flex-col items-center gap-2" aria-label="Powrót do strony głównej MediPet">
            <img src="{{ asset('images/logo.jpg') }}" alt="MediPet Logo" class="w-16 h-16 rounded-2xl shadow-lg object-cover">
            <span class="text-2xl font-extrabold tracking-tight text-emerald-900">Medi<span class="text-emerald-500">Pet</span></span>
        </a>
        <h2 class="mt-6 text-xl font-bold text-slate-800">Dołącz do MediPet</h2>
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

    <script>
            function applySavedSettings() {
                const html = document.documentElement;
                const contrast = localStorage.getItem('medipet-contrast');
                const fontSize = localStorage.getItem('medipet-font-size');

                if (contrast === 'true') {
                    html.classList.add('high-contrast');
                }

                html.classList.remove('font-lg', 'font-xl');
                if (fontSize === 'lg') html.classList.add('font-lg');
                if (fontSize === 'xl') html.classList.add('font-xl');
            }

            function toggleGlobalContrast() {
                const html = document.documentElement;
                html.classList.toggle('high-contrast');
                localStorage.setItem('medipet-contrast', html.classList.contains('high-contrast'));
            }

            function updateGlobalFontSize(size) {
                const html = document.documentElement;
                html.classList.remove('font-lg', 'font-xl');
                
                if (size === 'lg') html.classList.add('font-lg');
                if (size === 'xl') html.classList.add('font-xl');
                
                localStorage.setItem('medipet-font-size', size);
            }

            document.addEventListener('DOMContentLoaded', applySavedSettings);
        </script>
</x-guest-layout>