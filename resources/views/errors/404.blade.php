<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#ec4899">
    <title>Halaman Tidak Ditemukan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>

<body class="h-full bg-pink-50" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="min-h-screen flex flex-col items-center justify-center px-8">

        {{-- Icon --}}
        <div class="w-16 h-16 rounded-2xl bg-white shadow-md shadow-rose-100 flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-rose-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0Z" />
            </svg>
        </div>

        {{-- Text --}}
        <h1 class="text-xl font-extrabold text-gray-800 text-center mb-2">Halaman Tidak Ditemukan</h1>
        <p class="text-sm text-gray-400 text-center leading-relaxed mb-8 max-w-xs">
            Halaman yang kamu cari tidak ada atau sudah dipindahkan.
        </p>

        {{-- Button --}}
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl
                   bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                   text-white font-bold text-sm tracking-wide
                   shadow-lg shadow-rose-200 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Beranda
        </a>

    </div>

</body>

</html>