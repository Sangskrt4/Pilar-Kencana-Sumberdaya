<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PT Pilar Kencana Sumberdaya') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="antialiased text-gray-800 bg-gray-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-800 relative overflow-hidden">
            
            <!-- Aksen Garis Emas biar senada sama Karir -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-400 via-yellow-500 to-orange-400"></div>

            <!-- Logo Kustom -->
            <div class="mb-6 text-center">
                <a href="/" class="flex flex-col items-center gap-2 hover:opacity-80 transition">
                    <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-16 w-auto object-contain bg-white p-2 rounded-full shadow-lg">
                    <div class="flex flex-col mt-2">
                        <span class="font-extrabold text-lg tracking-wide text-white uppercase">Pilar Kencana</span>
                        <span class="font-semibold text-[10px] tracking-widest text-orange-400 uppercase text-center">Sumberdaya</span>
                    </div>
                </a>
            </div>

            <!-- Kotak Form -->
            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-lg border-t-4 border-blue-500">
                {{ $slot }}
            </div>
            
            <!-- Footer mini -->
            <div class="mt-8 text-xs text-slate-400 font-light">
                &copy; {{ date('Y') }} PT Pilar Kencana Sumberdaya. All rights reserved.
            </div>
        </div>
    </body>
</html>