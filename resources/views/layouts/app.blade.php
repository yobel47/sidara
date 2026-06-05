<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#ec4899">
    <meta name="mobile-web-app-capable" content="yes">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="manifest" href="/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full bg-pink-50" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="flex flex-col lg:flex-row min-h-screen">

        {{-- SIDEBAR — desktop only --}}
        <aside class="hidden lg:flex lg:flex-col lg:w-64 lg:shrink-0 bg-white border-r border-pink-100 min-h-screen sticky top-0">
            @livewire('layout.sidebar')
        </aside>

        {{-- MAIN AREA --}}
        <div class="flex flex-col flex-1 min-h-screen">

            {{-- Top header — desktop only --}}
            <header class="hidden lg:flex items-center justify-between px-8 py-4 bg-white border-b border-pink-100 sticky top-0 z-30">
                <h1 class="text-base font-extrabold text-gray-800">{{ $pageTitle ?? 'Beranda' }}</h1>
            </header>

            {{-- Page content --}}
            {{-- 
                padding-bottom mobile: tinggi bottom nav (64px) + safe area
                padding-bottom desktop: 0
            --}}
            <main class="flex-1" style="padding-bottom: calc(64px + env(safe-area-inset-bottom, 0px));" 
                  class="lg:pb-0">
                {{ $slot }}
            </main>

        </div>

        {{-- BOTTOM NAV — mobile only --}}
        @livewire('layout.bottom-nav')

    </div>

    @livewireScripts
</body>
</html>