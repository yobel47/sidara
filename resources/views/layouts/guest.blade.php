<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#ec4899">
    <meta name="mobile-web-app-capable" content="yes">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full bg-pink-50" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{--
        Layout guest: tidak ada sidebar/bottom nav.
        Mobile  : full screen
        Desktop : konten di tengah, max-w-sm, dikasih card putih
    --}}
    <div class="min-h-screen flex items-center justify-center
                bg-pink-50 lg:bg-gradient-to-br lg:from-pink-100 lg:via-rose-50 lg:to-pink-100
                px-0 lg:px-4">

        {{-- Wrapper — mobile full width, desktop card --}}
        <div class="w-full lg:max-w-sm
                    bg-pink-50 lg:bg-white
                    min-h-screen lg:min-h-0
                    lg:rounded-3xl lg:shadow-xl lg:shadow-pink-200/40
                    lg:border lg:border-pink-100
                    overflow-hidden">
            {{ $slot }}
        </div>

    </div>

    @livewireScripts
</body>
</html>