<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediPet - Klinika Weterynaryjna</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-mesh {
            background-color: #ffffff;
            background-image: radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                              radial-gradient(at 100% 0%, rgba(5, 150, 105, 0.05) 0px, transparent 50%);
        }
        :focus-visible {
            outline: 3px solid #10b981;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="gradient-mesh text-slate-900 antialiased">

    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-emerald-50">
        <nav class="max-w-7xl mx-auto px-6 lg:px-8" aria-label="Nawigacja główna">
            <div class="flex justify-between h-20 items-center">
                
                <a href="{{ url('/') }}" class="flex items-center gap-3 group" aria-label="Strona główna MediPet">
                    <img src="{{ asset('images/logo.jpg') }}" 
                        alt="Logo MediPet" 
                        class="w-10 h-10 rounded-xl shadow-lg group-hover:scale-110 transition-transform object-cover">
                    <span class="text-2xl font-extrabold tracking-tight text-emerald-900">
                        Medi<span class="text-emerald-500">Pet</span>
                    </span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#o-nas" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition">O nas</a>
                    <a href="#uslugi" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition">Usługi</a>
                    <div class="h-6 w-px bg-slate-200" aria-hidden="true"></div>
                    @if (Route::has('login'))
                        <div class="flex items-center gap-4">
                            @auth
                                @php
                                    $dashboardRoute = 'dashboard'; // domyślnie dla klienta
                                    if(Auth::user()->role->name === 'admin') $dashboardRoute = 'admin.dashboard';
                                    if(Auth::user()->role->name === 'lekarz') $dashboardRoute = 'doctor.dashboard';
                                @endphp

                                <a href="{{ route($dashboardRoute) }}" 
                                class="bg-emerald-600 text-white px-6 py-2 rounded-full font-bold hover:bg-emerald-700 transition shadow-md">
                                    Przejdź do Panelu
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-rose-600 font-bold hover:text-rose-800 transition uppercase text-xs tracking-widest outline-none focus:ring-2 focus:ring-rose-500 rounded px-2">
                                        Wyloguj się
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="font-bold text-emerald-700 hover:text-emerald-900 transition">Zaloguj się</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-6 py-2 rounded-full font-bold hover:bg-emerald-700 transition">Zarejestruj się</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main id="main-content">
        <section class="relative pt-12 pb-20 lg:pt-24 lg:pb-32 overflow-hidden" aria-labelledby="hero-title">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
                    
                    <div class="lg:col-span-6 text-center lg:text-left">
                        <h1 id="hero-title" class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-8">
                            Zdrowie Twojego przyjaciela w <span class="text-emerald-600 italic">dobrych</span> rękach.
                        </h1>
                        <p class="text-lg text-slate-600 leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0">
                            W MediPet łączymy pasję do zwierząt z najnowszą technologią medyczną. Zadbaj o profilaktykę swojego pupila z najlepszymi specjalistami w mieście.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                            <a href="{{ Auth::check() ? route('appointments.create') : route('login') }}" class="px-8 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all text-center">
                                Umów wizytę online
                            </a>
                            <a href="#uslugi" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold text-lg hover:bg-slate-50 transition-all text-center">
                                Sprawdź cennik
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-6 mt-16 lg:mt-0 relative">
                        <div class="absolute -top-12 -right-12 w-64 h-64 bg-emerald-100 rounded-full blur-3xl opacity-50" aria-hidden="true"></div>
                        
                        <div class="relative bg-emerald-50 border-2 border-white rounded-[2rem] aspect-square overflow-hidden shadow-2xl flex items-center justify-center group">
                            <img src="{{ asset('images/lekarze.jpg') }}" alt="Nasi uśmiechnięci lekarze weterynarii gotowi do pomocy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur p-4 rounded-xl shadow-lg border border-emerald-50">
                                <p class="text-xs font-bold text-emerald-800 uppercase tracking-widest mb-1">Nasz Zespół</p>
                                <p class="text-sm text-slate-600 italic">"Zapewniamy opiekę 24/7 dla nagłych przypadków."</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="o-nas" class="py-24 bg-emerald-50/50" aria-labelledby="about-title">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 id="about-title" class="text-3xl lg:text-5xl font-extrabold text-slate-900 mb-6">Poznaj MediPet</h2>
                        <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                            Jesteśmy nowoczesną kliniką weterynaryjną, która powstała z miłości do zwierząt. Naszą misją jest zapewnienie najwyższej jakości opieki medycznej w przyjaznej atmosferze.
                        </p>
                        <ul class="space-y-4" role="list">
                            <li class="flex items-center gap-3 font-semibold text-slate-700">
                                <span class="text-emerald-500" aria-hidden="true">✔</span> Nowoczesna aparatura diagnostyczna
                            </li>
                            <li class="flex items-center gap-3 font-semibold text-slate-700">
                                <span class="text-emerald-500" aria-hidden="true">✔</span> Doświadczona kadra lekarzy weterynarii
                            </li>
                            <li class="flex items-center gap-3 font-semibold text-slate-700">
                                <span class="text-emerald-500" aria-hidden="true">✔</span> Indywidualne podejście do każdego pacjenta
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-emerald-100">
                        <div class="text-center">
                            <img src="{{ asset('images/lekarz.jpg') }}" 
                                alt="Dr Jan Kowalski - nasz najbardziej doświadczony specjalista" 
                                class="w-32 h-32 mx-auto mb-4 rounded-full object-cover border-2 border-emerald-100 shadow-sm">
                            
                            <h3 class="text-2xl font-bold mb-2">Ponad 10 lat</h3>
                            <p class="text-slate-500 font-medium uppercase tracking-widest text-sm">Doświadczenia w branży</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="uslugi" class="py-24 bg-white" aria-labelledby="services-title">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-20">
                    <h2 id="services-title" class="text-3xl lg:text-5xl font-extrabold text-slate-900 mb-6">Nasze Usługi</h2>
                    <p class="text-slate-500 text-lg">Poniżej znajdziesz listę najczęściej wybieranych zabiegów i konsultacji.</p>
                </div>

                <div class="bg-white border border-slate-100 rounded-[2.5rem] shadow-xl overflow-hidden max-w-4xl mx-auto">
                    <table class="w-full text-left border-collapse">
                        <caption class="sr-only">Cennik usług kliniki MediPet</caption>
                        <thead>
                            <tr class="bg-slate-50">
                                <th scope="col" class="p-6 font-black text-slate-900 uppercase text-xs tracking-widest">Usługa</th>
                                <th scope="col" class="p-6 font-black text-slate-900 uppercase text-xs tracking-widest text-right">Cena od</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-emerald-50/30 transition">
                                <td class="p-6 font-bold text-slate-700">Konsultacja weterynaryjna</td>
                                <td class="p-6 text-right font-black text-emerald-600 text-xl">120 zł</td>
                            </tr>
                            <tr class="hover:bg-emerald-50/30 transition">
                                <td class="p-6 font-bold text-slate-700">Szczepienie kompleksowe</td>
                                <td class="p-6 text-right font-black text-emerald-600 text-xl">150 zł</td>
                            </tr>
                            <tr class="hover:bg-emerald-50/30 transition">
                                <td class="p-6 font-bold text-slate-700">Badanie krwi (profil rozszerzony)</td>
                                <td class="p-6 text-right font-black text-emerald-600 text-xl">200 zł</td>
                            </tr>
                            <tr class="hover:bg-emerald-50/30 transition">
                                <td class="p-6 font-bold text-slate-700">USG jamy brzusznej</td>
                                <td class="p-6 text-right font-black text-emerald-600 text-xl">180 zł</td>
                            </tr>
                            <tr class="hover:bg-emerald-50/30 transition">
                                <td class="p-6 font-bold text-slate-700">Kastracja / Sterylizacja</td>
                                <td class="p-6 text-right font-black text-emerald-600 text-xl">450 zł</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-900 py-16 text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpg') }}" alt="MediPet Logo" class="w-8 h-8 rounded-lg object-cover" aria-hidden="true">
                    <span class="text-xl font-bold">MediPet</span>
                </div>
                <p class="text-slate-400 text-sm">
                    &copy; MediPet {{ date('Y') }}
                </p>
                <div class="flex gap-6 text-slate-400 text-sm">
                    <p>Zuzanna Orzechowska</p>
                    <p>21284</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>