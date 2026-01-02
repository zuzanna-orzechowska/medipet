<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-950 leading-tight tracking-tight">
            {{ __('Dodaj nowego pupila') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-emerald-100 p-8 lg:p-12">
                
                <header class="mb-8">
                    <h3 id="create-pet-heading" class="text-xl font-bold text-emerald-900">Rejestracja zwierzęcia</h3>
                    <p class="text-sm text-slate-600 mt-1">Wypełnij poniższe dane, aby dodać swojego podopiecznego do bazy MediPet.</p>
                </header>

                <form method="POST" action="{{ route('pets.store') }}" class="space-y-6" aria-labelledby="create-pet-heading">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Imię zwierzaka')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                        <x-text-input id="name" name="name" type="text" 
                                      class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all" 
                                      :value="old('name')" 
                                      placeholder="np. Reksio"
                                      required aria-required="true" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" aria-live="polite" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="species" :value="__('Gatunek')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                            <x-text-input id="species" name="species" type="text" 
                                          class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all" 
                                          :value="old('species')" 
                                          placeholder="np. Pies"
                                          required aria-required="true" />
                            <x-input-error class="mt-2" :messages="$errors->get('species')" aria-live="polite" />
                        </div>

                        <div>
                            <x-input-label for="breed" :value="__('Rasa (opcjonalnie)')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                            <x-text-input id="breed" name="breed" type="text" 
                                          class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all" 
                                          :value="old('breed')" 
                                          placeholder="np. Maltańczyk" />
                            <x-input-error class="mt-2" :messages="$errors->get('breed')" aria-live="polite" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="birth_date" :value="__('Data urodzenia')" class="text-emerald-950 font-black uppercase text-xs tracking-widest" />
                        <x-text-input id="birth_date" name="birth_date" type="date" 
                                      class="mt-1 block w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-xl shadow-sm transition-all" 
                                      :value="old('birth_date')" 
                                      required aria-required="true" max="{{ date('Y-m-d') }}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('birth_date')" aria-live="polite" />
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-end mt-10 border-t border-emerald-50 pt-8 gap-4">
                        <a href="{{ route('pets.index') }}" 
                           class="w-full sm:w-auto text-center text-slate-500 hover:text-slate-800 font-bold px-6 py-3 transition-colors focus:ring-2 focus:ring-emerald-500 rounded-xl outline-none">
                            Anuluj
                        </a>
                        <button type="submit" 
                                class="w-full sm:w-auto px-10 py-4 bg-emerald-600 text-white rounded-2xl font-black shadow-xl shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-1 transition-all focus:ring-4 focus:ring-emerald-100 outline-none">
                            Dodaj zwierzaka
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>