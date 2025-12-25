<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
            {{ __('Umów nową wizytę') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-emerald-100 p-8">
                
                <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="pet_id" :value="__('Wybierz podopiecznego')" class="text-emerald-900 font-bold" />
                        <select id="pet_id" name="pet_id" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" required>
                            <option value="" disabled selected>Wybierz zwierzę...</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                    {{ $pet->name }} ({{ $pet->species }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('pet_id')" />
                    </div>

                    <div>
                        <x-input-label for="service_id" :value="__('Rodzaj usługi')" class="text-emerald-900 font-bold" />
                        <select id="service_id" name="service_id" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" required>
                            <option value="" disabled selected>Wybierz usługę...</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }} ({{ number_format($service->price, 2) }} zł)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('service_id')" />
                    </div>

                    <div>
                        <x-input-label for="appointment_date" :value="__('Preferowana data i godzina')" class="text-emerald-900 font-bold" />
                        <x-text-input id="appointment_date" name="appointment_date" type="datetime-local" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" :value="old('appointment_date')" required />
                        <p class="text-xs text-slate-400 mt-1 italic">Klinika MediPet pracuje w godzinach 08:00 - 20:00.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('appointment_date')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Powód wizyty / Opis objawów')" class="text-emerald-900 font-bold" />
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" placeholder="Opisz krótko, co dolega Twojemu pupilowi...">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t border-emerald-50 pt-6 gap-4">
                        <a href="{{ route('appointments.index') }}" class="text-slate-500 hover:text-slate-700 font-semibold px-4 py-2 transition">Anuluj</a>
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                            Potwierdzam rezerwację
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>