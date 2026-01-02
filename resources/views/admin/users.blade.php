<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-emerald-950 leading-tight">Lista Użytkowników</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-2 transition focus:ring-2 focus:ring-emerald-500 rounded-lg p-1">
                <span>&larr;</span> Powrót do panelu
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div role="alert" aria-live="polite" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl shadow-sm font-medium">
                    {!! session('success') !!}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-2xl overflow-hidden border border-emerald-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" aria-label="Tabela użytkowników systemu">
                        <thead>
                            <tr class="bg-slate-50 border-b border-emerald-100 text-emerald-900 uppercase text-xs font-black tracking-widest">
                                <th scope="col" class="p-6">Imię i Nazwisko / Email</th>
                                <th scope="col" class="p-6">Rola</th>
                                <th scope="col" class="p-6">Data dołączenia</th>
                                <th scope="col" class="p-6 text-right">Akcje</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-50">
                            @foreach($users as $user)
                            <tr class="hover:bg-emerald-50/30 transition-colors">
                                <td class="p-6">
                                    <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-500 font-medium">{{ $user->email }}</p>
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm
                                        {{ $user->role->name == 'admin' ? 'bg-slate-800 text-white' : '' }}
                                        {{ $user->role->name == 'lekarz' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $user->role->name == 'klient' ? 'bg-emerald-100 text-emerald-800' : '' }}">
                                        {{ $user->role->name }}
                                    </span>
                                </td>
                                <td class="p-6 text-sm text-slate-600 font-medium">
                                    <time datetime="{{ $user->created_at->format('Y-m-d') }}">{{ $user->created_at->format('d.m.Y') }}</time>
                                    <span class="text-[10px] text-slate-400 block" aria-hidden="true">{{ $user->created_at->diffForHumans() }}</span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex justify-end gap-4 items-center">
                                        @if($user->id !== auth()->id())
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                            class="text-emerald-700 hover:text-emerald-900 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-emerald-500 rounded p-1"
                                            aria-label="Edytuj użytkownika {{ $user->name }}">
                                                Edytuj
                                            </a>

                                        @endif
                                    
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                                onsubmit="return confirm('UWAGA: Usunięcie użytkownika usunie również jego wszystkie zwierzęta i wizyty! Kontynuować?')">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:text-red-800 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-red-500 rounded p-1"
                                                        aria-label="Usuń użytkownika {{ $user->name }}">
                                                    Usuń
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>