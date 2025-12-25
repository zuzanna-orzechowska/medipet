<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediPet | Profesjonalna Klinika Weterynaryjna</title>

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
    </style>
</head>
<body class="gradient-mesh text-slate-900 antialiased">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-emerald-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight text-emerald-900">Medi<span class="text-emerald-500">Pet</span></span>
                </div>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#o-nas" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition">O nas</a>
                    <a href="#uslugi" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition">Usługi</a>
                    <div class="h-6 w-px bg-slate-200"></div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-emerald-600 text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-md hover:bg-emerald-700 hover:shadow-emerald-200 transition-all focus:ring-4 focus:ring-emerald-100">
                                Panel klienta
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-900 transition">Logowanie</a>
                            <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-md hover:bg-emerald-700 hover:shadow-emerald-200 transition-all">
                                Załóż konto
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        <section class="relative pt-12 pb-20 lg:pt-24 lg:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
                    
                    <div class="lg:col-span-6 text-center lg:text-left">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-widest mb-6">
                            Klinika Weterynaryjna 2.0
                        </span>
                        <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-8">
                            Zdrowie Twojego przyjaciela w <span class="text-emerald-600 italic">dobrych</span> rękach.
                        </h1>
                        <p class="text-lg text-slate-600 leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0">
                            W MediPet łączymy pasję do zwierząt z najnowszą technologią medyczną. Zadbaj o profilaktykę swojego pupila z najlepszymi specjalistami w mieście.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all">
                                Umów wizytę online
                            </a>
                            <a href="#uslugi" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold text-lg hover:bg-slate-50 transition-all">
                                Sprawdź cennik
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-6 mt-16 lg:mt-0 relative">
                        <div class="absolute -top-12 -right-12 w-64 h-64 bg-emerald-100 rounded-full blur-3xl opacity-50"></div>
                        
                        <div class="relative bg-emerald-50 border-2 border-white rounded-[2rem] aspect-square overflow-hidden shadow-2xl flex items-center justify-center group">
                            <div class="absolute inset-0 bg-gradient-to-tr from-emerald-600/10 to-transparent"></div>
                            <svg class="w-24 h-24 text-emerald-200 group-hover:scale-110 transition-transform duration-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5-9h10v2H7z"/>
                            </svg>
                            <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur p-4 rounded-xl shadow-lg border border-emerald-50">
                                <p class="text-xs font-bold text-emerald-800 uppercase tracking-widest mb-1">Dostępni lekarze</p>
                                <p class="text-sm text-slate-600 italic">"Zapewniamy opiekę 24/7 dla nagłych przypadków."</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="uslugi" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-20">
                    <h2 class="text-3xl lg:text-5xl font-extrabold text-slate-900 mb-6">Dlaczego warto nam zaufać?</h2>
                    <p class="text-slate-500 text-lg">MediPet to nie tylko klinika, to standard opieki, na jaki zasługuje Twoje zwierzę.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group p-10 bg-emerald-50 rounded-[2.5rem] border border-transparent hover:border-emerald-200 hover:bg-white transition-all duration-300">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-8 group-hover:rotate-6 transition-transform">
                            <span class="text-3xl">📅</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Szybkie Terminy</h3>
                        <p class="text-slate-600 leading-relaxed">System rezerwacji online pozwala na natychmiastowe umówienie wizyty bez czekania na linii.</p>
                    </div>

                    <div class="group p-10 bg-emerald-50 rounded-[2.5rem] border border-transparent hover:border-emerald-200 hover:bg-white transition-all duration-300">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-8 group-hover:rotate-6 transition-transform">
                            <span class="text-3xl">👨‍⚕️</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Ekspercka Wiedza</h3>
                        <p class="text-slate-600 leading-relaxed">Nasi lekarze to certyfikowani specjaliści z wieloletnim doświadczeniem w chirurgii i diagnostyce.</p>
                    </div>

                    <div class="group p-10 bg-emerald-50 rounded-[2.5rem] border border-transparent hover:border-emerald-200 hover:bg-white transition-all duration-300">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-8 group-hover:rotate-6 transition-transform">
                            <span class="text-3xl">📂</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Pełna Historia</h3>
                        <p class="text-slate-600 leading-relaxed">W panelu klienta masz dostęp do pełnej historii leczenia, wyników badań i zaleceń po wizycie.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-900 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">MediPet</span>
                </div>
                <p class="text-slate-400 text-sm">
                    &copy; 2025 MediPet Clinic. Projekt akademicki Laravel.
                </p>
                <div class="flex gap-6 text-slate-400 text-sm">
                    <a href="#" class="hover:text-emerald-400">Polityka prywatności</a>
                    <a href="#" class="hover:text-emerald-400">Kontakt</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>