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
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🐾</span>
                                <h4 class="font-bold text-emerald-900">Twoje Zwierzęta</h4>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">Masz zarejestrowanych {{ Auth::user()->pets->count() }} zwierząt.</p>
                            <a href="{{ route('pets.index') }}" class="inline-flex items-center text-emerald-600 font-semibold hover:underline focus:outline-none focus:ring-2 focus:ring-emerald-500 rounded px-1">
                                Zarządzaj zwierzakami &rarr;
                            </a>
                        </div>

                        <div class="p-6 bg-white rounded-2xl border border-emerald-100 hover:shadow-md transition shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🗓️</span>
                                <h4 class="font-bold text-slate-900">Wizyty i Terminy</h4>
                            </div>
                            
                            @php
                                $appointmentsCount = \App\Models\Appointment::whereIn('pet_id', Auth::user()->pets->pluck('id'))->count();
                            @endphp

                            <p class="text-sm text-gray-500 mb-4">
                                @if($appointmentsCount > 0)
                                    Masz zaplanowane {{ $appointmentsCount }} wizyty.
                                @else
                                    Nie masz jeszcze umówionych wizyt.
                                @endif
                            </p>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('appointments.index') }}" class="text-sm font-bold text-emerald-600 hover:underline focus:outline-none focus:ring-2 focus:ring-emerald-500 rounded px-1">
                                    Zobacz historię wizyt
                                </a>
                                <a href="{{ route('appointments.create') }}" class="text-sm font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-lg hover:bg-emerald-100 transition">
                                    + Umów nową wizytę
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>