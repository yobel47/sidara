<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#ec4899">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="manifest" href="/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full bg-pink-50 font-jakarta antialiased">

    {{--
        SHELL UTAMA
        - Mobile  : flex-col, sidebar hidden, bottom-nav visible
        - Desktop : flex-row, sidebar visible, bottom-nav hidden
    --}}
    <div class="flex flex-col lg:flex-row min-h-screen">

        {{-- ── SIDEBAR (desktop only) ────────────────────────── --}}
        <aside class="hidden lg:flex lg:flex-col lg:w-64 lg:shrink-0
                       bg-white border-r border-pink-100 min-h-screen sticky top-0">
            @livewire('layout.sidebar')
        </aside>

        {{-- ── AREA TENGAH: header + konten ─────────────────── --}}
        <div class="flex flex-col flex-1 min-h-screen">

            {{-- Top header (desktop only — di mobile sudah ada di dalam page) --}}
            <header class="hidden lg:flex items-center justify-between
                           px-8 py-4 bg-white border-b border-pink-100 sticky top-0 z-30">
                <h1 class="text-base font-extrabold text-gray-800">{{ $pageTitle ?? 'Beranda' }}</h1>
                <div class="flex items-center gap-3">
                </div>
            </header>

            {{-- Konten halaman --}}
            <main class="flex-1 overflow-y-auto
                         pb-[calc(5rem+env(safe-area-inset-bottom))]
                         lg:pb-0">
                {{ $slot }}
            </main>

        </div>

        {{-- ── BOTTOM NAV (mobile only) ──────────────────────── --}}
        <nav class="lg:hidden fixed bottom-0 inset-x-0 z-50
                    bg-white border-t border-pink-100
                    flex items-stretch
                    h-[calc(5rem+env(safe-area-inset-bottom,0px))]">
            @livewire('layout.bottom-nav')
        </nav>

    </div>

    @livewireScripts
    <script src="/js/sw-register.js"></script>
</body>
</html>