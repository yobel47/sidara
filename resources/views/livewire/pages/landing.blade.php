{{-- resources/views/livewire/pages/landing.blade.php --}}

<div>

    {{-- ── NAVBAR ── --}}
    <nav class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-md border-b border-pink-100">
        <div class="max-w-6xl mx-auto px-5 lg:px-8 flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <img src="/icon-192x192.png" alt="SI DARA" class="w-8 h-8 rounded-xl">
                <div class="leading-none">
                    <p class="text-base font-extrabold text-rose-500">SI DARA</p>
                    <p class="text-[9px] text-rose-300 font-semibold tracking-wider hidden sm:block">Sistem Deteksi Anemia Remaja</p>
                </div>
            </a>

            {{-- CTA Buttons --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" wire:navigate
                    class="px-4 py-2 text-sm font-bold text-rose-500 hover:text-rose-600 transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" wire:navigate
                    class="px-4 py-2 text-sm font-extrabold text-white bg-rose-500 hover:bg-rose-600
                           rounded-xl shadow-sm shadow-rose-200 transition-all active:scale-95">
                    Daftar Gratis
                </a>
            </div>

        </div>
    </nav>

    {{-- ── HERO ── --}}
    <section class="relative overflow-hidden pt-16">

        {{-- Background gradient --}}
        <div class="absolute inset-0 bg-gradient-to-br from-rose-50 via-pink-50 to-white -z-10"></div>

        {{-- Decorative blobs --}}
        <div class="absolute top-20 right-0 w-96 h-96 bg-rose-100 rounded-full opacity-30 blur-3xl -z-10 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-pink-200 rounded-full opacity-20 blur-3xl -z-10 -translate-x-1/3"></div>

        <div class="max-w-6xl mx-auto px-5 lg:px-8 py-16 lg:py-28 flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            {{-- Text Content --}}
            <div class="flex-1 text-center lg:text-left">

                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-rose-100 rounded-full mb-6">
                    <span class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold text-rose-600 tracking-wider uppercase">
                        Sistem Deteksi Anemia Remaja
                    </span>
                </div>

                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold text-gray-900 leading-tight mb-5">
                    Deteksi Dini Anemia,<br>
                    <span class="text-rose-500">Jaga Ibu &amp; Bayi</span>
                </h1>

                <p class="text-base lg:text-lg text-gray-500 leading-relaxed mb-8 max-w-lg mx-auto lg:mx-0">
                    SI DARA membantu remaja dan ibu hamil memantau kadar hemoglobin, mencatat kunjungan ANC, merekam proses persalinan, hingga memantau tumbuh kembang bayi — semua dalam satu aplikasi.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3">
                    <a href="{{ route('register') }}" wire:navigate
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                               px-7 py-3.5 rounded-2xl bg-rose-500 hover:bg-rose-600
                               text-white font-extrabold text-sm tracking-wide
                               shadow-lg shadow-rose-200 transition-all active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Mulai Gratis
                    </a>
                    <a href="#fitur"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                               px-7 py-3.5 rounded-2xl border-2 border-rose-200
                               text-rose-500 font-bold text-sm
                               hover:border-rose-400 transition-all active:scale-95">
                        Lihat Fitur
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex items-center justify-center lg:justify-start gap-6 mt-10">
                    <div class="text-center lg:text-left">
                        <p class="text-xl font-extrabold text-gray-800">100%</p>
                        <p class="text-xs text-gray-400">Gratis</p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="text-center lg:text-left">
                        <p class="text-xl font-extrabold text-gray-800">PWA</p>
                        <p class="text-xs text-gray-400">Bisa Offline</p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="text-center lg:text-left">
                        <p class="text-xl font-extrabold text-gray-800">5 Fitur</p>
                        <p class="text-xs text-gray-400">Lengkap</p>
                    </div>
                </div>

            </div>

            {{-- Illustration --}}
            <div class="flex-1 flex justify-center lg:justify-end">
                <div class="relative w-72 h-72 lg:w-96 lg:h-96">

                    {{-- Floating cards --}}
                    <div class="absolute top-4 left-0 bg-white rounded-2xl shadow-lg shadow-rose-100 border border-rose-50 px-4 py-3 z-10">
                        <p class="text-xs text-gray-400 mb-0.5">Hemoglobin</p>
                        <div class="flex items-center gap-2">
                            <p class="text-lg font-extrabold text-gray-800">11.2</p>
                            <span class="text-xs text-gray-400">g/dL</span>
                            <span class="ml-1 text-xs font-bold px-1.5 py-0.5 rounded-full bg-yellow-100 text-yellow-700">Ringan</span>
                        </div>
                    </div>

                    <div class="absolute bottom-10 right-0 bg-white rounded-2xl shadow-lg shadow-rose-100 border border-rose-50 px-4 py-3 z-10">
                        <p class="text-xs text-gray-400 mb-0.5">Kunjungan ANC</p>
                        <div class="flex items-center gap-2">
                            <p class="text-lg font-extrabold text-gray-800">4×</p>
                            <span class="text-xs font-bold px-1.5 py-0.5 rounded-full bg-green-100 text-green-700">Sesuai</span>
                        </div>
                    </div>

                    <div class="absolute top-1/2 -translate-y-1/2 right-4 bg-white rounded-2xl shadow-lg shadow-rose-100 border border-rose-50 px-4 py-3 z-10">
                        <p class="text-xs text-gray-400 mb-0.5">Data Bayi</p>
                        <p class="text-sm font-extrabold text-gray-800">3.200 gram</p>
                        <p class="text-xs text-gray-400">Sehat ✓</p>
                    </div>

                    {{-- Central SVG illustration --}}
                    <div class="absolute inset-8 bg-gradient-to-br from-rose-100 to-pink-200 rounded-full flex items-center justify-center">
                        <svg viewBox="0 0 140 160" fill="none" class="w-36 h-36">
                            <ellipse cx="70" cy="155" rx="35" ry="6" fill="#fce7f3" opacity="0.6"/>
                            <path d="M42 65 Q34 95 36 130 Q38 142 46 144" stroke="#1a0a00" stroke-width="12" fill="none" stroke-linecap="round"/>
                            <path d="M98 65 Q106 95 104 130 Q102 142 94 144" stroke="#1a0a00" stroke-width="12" fill="none" stroke-linecap="round"/>
                            <ellipse cx="70" cy="44" rx="28" ry="30" fill="#1a0a00"/>
                            <ellipse cx="70" cy="52" rx="22" ry="24" fill="#f8c8a0"/>
                            <ellipse cx="62" cy="49" rx="2.5" ry="3" fill="#1a0a00"/>
                            <ellipse cx="78" cy="49" rx="2.5" ry="3" fill="#1a0a00"/>
                            <path d="M63 61 Q70 66 77 61" stroke="#c8704a" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                            <circle cx="57" cy="56" r="4.5" fill="#fda4af" opacity="0.45"/>
                            <circle cx="83" cy="56" r="4.5" fill="#fda4af" opacity="0.45"/>
                            <rect x="64" y="72" width="12" height="11" rx="4" fill="#f8c8a0"/>
                            <path d="M44 88 Q38 112 40 148 Q42 158 70 158 Q98 158 100 148 Q102 112 96 88 Q88 82 70 82 Q52 82 44 88Z" fill="#ec4899"/>
                            <path d="M70 82 L62 100 L70 96 L78 100 Z" fill="white" opacity="0.9"/>
                            <path d="M44 95 Q28 88 22 75 Q18 66 24 62" stroke="#ec4899" stroke-width="12" fill="none" stroke-linecap="round"/>
                            <ellipse cx="24" cy="60" rx="7" ry="8" fill="#f8c8a0"/>
                        </svg>
                    </div>

                </div>
            </div>

        </div>
    </section>

    {{-- ── FITUR ── --}}
    <section id="fitur" class="py-16 lg:py-24 bg-white">
        <div class="max-w-6xl mx-auto px-5 lg:px-8">

            <div class="text-center mb-12">
                <p class="text-xs font-bold text-rose-400 uppercase tracking-widest mb-2">Apa yang bisa kamu lakukan</p>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900">Fitur Lengkap dalam Satu Aplikasi</h2>
                <p class="text-gray-500 mt-3 max-w-lg mx-auto text-sm lg:text-base">
                    Semua yang kamu butuhkan untuk memantau kesehatan selama kehamilan hingga pasca persalinan.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Skrining Anemia --}}
                <div class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl p-6 border border-rose-100 hover:shadow-md hover:shadow-rose-100 transition-shadow">
                    <div class="w-11 h-11 bg-rose-500 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8 2 4 7 4 12c0 4 3.5 8 8 8s8-4 8-8c0-5-4-10-8-10z"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-gray-800 mb-2">Skrining Anemia</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Deteksi dini risiko anemia berdasarkan kadar hemoglobin dan kondisi kesehatan.
                    </p>
                </div>

                {{-- Kunjungan ANC --}}
                <div class="bg-gradient-to-br from-blue-50 to-sky-50 rounded-2xl p-6 border border-blue-100 hover:shadow-md hover:shadow-blue-100 transition-shadow">
                    <div class="w-11 h-11 bg-blue-500 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-gray-800 mb-2">Kunjungan ANC</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Catat setiap kunjungan antenatal care dengan detail pemeriksaan kehamilan.
                    </p>
                </div>

                {{-- Rekam Persalinan --}}
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100 hover:shadow-md hover:shadow-green-100 transition-shadow">
                    <div class="w-11 h-11 bg-green-500 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-gray-800 mb-2">Rekam Persalinan</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Simpan data lengkap proses persalinan termasuk jenis, penolong, dan kondisi ibu.
                    </p>
                </div>

                {{-- Data Bayi --}}
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-100 hover:shadow-md hover:shadow-amber-100 transition-shadow">
                    <div class="w-11 h-11 bg-amber-500 rounded-2xl flex items-center justify-center mb-4">
                        <svg viewBox="0 0 32 32" fill="none" class="w-5 h-5">
                            <circle cx="16" cy="13" r="4" fill="white"/>
                            <path d="M9 22 Q9 29 16 29 Q23 29 23 22 Q21 18 16 18 Q11 18 9 22Z" fill="white" opacity="0.85"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-gray-800 mb-2">Data Bayi</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Pantau kondisi bayi baru lahir termasuk berat, panjang, dan waktu kelahiran.
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- ── CARA KERJA ── --}}
    <section id="cara-kerja" class="py-16 lg:py-24 bg-gradient-to-br from-rose-50 via-pink-50 to-white">
        <div class="max-w-6xl mx-auto px-5 lg:px-8">

            <div class="text-center mb-12">
                <p class="text-xs font-bold text-rose-400 uppercase tracking-widest mb-2">Mudah digunakan</p>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900">Mulai dalam 3 Langkah</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 relative">

                {{-- Connector line (desktop only) --}}
                <div class="hidden md:block absolute top-10 left-1/3 right-1/3 h-0.5 bg-rose-200 -z-0"></div>

                {{-- Step 1 --}}
                <div class="text-center relative z-10">
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-md shadow-rose-100 border border-rose-100 flex items-center justify-center mx-auto mb-5">
                        <span class="text-2xl font-extrabold text-rose-500">1</span>
                    </div>
                    <h3 class="font-extrabold text-gray-800 text-lg mb-2">Daftar & Isi Identitas</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                        Buat akun gratis dan lengkapi data diri seperti usia, tinggi, dan berat badan.
                    </p>
                </div>

                {{-- Step 2 --}}
                <div class="text-center relative z-10">
                    <div class="w-20 h-20 bg-rose-500 rounded-2xl shadow-md shadow-rose-200 flex items-center justify-center mx-auto mb-5">
                        <span class="text-2xl font-extrabold text-white">2</span>
                    </div>
                    <h3 class="font-extrabold text-gray-800 text-lg mb-2">Lakukan Skrining Awal</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                        Isi data hemoglobin dan kondisi kesehatan untuk mengetahui risiko anemia.
                    </p>
                </div>

                {{-- Step 3 --}}
                <div class="text-center relative z-10">
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-md shadow-rose-100 border border-rose-100 flex items-center justify-center mx-auto mb-5">
                        <span class="text-2xl font-extrabold text-rose-500">3</span>
                    </div>
                    <h3 class="font-extrabold text-gray-800 text-lg mb-2">Pantau Perkembangan</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                        Catat kunjungan ANC, persalinan, dan tumbuh kembang bayi secara berkala.
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="py-16 lg:py-20 bg-gradient-to-br from-rose-500 to-pink-600">
        <div class="max-w-3xl mx-auto px-5 lg:px-8 text-center">

            <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-4">
                Siap Mulai Pantau Kesehatanmu?
            </h2>
            <p class="text-rose-200 text-base lg:text-lg mb-8 leading-relaxed">
                Daftar sekarang secara gratis dan mulai perjalanan kesehatanmu bersama SI DARA.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('register') }}" wire:navigate
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                           px-8 py-4 rounded-2xl bg-white hover:bg-rose-50
                           text-rose-600 font-extrabold text-sm tracking-wide
                           shadow-lg transition-all active:scale-95">
                    Daftar Gratis Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
                <a href="{{ route('login') }}" wire:navigate
                    class="w-full sm:w-auto inline-flex items-center justify-center
                           px-8 py-4 rounded-2xl border-2 border-white/40 hover:border-white/70
                           text-white font-bold text-sm
                           transition-all active:scale-95">
                    Sudah punya akun? Masuk
                </a>
            </div>

        </div>
    </section>

    {{-- ── FOOTER ── --}}
    <footer class="bg-white border-t border-pink-100 py-8">
        <div class="max-w-6xl mx-auto px-5 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">

            <div class="flex items-center gap-2.5">
                <img src="/icon-192x192.png" alt="SI DARA" class="w-7 h-7 rounded-lg">
                <div>
                    <p class="text-sm font-extrabold text-rose-500 leading-none">SI DARA</p>
                    <p class="text-[10px] text-gray-400">Sistem Deteksi Anemia Remaja</p>
                </div>
            </div>

            <p class="text-xs text-gray-400">
                &copy; {{ date('Y') }} SI DARA. Hak cipta dilindungi.
            </p>

        </div>
    </footer>

</div>
