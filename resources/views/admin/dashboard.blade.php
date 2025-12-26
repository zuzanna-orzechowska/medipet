<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
            {{ __('Centrum Dowodzenia MediPet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase">Użytkownicy</p>
                        <p class="text-3xl font-bold text-indigo-600">{{ $stats['users'] }}</p>
                    </div>
                    <span class="text-4xl">👥</span>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase">Zwierzęta</p>
                        <p class="text-3xl font-bold text-indigo-600">{{ $stats['pets'] }}</p>
                    </div>
                    <span class="text-4xl">🐶</span>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase">Wszystkie Wizyty</p>
                        <p class="text-3xl font-bold text-indigo-600">{{ $stats['appointments'] }}</p>
                    </div>
                    <span class="text-4xl">📅</span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-indigo-100 p-8">
                <h3 class="text-lg font-bold mb-6">Zarządzanie systemem</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.users') }}" class="p-4 border border-indigo-50 rounded-xl hover:bg-indigo-50 transition flex items-center gap-4">
                        <div class="bg-indigo-100 p-3 rounded-lg text-indigo-600 font-bold">U</div>
                        <div>
                            <p class="font-bold">Zarządzaj Użytkownikami</p>
                            <p class="text-sm text-gray-500">Usuwanie kont, wgląd w role lekarzy i klientów.</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.appointments') }}" class="p-4 border border-indigo-50 rounded-xl hover:bg-indigo-50 transition flex items-center gap-4">
                        <div class="bg-indigo-100 p-3 rounded-lg text-indigo-600 font-bold">W</div>
                        <div>
                            <p class="font-bold">Monitoruj Wizyty</p>
                            <p class="text-sm text-gray-500">Pełna historia wszystkich zapisów w klinice.</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.pets') }}" class="p-4 border border-indigo-50 rounded-xl hover:bg-indigo-50 transition flex items-center gap-4">
                        <div class="bg-indigo-100 p-3 rounded-lg text-indigo-600 font-bold">Z</div>
                        <div>
                            <p class="font-bold">Zarządzaj Zwierzętami</p>
                            <p class="text-sm text-gray-500">Edytuj dane pacjentów i przypisuj ich do właścicieli.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>