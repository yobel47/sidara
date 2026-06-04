{{-- resources/views/livewire/pages/home.blade.php --}}

<div class="flex flex-col min-h-full">

    {{-- ══════════════════════════════════════
         HERO
    ══════════════════════════════════════ --}}
    <div class="relative overflow-hidden bg-pink-50 px-5 pt-10 pb-4 lg:px-10 lg:pt-10 lg:pb-10">

        {{-- Blob dekorasi --}}
        <div class="absolute top-0 right-0 w-48 h-48 rounded-full opacity-40 pointer-events-none"
             style="background: radial-gradient(circle, #fda4af, transparent); filter: blur(40px); transform: translate(20%, -20%)"></div>
        <div class="absolute bottom-0 right-16 w-32 h-32 rounded-full opacity-30 pointer-events-none"
             style="background: radial-gradient(circle, #f9a8d4, transparent); filter: blur(30px);"></div>

        <div class="relative flex items-start justify-between">

            {{-- Kiri: teks --}}
            <div class="flex-1 pt-1">
                {{-- Label halaman — warna rose seperti desain --}}
                <p class="text-lg font-extrabold text-rose-400 mb-3 lg:text-2xl">Beranda</p>

                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight mb-2 lg:text-4xl">
                    Hallo, {{ $userName }} 👋
                </h1>
                <p class="text-sm text-gray-500 leading-relaxed max-w-[180px] lg:max-w-sm lg:text-base">
                    Jaga kesehatanmu dan calon buah hatimu ya!
                </p>
            </div>

            {{-- Kanan: notif + ilustrasi --}}
            <div class="flex flex-col items-end gap-2">

                {{-- Notif bell —  mobile only --}}
                <button wire:click="goToNotifications"
                        class="lg:hidden relative p-2.5 bg-white rounded-2xl shadow-sm border border-pink-100">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                    </svg>
                    @if($notifCount > 0)
                    <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] bg-rose-500 text-white
                                 text-[9px] font-extrabold rounded-full flex items-center justify-center px-1">
                        {{ $notifCount > 9 ? '9+' : $notifCount }}
                    </span>
                    @endif
                </button>

                {{-- Ilustrasi ibu hamil — inline SVG --}}
                <div class="w-32 h-36 lg:w-52 lg:h-52">
                    <svg viewBox="0 0 160 180" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <!-- background circle blob -->
                        <circle cx="110" cy="70" r="55" fill="#fce7f3" opacity="0.6"/>
                        <circle cx="125" cy="130" r="20" fill="#fce7f3" opacity="0.5"/>
                        <!-- rambut belakang kiri -->
                        <path d="M55 55 Q40 80 42 120 Q44 135 52 138" stroke="#1a0a00" stroke-width="14" fill="none" stroke-linecap="round"/>
                        <!-- rambut belakang kanan -->
                        <path d="M105 55 Q120 80 118 120 Q116 135 108 138" stroke="#1a0a00" stroke-width="14" fill="none" stroke-linecap="round"/>
                        <!-- rambut atas -->
                        <ellipse cx="80" cy="38" rx="30" ry="32" fill="#1a0a00"/>
                        <!-- wajah -->
                        <ellipse cx="80" cy="46" rx="23" ry="26" fill="#f8c8a0"/>
                        <!-- mata kiri -->
                        <ellipse cx="71" cy="43" rx="3" ry="3.5" fill="#1a0a00"/>
                        <ellipse cx="70.5" cy="42" rx="1" ry="1" fill="white" opacity="0.6"/>
                        <!-- mata kanan -->
                        <ellipse cx="89" cy="43" rx="3" ry="3.5" fill="#1a0a00"/>
                        <ellipse cx="88.5" cy="42" rx="1" ry="1" fill="white" opacity="0.6"/>
                        <!-- alis -->
                        <path d="M67 38 Q71 36 75 38" stroke="#5a3010" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <path d="M85 38 Q89 36 93 38" stroke="#5a3010" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <!-- hidung -->
                        <path d="M79 48 Q80 51 81 48" stroke="#c8956a" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                        <!-- senyum -->
                        <path d="M72 54 Q80 60 88 54" stroke="#c8704a" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                        <!-- pipi -->
                        <circle cx="65" cy="52" r="5" fill="#fda4af" opacity="0.5"/>
                        <circle cx="95" cy="52" r="5" fill="#fda4af" opacity="0.5"/>
                        <!-- leher -->
                        <rect x="73" y="68" width="14" height="12" rx="4" fill="#f8c8a0"/>
                        <!-- baju / badan -->
                        <path d="M50 82 Q44 105 46 148 Q48 160 80 160 Q112 160 114 148 Q116 105 110 82 Q102 76 80 76 Q58 76 50 82Z" fill="#ec4899"/>
                        <!-- perut bulat -->
                        <ellipse cx="80" cy="128" rx="26" ry="24" fill="#f472b6" opacity="0.7"/>
                        <!-- highlight perut -->
                        <ellipse cx="74" cy="122" rx="8" ry="6" fill="white" opacity="0.15"/>
                        <!-- tangan kiri -->
                        <path d="M50 90 Q32 100 30 118 Q30 126 38 126" stroke="#ec4899" stroke-width="14" fill="none" stroke-linecap="round"/>
                        <ellipse cx="36" cy="128" rx="8" ry="7" fill="#f8c8a0"/>
                        <!-- tangan kanan -->
                        <path d="M110 90 Q128 100 130 118 Q130 126 122 126" stroke="#ec4899" stroke-width="14" fill="none" stroke-linecap="round"/>
                        <ellipse cx="124" cy="128" rx="8" ry="7" fill="#f8c8a0"/>
                        <!-- hati kecil dekorasi -->
                        <path d="M118 60 Q120 57 122.5 59 Q125 57 127 60 Q127 63 122.5 66 Q118 63 118 60Z" fill="#fda4af"/>
                        <path d="M30 85 Q32 82 34.5 84 Q37 82 39 85 Q39 88 34.5 91 Q30 88 30 85Z" fill="#fda4af" opacity="0.7"/>
                    </svg>
                </div>

            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════
         MENU GRID
    ══════════════════════════════════════ --}}
    <div class="flex-1 bg-pink-50 px-4 pt-5 pb-4 lg:px-10 lg:pt-8">

        <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-4 lg:text-xs lg:mb-5">
            Menu Utama
        </p>

        {{-- Baris 1: 3 kartu --}}
        <div class="grid grid-cols-3 lg:grid-cols-5 gap-3 mb-3 lg:mb-0">

            {{-- Skrining Awal --}}
            <button wire:click="navigate('skrining-awal')"
                    class="bg-white rounded-2xl p-3 lg:p-5 flex flex-col items-center text-center
                           shadow-sm border border-pink-50 active:scale-95 lg:hover:shadow-md
                           transition-all duration-150 w-full">
                <div class="w-14 h-14 lg:w-16 lg:h-16 rounded-2xl bg-rose-50 flex items-center justify-center mb-2 lg:mb-3">
                    <svg viewBox="0 0 56 56" class="w-10 h-10 lg:w-12 lg:h-12" fill="none">
                        <!-- tetesan darah -->
                        <path d="M24 8 C24 8 14 20 14 28 C14 34.627 18.477 40 24 40 C29.523 40 34 34.627 34 28 C34 20 24 8 24 8Z" fill="#fda4af"/>
                        <path d="M24 8 C24 8 14 20 14 28 C14 34.627 18.477 40 24 40 C29.523 40 34 34.627 34 28 C34 20 24 8 24 8Z" stroke="#f43f5e" stroke-width="1.5"/>
                        <!-- kaca pembesar -->
                        <circle cx="36" cy="38" r="10" fill="white" stroke="#f43f5e" stroke-width="2"/>
                        <circle cx="36" cy="38" r="6" fill="#fee2e2"/>
                        <line x1="43" y1="45" x2="49" y2="51" stroke="#f43f5e" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-800 leading-tight mb-1 lg:text-sm">Skrining Awal</span>
                <span class="text-[9px] lg:text-xs text-gray-400 leading-relaxed">Pemeriksaan awal untuk mengetahui risiko anemia.</span>
            </button>

            {{-- Kehamilan --}}
            <button wire:click="navigate('kehamilan')"
                    class="bg-white rounded-2xl p-3 lg:p-5 flex flex-col items-center text-center
                           shadow-sm border border-pink-50 active:scale-95 lg:hover:shadow-md
                           transition-all duration-150 w-full">
                <div class="w-14 h-14 lg:w-16 lg:h-16 rounded-full bg-purple-100 flex items-center justify-center mb-2 lg:mb-3">
                    <svg viewBox="0 0 56 56" class="w-10 h-10 lg:w-12 lg:h-12" fill="none">
                        <!-- siluet ibu hamil -->
                        <circle cx="28" cy="16" r="7" fill="#a855f7" opacity="0.8"/>
                        <path d="M18 28 C18 22 22 20 28 20 C34 20 38 22 38 28 L38 36 C38 40 34 44 28 44 C22 44 18 40 18 36 Z" fill="#a855f7" opacity="0.7"/>
                        <!-- perut bulat -->
                        <ellipse cx="28" cy="34" rx="10" ry="9" fill="#c084fc" opacity="0.6"/>
                        <!-- hati di perut -->
                        <path d="M25 32 C25 30.5 26.5 29.5 28 31 C29.5 29.5 31 30.5 31 32 C31 33.5 28 36 28 36 C28 36 25 33.5 25 32Z" fill="white" opacity="0.9"/>
                        <!-- tangan kiri -->
                        <path d="M18 28 Q12 30 12 36" stroke="#a855f7" stroke-width="4" fill="none" stroke-linecap="round"/>
                        <!-- tangan kanan -->
                        <path d="M38 28 Q44 30 44 36" stroke="#a855f7" stroke-width="4" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-800 leading-tight mb-1 lg:text-sm">Kehamilan</span>
                <span class="text-[9px] lg:text-xs text-gray-400 leading-relaxed">Catat setiap kunjungan ANC dan perkembangan kehamilan.</span>
            </button>

            {{-- Persalinan --}}
            <button wire:click="navigate('persalinan')"
                    class="bg-white rounded-2xl p-3 lg:p-5 flex flex-col items-center text-center
                           shadow-sm border border-pink-50 active:scale-95 lg:hover:shadow-md
                           transition-all duration-150 w-full">
                <div class="w-14 h-14 lg:w-16 lg:h-16 rounded-full bg-rose-100 flex items-center justify-center mb-2 lg:mb-3">
                    <svg viewBox="0 0 56 56" class="w-10 h-10 lg:w-12 lg:h-12" fill="none">
                        <!-- ibu -->
                        <circle cx="22" cy="16" r="7" fill="#ec4899" opacity="0.8"/>
                        <path d="M13 28 C13 22 17 20 22 20 C27 20 30 22 30 28 L30 38 C30 42 27 44 22 44 C17 44 13 40 13 36Z" fill="#ec4899" opacity="0.7"/>
                        <!-- tangan memeluk bayi -->
                        <path d="M30 30 Q38 28 40 34 Q40 40 34 40" stroke="#ec4899" stroke-width="4" fill="none" stroke-linecap="round"/>
                        <!-- bayi -->
                        <circle cx="37" cy="37" r="7" fill="#fce7f3" stroke="#ec4899" stroke-width="1.5"/>
                        <circle cx="37" cy="35" r="2.5" fill="#fda4af"/>
                        <!-- hati -->
                        <path d="M32 22 C32 20.5 33.5 19.5 35 21 C36.5 19.5 38 20.5 38 22 C38 23.5 35 26 35 26 C35 26 32 23.5 32 22Z" fill="#fda4af"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-800 leading-tight mb-1 lg:text-sm">Persalinan</span>
                <span class="text-[9px] lg:text-xs text-gray-400 leading-relaxed">Catat data persalinan dan kondisi ibu saat melahirkan.</span>
            </button>

            {{-- Data Bayi — baris 2 mobile, kolom 4 desktop --}}
            {{-- Data Bayi — kolom 4 desktop only --}}
            <button wire:click="navigate('data-bayi')"
                    class="hidden lg:flex flex-col items-center text-center bg-white rounded-2xl p-5
                        shadow-sm border border-pink-50 hover:shadow-md transition-all duration-150 w-full">
                <div class="w-16 h-16 rounded-2xl bg-orange-50 flex items-center justify-center mb-3">
                    <svg viewBox="0 0 64 64" class="w-12 h-12" fill="none">
                        <ellipse cx="32" cy="50" rx="20" ry="10" fill="#fdba74"/>
                        <ellipse cx="32" cy="38" rx="15" ry="16" fill="#fb923c"/>
                        <circle cx="32" cy="24" r="13" fill="#fed7aa"/>
                        <path d="M19 22 Q20 10 32 10 Q44 10 45 22" fill="#92400e"/>
                        <ellipse cx="32" cy="12" rx="11" ry="7" fill="#92400e"/>
                        <circle cx="27" cy="23" r="2" fill="#1a0a00"/>
                        <circle cx="37" cy="23" r="2" fill="#1a0a00"/>
                        <path d="M27 29 Q32 33 37 29" stroke="#c97b5a" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <circle cx="21" cy="26" r="3.5" fill="#fda4af" opacity="0.7"/>
                        <circle cx="43" cy="26" r="3.5" fill="#fda4af" opacity="0.7"/>
                        <path d="M17 44 Q32 50 47 44 Q47 57 32 58 Q17 57 17 44Z" fill="#fbbf24" opacity="0.6"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-800 mb-1">Data Bayi</span>
                <span class="text-[9px] text-gray-400 leading-relaxed">Catat identitas dan data bayi baru lahir secara lengkap.</span>
            </button>

            {{-- Rekam Medis — baris 2 mobile, kolom 5 desktop --}}
            {{-- Rekam Medis — kolom 5 desktop only --}}
            <button wire:click="navigate('rekam-medis')"
                    class="hidden lg:flex flex-col items-center text-center bg-white rounded-2xl p-5
                        shadow-sm border border-pink-50 hover:shadow-md transition-all duration-150 w-full">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 flex items-center justify-center mb-3">
                    <svg viewBox="0 0 64 64" class="w-12 h-12" fill="none">
                        <rect x="12" y="14" width="40" height="44" rx="7" fill="#ccfbf1" stroke="#0d9488" stroke-width="2"/>
                        <rect x="24" y="9" width="16" height="10" rx="5" fill="#99f6e4" stroke="#0d9488" stroke-width="1.5"/>
                        <circle cx="32" cy="30" r="9" fill="#0d9488" opacity="0.12"/>
                        <path d="M32 25 V35 M27 30 H37" stroke="#0d9488" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="20" y1="43" x2="44" y2="43" stroke="#0d9488" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                        <line x1="20" y1="49" x2="38" y2="49" stroke="#0d9488" stroke-width="2" stroke-linecap="round" opacity="0.4"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-800 mb-1">Rekam Medis</span>
                <span class="text-[9px] text-gray-400 leading-relaxed">Lihat ringkasan seluruh rekam medis dari awal hingga data bayi.</span>
            </button>

        </div>

        {{-- Baris 2 mobile: Data Bayi + Rekam Medis (2 kolom, lebih besar) --}}
        <div class="grid grid-cols-2 gap-3 mt-3 lg:hidden">

            {{-- Data Bayi --}}
            <button wire:click="navigate('data-bayi')"
                    class="bg-white rounded-2xl p-4 flex flex-col items-center text-center
                           shadow-sm border border-pink-50 active:scale-95 transition-all duration-150 w-full">
                <div class="w-16 h-16 rounded-2xl bg-orange-50 flex items-center justify-center mb-3">
                    <svg viewBox="0 0 64 64" class="w-12 h-12" fill="none">
                        <!-- selimut -->
                        <ellipse cx="32" cy="50" rx="20" ry="10" fill="#fdba74"/>
                        <!-- badan -->
                        <ellipse cx="32" cy="38" rx="15" ry="16" fill="#fb923c"/>
                        <!-- kepala -->
                        <circle cx="32" cy="24" r="13" fill="#fed7aa"/>
                        <!-- rambut -->
                        <path d="M19 22 Q20 10 32 10 Q44 10 45 22" fill="#92400e"/>
                        <ellipse cx="32" cy="12" rx="11" ry="7" fill="#92400e"/>
                        <!-- mata -->
                        <circle cx="27" cy="23" r="2" fill="#1a0a00"/>
                        <circle cx="37" cy="23" r="2" fill="#1a0a00"/>
                        <!-- senyum -->
                        <path d="M27 29 Q32 33 37 29" stroke="#c97b5a" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <!-- pipi -->
                        <circle cx="21" cy="26" r="3.5" fill="#fda4af" opacity="0.7"/>
                        <circle cx="43" cy="26" r="3.5" fill="#fda4af" opacity="0.7"/>
                        <!-- lipatan selimut -->
                        <path d="M17 44 Q32 50 47 44 Q47 57 32 58 Q17 57 17 44Z" fill="#fbbf24" opacity="0.6"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-800 leading-tight mb-1">Data Bayi</span>
                <span class="text-[9px] text-gray-400 leading-relaxed">Catat identitas dan data bayi baru lahir secara lengkap.</span>
            </button>

            {{-- Rekam Medis --}}
            <button wire:click="navigate('rekam-medis')"
                    class="bg-white rounded-2xl p-4 flex flex-col items-center text-center
                           shadow-sm border border-pink-50 active:scale-95 transition-all duration-150 w-full">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 flex items-center justify-center mb-3">
                    <svg viewBox="0 0 64 64" class="w-12 h-12" fill="none">
                        <!-- clipboard body -->
                        <rect x="12" y="14" width="40" height="44" rx="7" fill="#ccfbf1" stroke="#0d9488" stroke-width="2"/>
                        <!-- clip atas -->
                        <rect x="24" y="9" width="16" height="10" rx="5" fill="#99f6e4" stroke="#0d9488" stroke-width="1.5"/>
                        <!-- lingkaran plus -->
                        <circle cx="32" cy="30" r="9" fill="#0d9488" opacity="0.12"/>
                        <!-- tanda plus -->
                        <path d="M32 25 V35 M27 30 H37" stroke="#0d9488" stroke-width="2.5" stroke-linecap="round"/>
                        <!-- garis list -->
                        <line x1="20" y1="43" x2="44" y2="43" stroke="#0d9488" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                        <line x1="20" y1="49" x2="38" y2="49" stroke="#0d9488" stroke-width="2" stroke-linecap="round" opacity="0.4"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-800 leading-tight mb-1">Rekam Medis</span>
                <span class="text-[9px] text-gray-400 leading-relaxed">Lihat ringkasan seluruh rekam medis dari awal hingga data bayi.</span>
            </button>

        </div>

    </div>

    {{-- Desktop only: section bawah --}}
    <div class="hidden lg:grid lg:grid-cols-2 lg:gap-6 lg:px-10 lg:py-8">
        <div class="bg-white rounded-3xl p-6 border border-pink-100 shadow-sm">
            <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-pink-400 inline-block"></span>
                Kunjungan ANC Terakhir
            </h3>
            @if($lastAncVisit)
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-pink-50 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25M3 18.75A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $lastAncVisit['date'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $lastAncVisit['bidan'] }} · {{ $lastAncVisit['puskesmas'] }}</p>
                </div>
            </div>
            @else
            <p class="text-sm text-gray-300 text-center py-4">Belum ada data kunjungan</p>
            @endif
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl p-6 border border-purple-100">
            <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-purple-400 inline-block"></span>
                Tips Hari Ini
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">{{ $dailyTip }}</p>
        </div>
    </div>

</div>