<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
            {{ __('Panel Klienta MediPet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-emerald-100">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Witaj, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-600 mb-8">Z poziomu tego panelu możesz zarządzać swoimi pupilami oraz umawiać wizyty w naszej klinice.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-100 hover:shadow-md transition">
                            <h4 class="font-bold text-emerald-900 mb-2">Twoje Zwierzęta</h4>
                            <p class="text-sm text-gray-500 mb-4">Masz zarejestrowanych {{ Auth::user()->pets->count() }} zwierząt.</p>
                            <a href="{{ route('pets.index') }}" class="inline-flex items-center text-emerald-600 font-semibold hover:underline">
                                Zarządzaj zwierzakami &rarr;
                            </a>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
                            <h4 class="font-bold text-slate-900 mb-2">Nadchodzące wizyty</h4>
                            <p class="text-sm text-gray-500 mb-4">Brak zaplanowanych wizyt w najbliższym czasie.</p>
                            <button class="text-slate-400 font-semibold cursor-not-allowed" disabled>
                                Umów wizytę (wkrótce)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>