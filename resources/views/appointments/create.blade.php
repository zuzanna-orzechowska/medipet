<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
            {{ __('Umów nową wizytę') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12">
                
                <header class="mb-8">
                    <h3 id="form-title" class="text-xl font-bold text-emerald-900">Formularz rezerwacji terminu</h3>
                    <p class="text-sm text-slate-600 mt-1">Wybierz odpowiedniego specjalistę i dogodny czas. Potwierdzenie otrzymasz po weryfikacji przez lekarza.</p>
                </header>

                <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6" aria-labelledby="form-title">
                    @csrf

                    <div>
                        <x-input-label for="pet_id" :value="__('Wybierz podopiecznego')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                        <select id="pet_id" name="pet_id" 
                                class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all cursor-pointer" 
                                required aria-required="true">
                            <option value="" disabled selected>Kliknij, aby wybrać zwierzę...</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                    {{ $pet->name }} ({{ $pet->species }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('pet_id')" aria-live="polite" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="service_id" :value="__('Rodzaj usługi')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                            <select id="service_id" name="service_id" 
                                    class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all cursor-pointer" 
                                    required aria-required="true">
                                <option value="" disabled selected>Wybierz usługę...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} ({{ number_format($service->price, 2) }} zł)
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('service_id')" aria-live="polite" />
                        </div>

                        <div>
                            <x-input-label for="doctor_id" :value="__('Wybierz lekarza')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                            <select id="doctor_id" name="doctor_id" 
                                    class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all cursor-pointer" 
                                    required aria-required="true">
                                <option value="" disabled selected>Wybierz specjalistę...</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        lek. wet. {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('doctor_id')" aria-live="polite" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="appointment_date" :value="__('Preferowany termin')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                        <x-text-input id="appointment_date" name="appointment_date" type="datetime-local" 
                                      class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm" 
                                      :value="old('appointment_date')" 
                                      min="{{ date('Y-m-d\TH:i') }}"
                                      required aria-required="true" />
                        <div class="flex justify-between mt-2">
                            <p class="text-[10px] text-slate-400 uppercase font-bold italic tracking-tight">Klinika pracuje w godz. 08:00 - 20:00</p>
                            <p class="text-[10px] text-emerald-600 font-black uppercase tracking-widest">Wybierz datę przyszłą</p>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('appointment_date')" aria-live="polite" />
                    </div>

                    <div>
                        <x-input-label for="notes" :value="__('Powód wizyty / Opis objawów')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                        <textarea id="notes" name="notes" rows="4" 
                                  class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all placeholder:text-slate-300" 
                                  placeholder="Opisz krótko, co dolega Twojemu pupilowi lub jaki jest cel wizyty kontrolnej...">{{ old('notes') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" aria-live="polite" />
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-end mt-10 border-t border-emerald-50 pt-8 gap-4">
                        <a href="{{ route('appointments.index') }}" 
                           class="w-full sm:w-auto text-center text-slate-500 hover:text-slate-800 font-bold px-6 py-3 transition-colors focus:ring-2 focus:ring-emerald-500 rounded-xl outline-none">
                            Anuluj
                        </a>
                        <button type="submit" 
                                class="w-full sm:w-auto px-10 py-4 bg-emerald-600 text-white rounded-2xl font-black shadow-xl shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-1 transition-all focus:ring-4 focus:ring-emerald-100 outline-none">
                            Potwierdzam rezerwację
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('appointment_date');

        dateInput.addEventListener('change', function() {
            if (!this.value) return;

            const selectedDate = new Date(this.value);
            const hours = selectedDate.getHours();
            
            if (hours < 8 || hours >= 20) {
                alert('Przepraszamy, klinika jest czynna w godzinach 08:00 - 20:00. Prosimy o wybranie innej godziny.');
                this.value = '';
            }
        });
    });
</script>
</x-app-layout>