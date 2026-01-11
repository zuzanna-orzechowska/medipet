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
            
            <div class="mb-8 bg-white p-6 rounded-[2rem] shadow-sm border border-emerald-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <form action="{{ route('admin.users') }}" method="GET" class="w-full md:w-1/2 relative flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Szukaj po imieniu, nazwisku lub e-mailu..." 
                           class="w-full border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 rounded-2xl py-3 pl-6 pr-14 transition-all text-sm">
                    @if(request('role'))
                        <input type="hidden" name="role" value="{{ request('role') }}">
                    @endif
                    <button type="submit" class="absolute right-2 bg-emerald-600 text-white w-10 h-10 flex items-center justify-center rounded-xl hover:bg-emerald-700 transition shadow-sm shadow-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

                <div class="flex flex-wrap justify-center gap-2 p-1.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <a href="{{ route('admin.users', ['role' => '', 'search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ !request('role') ? 'bg-white shadow-sm text-emerald-700' : 'text-slate-500 hover:text-emerald-600' }}">
                        Wszyscy
                    </a>
                    <a href="{{ route('admin.users', ['role' => 'admin', 'search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ request('role') == 'admin' ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                        Admini
                    </a>
                    <a href="{{ route('admin.users', ['role' => 'lekarz', 'search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ request('role') == 'lekarz' ? 'bg-amber-100 text-amber-800 shadow-sm' : 'text-slate-500 hover:text-amber-600' }}">
                        Lekarze
                    </a>
                    <a href="{{ route('admin.users', ['role' => 'klient', 'search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ request('role') == 'klient' ? 'bg-emerald-100 text-emerald-800 shadow-sm' : 'text-slate-500 hover:text-emerald-600' }}">
                        Klienci
                    </a>
                </div>
            </div>

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
                            @forelse($users as $user)
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
                                            class="text-emerald-700 hover:text-emerald-900 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-emerald-500 rounded p-1">
                                                Edytuj
                                            </a>
                                        @endif
                                    
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                                onsubmit="return confirm('UWAGA: Usunięcie użytkownika usunie również jego wszystkie zwierzęta i wizyty! Kontynuować?')">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:text-red-800 font-black text-xs uppercase tracking-tighter focus:ring-2 focus:ring-red-500 rounded p-1">
                                                    Usuń
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-slate-500 italic">
                                    Nie znaleziono użytkowników spełniających kryteria.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>