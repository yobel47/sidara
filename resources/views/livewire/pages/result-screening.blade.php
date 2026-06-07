{{-- resources/views/livewire/pages/skrining-hasil.blade.php --}}

<div class="flex flex-col min-h-full bg-pink-50">

    {{-- Header --}}
    <div class="lg:hidden px-5 pt-10 pb-6 bg-pink-50 lg:px-10">
        <a href="{{ route('home') }}" wire:navigate
            class="flex items-center gap-1.5 text-rose-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Hasil Skrining</h1>
                <p class="text-sm text-gray-500 mt-1 max-w-[220px] leading-relaxed">
                    Berikut adalah hasil skrining anemia yang telah Anda lakukan.
                </p>
            </div>
            <div class="w-20 h-20 shrink-0">
                <svg viewBox="0 0 80 80" fill="none" class="w-full h-full">
                    <circle cx="55" cy="55" r="22" fill="#fce7f3" opacity="0.7" />
                    <path
                        d="M32 10 C32 10 16 28 16 40 C16 50.493 23.163 59 32 59 C40.837 59 48 50.493 48 40 C48 28 32 10 32 10Z"
                        fill="#fb7185" />
                    <circle cx="57" cy="53" r="13" fill="white" stroke="#f43f5e" stroke-width="2" />
                    <circle cx="57" cy="53" r="8" fill="#fee2e2" />
                    <line x1="64" y1="60" x2="72" y2="68" stroke="#f43f5e" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>

    <div class="flex-1 px-5 lg:pt-10 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        {{-- Warna badge sesuai hasil --}}
        @php
        $warnaMap = [
        'green' => ['title' => 'text-green-600', 'badge' => 'bg-green-100 text-green-700'],
        'yellow' => ['title' => 'text-amber-600', 'badge' => 'bg-amber-100 text-amber-700'],
        'orange' => ['title' => 'text-orange-600', 'badge' => 'bg-orange-100 text-orange-700'],
        'red' => ['title' => 'text-red-600', 'badge' => 'bg-red-100 text-red-700'],
        ];
        $warna = $warnaMap[$hasil['warna']] ?? $warnaMap['yellow'];
        @endphp

        {{-- Card Hasil Utama --}}
        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-400 mb-2">Hasil Anda</p>
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h2 class="text-2xl font-extrabold {{ $warna['title'] }} leading-tight mb-2">
                        {{ $hasil['kategori'] }}
                    </h2>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $warna['badge'] }} mb-3">
                        {{ $hasil['label'] }}
                    </span>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        {{ $hasil['deskripsi'] }}
                    </p>
                </div>
                {{-- Ilustrasi wanita --}}
                <div class="w-24 h-24 shrink-0 ml-3">
                    <svg viewBox="0 0 100 120" fill="none" class="w-full h-full">
                        <circle cx="70" cy="55" r="30" fill="#d1fae5" opacity="0.6" />
                        <path d="M35 35 Q28 55 30 80 Q31 88 38 90" stroke="#1a0a00" stroke-width="8" fill="none"
                            stroke-linecap="round" />
                        <path d="M65 35 Q72 55 70 80 Q69 88 62 90" stroke="#1a0a00" stroke-width="8" fill="none"
                            stroke-linecap="round" />
                        <ellipse cx="50" cy="28" rx="20" ry="22" fill="#1a0a00" />
                        <ellipse cx="50" cy="33" rx="16" ry="18" fill="#f8c8a0" />
                        <ellipse cx="44" cy="30" rx="2" ry="2.5" fill="#1a0a00" />
                        <ellipse cx="56" cy="30" rx="2" ry="2.5" fill="#1a0a00" />
                        <path d="M45 38 Q50 42 55 38" stroke="#c8704a" stroke-width="1.3" fill="none"
                            stroke-linecap="round" />
                        <circle cx="40" cy="35" r="3.5" fill="#fda4af" opacity="0.5" />
                        <circle cx="60" cy="35" r="3.5" fill="#fda4af" opacity="0.5" />
                        <rect x="46" y="48" width="8" height="7" rx="3" fill="#f8c8a0" />
                        <path d="M32 58 Q26 65 28 85 Q30 96 50 96 Q70 96 72 85 Q74 65 68 58 Q62 54 50 54 Q38 54 32 58Z"
                            fill="#ec4899" />
                        <ellipse cx="50" cy="78" rx="16" ry="14" fill="#f472b6" opacity="0.5" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Detail Hasil --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Detail Hasil</p>

        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Hemoglobin (Hb)</span>
                <span class="text-sm font-semibold text-gray-800">{{ $hasil['hemoglobin'] }} g/dL</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Kategori</span>
                <span class="text-sm font-semibold {{ $warna['title'] }}">{{ $hasil['kategori'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5">
                <span class="text-sm text-gray-500">Batas Normal</span>
                <span class="text-sm font-semibold text-gray-800">{{ $hasil['batasNormal'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Tanggal Skrining Awal</span>
                <span class="text-sm font-semibold text-gray-800">{{ $hasil['tanggalSkrining'] }}</span>
            </div>
        </div>

        {{-- Konseling --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Konseling</p>

        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4">
            <div class="flex gap-3">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2a7 7 0 0 1 7 7c0 2.38-1.19 4.47-3 5.74V17a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2.26C6.19 13.47 5 11.38 5 9a7 7 0 0 1 7-7zm3 18H9v1a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-1z" />
                    </svg>
                </div>
                <ul class="space-y-2 flex-1">
                    @foreach($hasil['konseling'] as $tip)
                    <li class="text-sm text-gray-700 leading-relaxed flex gap-2">
                        <span class="text-amber-500 font-bold shrink-0">•</span>
                        {{ $tip }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Anjuran --}}
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022zM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">{{ $hasil['anjuran'] }}</p>
        </div>

        {{-- Tombol Selesai --}}
        <button wire:click="selesai" class="w-full py-4 rounded-2xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                text-white font-extrabold text-sm tracking-widest uppercase
                shadow-lg shadow-rose-200 transition-all">
            Selesai
        </button>

    </div>
</div>