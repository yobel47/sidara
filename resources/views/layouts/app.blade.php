<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#ec4899">
    <meta name="mobile-web-app-capable" content="yes">
    <title>{{ $pageTitle }}</title>
    <link rel="manifest" href="/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="h-full bg-pink-50" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="flex flex-col lg:flex-row min-h-screen">

        {{-- SIDEBAR — desktop only --}}
        <aside
            class="hidden lg:flex lg:flex-col lg:w-64 lg:shrink-0 bg-white border-r border-pink-100 min-h-screen sticky top-0">
            @livewire('layout.sidebar')
        </aside>

        <div class="flex flex-col flex-1 min-h-screen">

            {{-- TOP HEADER — desktop only --}}
            <header
                class="hidden lg:flex items-center justify-between px-8 py-4 bg-white border-b border-pink-100 sticky top-0 z-30">
                <div class="flex items-center gap-3">
                    {{-- Back button — hanya tampil kalau $showBack = true --}}
                    @if(isset($showBack) && $showBack)
                    <a href="{{ $backRoute ?? 'javascript:history.back()' }}" wire:navigate
                        class="p-1.5 rounded-xl hover:bg-pink-50 text-gray-500 hover:text-rose-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    @endif
                    <h1 class="text-base font-extrabold text-gray-800">{{ $pageTitle ?? 'Beranda' }}</h1>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            {{--
                Mobile: padding-bottom = tinggi bottom nav (64px) + safe area
                Desktop: tidak perlu padding-bottom
            --}}
            <main class="flex-1 flex flex-col overflow-y-auto lg:!pb-0"
                style="padding-bottom: calc(64px + env(safe-area-inset-bottom, 0px));">
                {{ $slot }}
            </main>

        </div>

        {{-- BOTTOM NAV — mobile only --}}
        @livewire('layout.bottom-nav')

    </div>

    {{-- Toast global --}}
    <div x-data="{
            show: false,
            message: '',
            timer: null,
            fire(msg) {
                this.message = msg;
                this.show = true;
                clearTimeout(this.timer);
                this.timer = setTimeout(() => this.show = false, 5000);
            }
        }" @toast.window="fire($event.detail.message)"
        x-init="@if(session('toast'))fire(@js(session('toast')))@endif"
        x-show="show"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed left-1/2 -translate-x-1/2 z-50 lg:bottom-6 "
        style="bottom: calc(64px + 12px + env(safe-area-inset-bottom, 0px))">
        <div class="flex items-center gap-2  bg-white  text-sm px-4 py-3 rounded-2xl shadow-lg whitespace-nowrap">
            <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            <span x-text="message"></span>
        </div>
    </div>

    @livewireScripts
</body>

</html>