<div class="flex flex-col min-h-full">

    {{-- ══════════════════════════════════════════════════════
         HERO SECTION
         Mobile  : hero kecil, ilustrasi di kanan, no stats
         Desktop : hero besar full-width, ada stats row, gradient lebih dramatis
    ══════════════════════════════════════════════════════ --}}
    <div class="relative overflow-hidden
                px-5 pt-12 pb-5
                lg:px-10 lg:pt-10 lg:pb-10
                bg-gradient-to-br from-pink-400 via-rose-400 to-pink-500
                lg:rounded-none">

        {{-- Dekorasi blob --}}
        <div class="absolute -top-10 -right-10 w-52 h-52
                    lg:w-80 lg:h-80
                    bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/3 w-36 h-36
                    bg-pink-300/20 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative flex items-start justify-between
                    lg:items-center">

            {{-- Teks + stats --}}
            <div class="flex-1">
                <p class="text-[10px] lg:text-xs font-bold tracking-widest
                           text-pink-100 uppercase mb-1 lg:mb-2">
                    Selamat datang
                </p>

                <h1 class="text-2xl lg:text-4xl font-extrabold text-white
                           leading-tight mb-2 lg:mb-3">
                    Hallo, {{ $userName }} 👋
                </h1>

                <p class="text-sm lg:text-base text-pink-100 leading-relaxed
                           max-w-[190px] lg:max-w-md mb-0 lg:mb-6">
                    Jaga kesehatanmu dan calon buah hatimu ya!
                </p>

                {{-- Stats row: hanya desktop --}}
                <div class="hidden lg:flex gap-3 mt-6">
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl px-5 py-3 text-center border border-white/20">
                        <p class="text-white font-extrabold text-xl">{{ $pregnancyWeek ?? '—' }}</p>
                        <p class="text-pink-100 text-xs mt-0.5">Minggu Kehamilan</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl px-5 py-3 text-center border border-white/20">
                        <p class="text-white font-extrabold text-xl">{{ $ancVisitCount ?? '0' }}</p>
                        <p class="text-pink-100 text-xs mt-0.5">Kunjungan ANC</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl px-5 py-3 text-center border border-white/20">
                        <p class="text-white font-extrabold text-xl">{{ $nextVisitDate ?? '—' }}</p>
                        <p class="text-pink-100 text-xs mt-0.5">Kontrol Berikutnya</p>
                    </div>
                </div>
            </div>

            {{-- Kanan: notif (mobile) + ilustrasi --}}
            <div class="flex flex-col items-end gap-3 lg:gap-0">

                {{-- Notif bell: hanya mobile (desktop ada di top header) --}}
                <button
                    wire:click="goToNotifications"
                    class="relative p-2.5 bg-white/20 backdrop-blur-sm
                           border border-white/30 rounded-2xl
                           active:scale-95 transition-transform
                           lg:hidden"
                    aria-label="Notifikasi"
                >
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                    </svg>
                    @if($notifCount > 0)
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-white text-rose-500
                                  text-[9px] font-extrabold rounded-full
                                  flex items-center justify-center">
                        {{ $notifCount > 9 ? '9+' : $notifCount }}
                    </span>
                    @endif
                </button>

                {{-- Ilustrasi ibu hamil --}}
                <div class="w-28 h-28 lg:w-44 lg:h-44 flex items-end justify-center">
                    <img
                        src="{{ asset('images/ilustrasi-ibu.png') }}"
                        alt="Ilustrasi ibu hamil"
                        class="h-full w-full object-contain drop-shadow-lg"
                    />
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════
         MENU GRID
         Mobile  : 3 kolom baris 1 + 2 kolom baris 2
         Desktop : 5 kolom satu baris
    ══════════════════════════════════════════════════════ --}}
    <div class="flex-1 px-4 pt-5 pb-4
                lg:px-10 lg:pt-8 lg:pb-0
                bg-pink-50 lg:bg-transparent">

        <h2 class="text-[10px] lg:text-xs font-bold tracking-widest
                   text-gray-400 uppercase mb-3 lg:mb-5 px-1">
            Menu Utama
        </h2>

        {{--
            Grid responsif:
            - Mobile  : 3 kolom, kartu ke-4 dan ke-5 dipindah ke baris 2 (2 kolom)
            - Desktop : 5 kolom semua sejajar
            Trik: di mobile baris kedua pakai grid tersendiri,
                  di desktop semua jadi satu grid 5 kolom.
        --}}

        {{-- Desktop: satu grid 5 kolom --}}
        <div class="hidden lg:grid lg:grid-cols-5 lg:gap-5">
            @include('livewire.partials._menu-card', [
                'route'     => 'skrining-awal',
                'icon'      => 'skrining',
                'iconBg'    => 'bg-rose-50 group-hover:bg-rose-100',
                'title'     => 'Skrining Awal',
                'desc'      => 'Pemeriksaan awal untuk mengetahui risiko anemia.',
            ])
            @include('livewire.partials._menu-card', [
                'route'     => 'kehamilan',
                'icon'      => 'kehamilan',
                'iconBg'    => 'bg-purple-50 group-hover:bg-purple-100',
                'title'     => 'Kehamilan',
                'desc'      => 'Catat setiap kunjungan ANC dan perkembangan kehamilan.',
            ])
            @include('livewire.partials._menu-card', [
                'route'     => 'persalinan',
                'icon'      => 'persalinan',
                'iconBg'    => 'bg-pink-50 group-hover:bg-pink-100',
                'title'     => 'Persalinan',
                'desc'      => 'Catat data persalinan dan kondisi ibu saat melahirkan.',
            ])
            @include('livewire.partials._menu-card', [
                'route'     => 'data-bayi',
                'icon'      => 'bayi',
                'iconBg'    => 'bg-orange-50 group-hover:bg-orange-100',
                'title'     => 'Data Bayi',
                'desc'      => 'Catat identitas dan data bayi baru lahir secara lengkap.',
            ])
            @include('livewire.partials._menu-card', [
                'route'     => 'rekam-medis',
                'icon'      => 'rekam-medis',
                'iconBg'    => 'bg-teal-50 group-hover:bg-teal-100',
                'title'     => 'Rekam Medis',
                'desc'      => 'Lihat ringkasan seluruh rekam medis dari awal hingga data bayi.',
            ])
        </div>

        {{-- Mobile: baris 1 (3 kolom) + baris 2 (2 kolom) --}}
        <div class="lg:hidden space-y-3">
            <div class="grid grid-cols-3 gap-3">
                @include('livewire.partials._menu-card', [
                    'route'  => 'skrining-awal',
                    'icon'   => 'skrining',
                    'iconBg' => 'bg-rose-50 group-active:bg-rose-100',
                    'title'  => 'Skrining Awal',
                    'desc'   => 'Pemeriksaan awal untuk mengetahui risiko anemia.',
                ])
                @include('livewire.partials._menu-card', [
                    'route'  => 'kehamilan',
                    'icon'   => 'kehamilan',
                    'iconBg' => 'bg-purple-50 group-active:bg-purple-100',
                    'title'  => 'Kehamilan',
                    'desc'   => 'Catat setiap kunjungan ANC dan perkembangan kehamilan.',
                ])
                @include('livewire.partials._menu-card', [
                    'route'  => 'persalinan',
                    'icon'   => 'persalinan',
                    'iconBg' => 'bg-pink-50 group-active:bg-pink-100',
                    'title'  => 'Persalinan',
                    'desc'   => 'Catat data persalinan dan kondisi ibu saat melahirkan.',
                ])
            </div>
            <div class="grid grid-cols-2 gap-3">
                @include('livewire.partials._menu-card', [
                    'route'  => 'data-bayi',
                    'icon'   => 'bayi',
                    'iconBg' => 'bg-orange-50 group-active:bg-orange-100',
                    'title'  => 'Data Bayi',
                    'desc'   => 'Catat identitas dan data bayi baru lahir secara lengkap.',
                ])
                @include('livewire.partials._menu-card', [
                    'route'  => 'rekam-medis',
                    'icon'   => 'rekam-medis',
                    'iconBg' => 'bg-teal-50 group-active:bg-teal-100',
                    'title'  => 'Rekam Medis',
                    'desc'   => 'Lihat ringkasan seluruh rekam medis dari awal hingga data bayi.',
                ])
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════════════════════════════
         SECTION BAWAH — hanya desktop
         Kunjungan terakhir + Tips harian
    ══════════════════════════════════════════════════════ --}}
    <div class="hidden lg:grid lg:grid-cols-2 lg:gap-6
                lg:px-10 lg:py-8">

        {{-- Kunjungan ANC terakhir --}}
        <div class="bg-white rounded-3xl p-6 border border-pink-100 shadow-sm">
            <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-pink-400 inline-block"></span>
                Kunjungan ANC Terakhir
            </h3>

            @if($lastAncVisit)
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-pink-50 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $lastAncVisit['date'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $lastAncVisit['bidan'] }} · {{ $lastAncVisit['puskesmas'] }}
                    </p>
                </div>
            </div>
            @else
            <div class="flex flex-col items-center py-6 text-gray-300">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75"/>
                </svg>
                <p class="text-sm">Belum ada data kunjungan</p>
            </div>
            @endif
        </div>

        {{-- Tips harian --}}
        <div class="bg-gradient-to-br from-purple-50 to-pink-50
                    rounded-3xl p-6 border border-purple-100">
            <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-purple-400 inline-block"></span>
                Tips Hari Ini
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                {{ $dailyTip ?? 'Konsumsi makanan kaya zat besi seperti bayam, kacang-kacangan, dan daging merah untuk mencegah anemia selama kehamilan.' }}
            </p>
            <span class="inline-flex items-center gap-1.5 mt-4
                          text-xs font-semibold text-purple-600
                          bg-purple-100 px-3 py-1.5 rounded-full">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5z" clip-rule="evenodd"/>
                </svg>
                Kesehatan Ibu
            </span>
        </div>

    </div>

</div>