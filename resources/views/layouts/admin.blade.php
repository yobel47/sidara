<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Admin' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
    [x-cloak] {
        display: none !important;
    }
    </style>
</head>

<body class="h-full bg-gray-50" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- Top nav --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 shrink-0 rounded-full overflow-hidden">
                    <img src="{{ asset('icon-500x500.png') }}" alt="Logo">
                </div>
                <div>
                    <p class="text-sm font-extrabold text-gray-800 leading-none">SI DARA</p>
                    <p class="text-xs text-gray-400 leading-none mt-0.5">Admin Panel</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 hidden sm:block">{{ auth()->user()->name }}</span>
                <a href="{{ route('logout') }}"
                    class="text-sm font-semibold text-gray-500 hover:text-rose-500 transition-colors">
                    Keluar
                </a>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="max-w-screen-xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>