<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    {{-- SEO Primary --}}
    <title>SIDARA — Sistem Deteksi Anemia Remaja</title>
    <meta name="description"
        content="SIDARA adalah aplikasi kesehatan digital untuk deteksi dini anemia pada remaja dan ibu hamil. Pantau hemoglobin, kunjungan ANC, data persalinan, dan tumbuh kembang bayi dalam satu platform.">
    <meta name="keywords"
        content="anemia remaja, deteksi anemia dini, sistem deteksi anemia, aplikasi kesehatan ibu hamil, ANC kunjungan antenatal, hemoglobin rendah, skrining anemia, kesehatan ibu, SIDARA">
    <meta name="author" content="SIDARA">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="SIDARA — Sistem Deteksi Anemia Remaja">
    <meta property="og:description"
        content="Deteksi dini anemia, pantau kunjungan ANC, dan catat riwayat persalinan dalam satu aplikasi kesehatan digital. Gratis untuk semua ibu hamil dan remaja.">
    <meta property="og:image" content="{{ url('/icon-500x500.png') }}">
    <meta property="og:image:width" content="500">
    <meta property="og:image:height" content="500">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="SIDARA">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SIDARA — Sistem Deteksi Anemia Remaja">
    <meta name="twitter:description"
        content="Deteksi dini anemia, pantau kehamilan, dan catat riwayat persalinan dalam satu aplikasi kesehatan digital.">
    <meta name="twitter:image" content="{{ url('/icon-500x500.png') }}">

    {{-- PWA & Icons --}}
    <link rel="icon" type="image/png" href="/ico-browser.png">
    <link rel="apple-touch-icon" href="/icon-192x192.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#ec4899">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-status-bar-style" content="default">
    <meta name="mobile-web-app-title" content="SIDARA">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">@php echo json_encode(['@context'=>'https://schema.org','@type'=>'SoftwareApplication','name'=>'SIDARA','alternateName'=>'Sistem Deteksi Anemia Remaja','description'=>'Aplikasi kesehatan digital untuk deteksi dini anemia pada remaja dan ibu hamil. Fitur skrining anemia, kunjungan ANC, rekam persalinan, dan data bayi.','url'=>url('/'), 'applicationCategory'=>'HealthApplication','operatingSystem'=>'Web, Android, iOS','inLanguage'=>'id','offers'=>['@type'=>'Offer','price'=>'0','priceCurrency'=>'IDR'],'featureList'=>['Skrining deteksi anemia','Kunjungan Antenatal Care (ANC)','Rekam medis persalinan','Data bayi baru lahir','Rekam medis lengkap']], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); @endphp</script>

</head>

<body class="bg-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{ $slot }}

    @livewireScripts
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js').catch(() => {});
        });
    }
    </script>
</body>

</html>
