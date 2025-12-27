<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">Lista Użytkowników</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600 hover:underline">
                &larr; Powrót do panelu
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl shadow-sm">
                    {!! session('success') !!}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-2xl p-8 border border-indigo-100">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-indigo-900 uppercase text-xs font-black">
                            <th class="p-4">Imię i Nazwisko / Email</th>
                            <th class="p-4">Rola</th>
                            <th class="p-4">Data dołączenia</th>
                            <th class="p-4 text-right">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="border-b hover:bg-indigo-50/30 transition">
                            <td class="p-4">
                                <p class="font-bold text-slate-800">{{ $user->name }}</p>
                                <p class="text-xs text-gray-400 font-medium">{{ $user->email }}</p>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    {{ $user->role->name == 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                                    {{ $user->role->name == 'lekarz' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $user->role->name == 'klient' ? 'bg-emerald-100 text-emerald-700' : '' }}">
                                    {{ $user->role->name }}
                                </span>
                            </td>
                            <td class="p-4 text-sm text-gray-500 font-medium">
                                {{ $user->created_at->format('d.m.Y') }}
                                <span class="text-[10px] text-gray-300 block">{{ $user->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-4 items-center">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-xs uppercase">Edytuj</a>
                                    
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('UWAGA: Usunięcie użytkownika usunie również jego wszystkie zwierzęta i wizyty! Kontynuować?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700 font-bold text-xs uppercase">Usuń</button>
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
</x-app-layout>