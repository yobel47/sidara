{{-- resources/views/livewire/pages/medical-record.blade.php --}}

<div class="flex flex-col flex-1">

    {{-- HEADER (mobile only) --}}
    <div class="lg:hidden px-5 pt-10 pb-6 ">

        <a href="{{ route('home') }}" wire:navigate
            class="flex items-center gap-1.5 text-rose-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Rekam Medis</h1>
                <p class="text-sm text-gray-500 mt-1 max-w-[220px] leading-relaxed">
                    Lihat ringkasan seluruh rekam medis dari awal hingga data bayi.
                </p>
            </div>
            <div class="w-20 h-20 shrink-0">
                <svg viewBox="0 0 80 80" fill="none" class="w-full h-full">
                    <circle cx="52" cy="48" r="26" fill="#d1fae5" opacity="0.8" />
                    <rect x="20" y="22" width="36" height="46" rx="5" fill="white" stroke="#10b981" stroke-width="2" />
                    <rect x="30" y="16" width="16" height="12" rx="3" fill="white" stroke="#10b981" stroke-width="2" />
                    <rect x="34" y="19" width="8" height="6" rx="1.5" fill="#d1fae5" />
                    <path d="M38 33 v10 M33 38 h10" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" />
                    <line x1="28" y1="50" x2="48" y2="50" stroke="#10b981" stroke-width="1.5" stroke-linecap="round" />
                    <line x1="28" y1="57" x2="43" y2="57" stroke="#10b981" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>

    {{-- KONTEN --}}
    <div class="flex-1 px-5 lg:pt-10 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        {{-- ── RINGKASAN ── --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Ringkasan</p>

        <div class="grid grid-cols-2 gap-3">

            {{-- ANC --}}
            <div class="bg-white rounded-2xl border border-violet-100 shadow-sm p-4 flex items-center gap-2.5">
                <div class="w-9 h-9 bg-violet-50 rounded-full flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 32 32" fill="none" class="w-5 h-5">
                        <ellipse cx="16" cy="7.5" rx="3.5" ry="4" fill="#7c3aed" />
                        <path d="M8 18 Q8 28 16 28 Q24 28 24 18 Q22 14 16 14 Q10 14 8 18Z" fill="#7c3aed"
                            opacity="0.8" />
                        <ellipse cx="16" cy="23" rx="6" ry="5" fill="#8b5cf6" opacity="0.6" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 leading-none mb-0.5">ANC</p>
                    <p class="text-lg font-extrabold text-gray-800 leading-tight">{{ $ringkasan['jumlahAnc'] }} kali</p>
                </div>
            </div>

            {{-- Persalinan --}}
            <div class="bg-white rounded-2xl border border-rose-100 shadow-sm p-4 flex items-center gap-2.5">
                <div class="w-9 h-9 bg-rose-50 rounded-full flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 32 32" fill="none" class="w-5 h-5">
                        <ellipse cx="16" cy="7.5" rx="3.5" ry="4" fill="#f43f5e" />
                        <path d="M8 18 Q8 28 16 28 Q24 28 24 18 Q22 14 16 14 Q10 14 8 18Z" fill="#f43f5e"
                            opacity="0.8" />
                        <circle cx="16" cy="22" r="4" fill="#fda4af" opacity="0.8" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 leading-none mb-0.5">Persalinan</p>
                    <p class="text-lg font-extrabold text-gray-800 leading-tight">
                        {{ $ringkasan['adaPersalinan'] ? '1 kali' : '-' }}
                    </p>
                </div>
            </div>

            {{-- Skrining Awal --}}
            <div class="bg-white rounded-2xl border border-violet-100 shadow-sm p-4 flex items-center gap-2.5">
                <div class="w-9 h-9 bg-violet-50 rounded-full flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 32 32" fill="none" class="w-5 h-5">
                        <rect x="7" y="6" width="18" height="22" rx="3" fill="#ede9fe" stroke="#7c3aed"
                            stroke-width="1.5" />
                        <rect x="12" y="3" width="8" height="6" rx="2" fill="white" stroke="#7c3aed"
                            stroke-width="1.5" />
                        <path d="M12 16 h8 M12 20 h5" stroke="#7c3aed" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M12 12 l1.5 1.5 3-3" stroke="#7c3aed" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 leading-none mb-0.5">Skrining Awal</p>
                    <p class="text-xs font-bold text-gray-800 leading-snug">
                        {{ $ringkasan['tanggalSkrining'] ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- Data Bayi --}}
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-4 flex items-center gap-2.5">
                <div class="w-9 h-9 bg-amber-50 rounded-full flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 32 32" fill="none" class="w-5 h-5">
                        <circle cx="16" cy="13" r="4" fill="#f59e0b" />
                        <path d="M9 22 Q9 29 16 29 Q23 29 23 22 Q21 18 16 18 Q11 18 9 22Z" fill="#fbbf24"
                            opacity="0.7" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 leading-none mb-0.5">Data Bayi</p>
                    <p class="text-xs font-bold text-gray-800 leading-snug">
                        {{ $ringkasan['tanggalBayi'] ?? '-' }}
                    </p>
                </div>
            </div>

        </div>

        {{-- ── TIMELINE ── --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Timeline</p>

        @if(!$skrining && count($kunjunganAnc) === 0 && !$persalinan && !$bayi)
        <div class="text-center py-12">
            <p class="text-gray-400 text-sm">Belum ada data rekam medis.</p>
        </div>
        @else

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            {{-- Skrining Awal --}}
            @if($skrining)
            <a href="{{ route('skrining-hasil', $skrining['id']) }}" wire:navigate
                class="flex items-center gap-3 px-4 py-3.5 {{ (count($kunjunganAnc) > 0 || $persalinan || $bayi) ? 'border-b border-gray-50' : '' }} active:bg-gray-50 transition-colors">
                <div class="w-10 h-10 bg-rose-50 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8 2 4 7 4 12c0 4 3.5 8 8 8s8-4 8-8c0-5-4-10-8-10z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-800">Skrining Awal</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $skrining['kategori'] }}</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-xs text-gray-400">{{ $skrining['tanggal'] }}</span>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            @endif

            {{-- Kunjungan ANC — selalu terbuka --}}
            @if(count($kunjunganAnc) > 0)
            <div class="{{ $persalinan || $bayi ? 'border-b border-gray-50' : '' }}">

                {{-- Header ANC (tidak bisa ditutup) --}}
                <div class="flex items-center gap-3 px-4 py-3.5 border-b border-gray-50">
                    <div class="w-10 h-10 bg-violet-50 rounded-full flex items-center justify-center shrink-0">
                        <svg viewBox="0 0 32 32" fill="none" class="w-6 h-6">
                            <ellipse cx="16" cy="7.5" rx="3.5" ry="4" fill="#7c3aed" />
                            <path d="M8 18 Q8 28 16 28 Q24 28 24 18 Q22 14 16 14 Q10 14 8 18Z" fill="#7c3aed"
                                opacity="0.8" />
                            <ellipse cx="16" cy="23" rx="6" ry="5" fill="#8b5cf6" opacity="0.6" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-800">Kunjungan ANC</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ count($kunjunganAnc) }} kunjungan</p>
                    </div>
                    <span class="text-xs text-gray-400 shrink-0">
                        {{ $kunjunganAnc[count($kunjunganAnc)-1]['tanggal'] }}
                    </span>
                </div>

                {{-- Daftar kunjungan --}}
                @foreach($kunjunganAnc as $kunjungan)
                <div class="flex items-start gap-3 px-4 py-3 pl-6 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <div class="flex flex-col items-center pt-1 shrink-0">
                        <div class="w-2.5 h-2.5 rounded-full bg-violet-400"></div>
                        @if(!$loop->last)
                        <div class="w-0.5 bg-violet-100 mt-1" style="height:24px"></div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-700">Kunjungan ANC {{ $kunjungan['nomor'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Usia Kehamilan {{ $kunjungan['usiaKehamilan'] }} minggu
                        </p>
                    </div>
                    <span class="text-xs text-gray-400 shrink-0 pt-0.5">{{ $kunjungan['tanggal'] }}</span>
                </div>
                @endforeach

            </div>
            @endif

            {{-- Persalinan --}}
            @if($persalinan)
            <a href="{{ route('persalinan') }}" wire:navigate
                class="flex items-center gap-3 px-4 py-3.5 {{ $bayi ? 'border-b border-gray-50' : '' }} active:bg-gray-50 transition-colors">
                <div class="w-10 h-10 bg-rose-50 rounded-full flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 32 32" fill="none" class="w-6 h-6">
                        <ellipse cx="16" cy="7.5" rx="3.5" ry="4" fill="#f43f5e" />
                        <path d="M8 18 Q8 28 16 28 Q24 28 24 18 Q22 14 16 14 Q10 14 8 18Z" fill="#f43f5e"
                            opacity="0.8" />
                        <circle cx="16" cy="22" r="4" fill="#fda4af" opacity="0.8" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-800">Persalinan</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $persalinan['type'] }}</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-xs text-gray-400">{{ $persalinan['tanggal'] }}</span>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            @endif

            {{-- Data Bayi --}}
            @if($bayi)
            <a href="{{ route('data-bayi') }}" wire:navigate
                class="flex items-center gap-3 px-4 py-3.5 active:bg-gray-50 transition-colors">
                <div class="w-10 h-10 bg-amber-50 rounded-full flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 32 32" fill="none" class="w-6 h-6">
                        <circle cx="16" cy="13" r="4" fill="#f59e0b" />
                        <path d="M9 22 Q9 29 16 29 Q23 29 23 22 Q21 18 16 18 Q11 18 9 22Z" fill="#fbbf24"
                            opacity="0.7" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-800">Data Bayi</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $bayi['name'] }}, {{ $bayi['weight'] }}</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-xs text-gray-400">{{ $bayi['tanggal'] }}</span>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            @endif

        </div>
        @endif

    </div>

</div>