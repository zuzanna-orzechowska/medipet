<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            html { font-size: 16px; transition: font-size 0.2s; } 
            html.font-lg { font-size: 19px; }
            html.font-xl { font-size: 22px; }
            html.high-contrast {
                filter: invert(100%) hue-rotate(180deg) brightness(1.1) !important;
                background-color: #000 !important;
            }
            html.high-contrast img, 
            html.high-contrast svg,
            html.high-contrast .no-invert {
                filter: invert(100%) hue-rotate(180deg) !important;
            }
        </style>
        
    </head>
    <body class="font-sans antialiased">
       
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            function applySavedSettings() {
                const html = document.documentElement;
                const contrast = localStorage.getItem('medipet-contrast');
                const fontSize = localStorage.getItem('medipet-font-size');

                if (contrast === 'true') {
                    html.classList.add('high-contrast');
                }

                html.classList.remove('font-lg', 'font-xl');
                if (fontSize === 'lg') html.classList.add('font-lg');
                if (fontSize === 'xl') html.classList.add('font-xl');
            }

            function toggleGlobalContrast() {
                const html = document.documentElement;
                html.classList.toggle('high-contrast');
                localStorage.setItem('medipet-contrast', html.classList.contains('high-contrast'));
            }

            function updateGlobalFontSize(size) {
                const html = document.documentElement;
                html.classList.remove('font-lg', 'font-xl');
                
                if (size === 'lg') html.classList.add('font-lg');
                if (size === 'xl') html.classList.add('font-xl');
                
                localStorage.setItem('medipet-font-size', size);
            }

            document.addEventListener('DOMContentLoaded', applySavedSettings);
        </script>
    </body>
</html>
