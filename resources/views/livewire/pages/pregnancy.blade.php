{{-- resources/views/livewire/pages/pregnancy.blade.php --}}

<div class="flex flex-col flex-1 bg-violet-50">

    {{-- HEADER (mobile only) --}}
    <div class="lg:hidden px-5 pt-10 pb-6 bg-violet-50">

        <a href="{{ route('home') }}" wire:navigate
            class="flex items-center gap-1.5 text-violet-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Kehamilan</h1>
                <p class="text-sm text-gray-500 mt-1 max-w-[200px] leading-relaxed">
                    Catat setiap kunjungan ANC dan perkembangan kehamilan.
                </p>
            </div>
            <div class="w-20 h-20 shrink-0">
                <svg viewBox="0 0 80 80" fill="none" class="w-full h-full">
                    <circle cx="55" cy="50" r="24" fill="#ede9fe" opacity="0.8" />
                    {{-- Rambut --}}
                    <ellipse cx="32" cy="16" rx="13" ry="14" fill="#4c1d95" />
                    {{-- Wajah --}}
                    <ellipse cx="32" cy="20" rx="10" ry="11" fill="#f8c8a0" />
                    {{-- Mata --}}
                    <ellipse cx="28" cy="19" rx="1.2" ry="1.4" fill="#1a0a00" />
                    <ellipse cx="36" cy="19" rx="1.2" ry="1.4" fill="#1a0a00" />
                    {{-- Senyum --}}
                    <path d="M29 24 Q32 27 35 24" stroke="#c8704a" stroke-width="1" fill="none"
                        stroke-linecap="round" />
                    {{-- Leher --}}
                    <rect x="28" y="30" width="8" height="5" rx="2" fill="#f8c8a0" />
                    {{-- Badan (hamil) --}}
                    <path d="M18 40 Q14 52 16 66 Q18 72 32 72 Q46 72 48 66 Q50 52 46 40 Q42 36 32 36 Q22 36 18 40Z"
                        fill="#7c3aed" />
                    {{-- Perut besar --}}
                    <ellipse cx="32" cy="58" rx="16" ry="14" fill="#8b5cf6" opacity="0.7" />
                    {{-- Tangan kiri --}}
                    <path d="M18 44 Q10 50 12 58" stroke="#7c3aed" stroke-width="7" fill="none"
                        stroke-linecap="round" />
                    {{-- Tangan kanan --}}
                    <path d="M46 44 Q54 50 52 58" stroke="#7c3aed" stroke-width="7" fill="none"
                        stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>

    {{-- KONTEN --}}
    <div class="flex-1 px-5 lg:pt-10 pb-5 lg:pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        @if($ringkasan === null)
        {{-- EMPTY STATE --}}
        <div class="bg-white rounded-2xl border border-violet-100 shadow-sm p-8 text-center mt-2">
            <div class="w-16 h-16 rounded-full bg-violet-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-violet-400" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                </svg>
            </div>
            <p class="font-bold text-gray-700 mb-1">Belum ada kunjungan ANC</p>
            <p class="text-sm text-gray-400 leading-relaxed mb-5">
                Mulai catat kunjungan pertama Anda untuk memantau perkembangan kehamilan.
            </p>
            <a href="{{ route('anc-visit') }}" wire:navigate class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-700
                           text-white text-sm font-bold shadow-sm shadow-violet-200 transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Kunjungan Pertama
            </a>
        </div>

        @else
        {{-- RINGKASAN KEHAMILAN --}}
        <p class="text-sm font-bold text-violet-600 uppercase tracking-wider">Ringkasan Kehamilan</p>

        @php
        $warnaRingkasan = [
        'green' => 'text-green-600 bg-green-100',
        'yellow' => 'text-amber-600 bg-amber-100',
        'orange' => 'text-orange-600 bg-orange-100',
        'red' => 'text-red-600 bg-red-100',
        ][$ringkasan['warnaStatus']] ?? 'text-gray-600 bg-gray-100';
        @endphp

        <div class="bg-white rounded-2xl border border-violet-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Usia Kehamilan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $ringkasan['usiaKehamilan'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Taksiran Persalinan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $ringkasan['taksiranPersalinan'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Jumlah Kunjungan ANC</span>
                <span class="text-sm font-semibold text-gray-800">{{ $ringkasan['jumlahKunjungan'] }} kali</span>
            </div>
            <div class="flex items-start justify-between px-4 py-3.5">
                <span class="text-sm text-gray-500">Hemoglobin Terakhir</span>
                <div class="flex flex-row items-end gap-1">
                    <span class="text-sm font-semibold text-gray-800">{{ $ringkasan['hemoglobinTerakhir'] }} g/dL</span>
                    <span class="text-xs font-bold px-3 py-0.5 rounded-full {{ $warnaRingkasan }}">
                        {{ $ringkasan['statusAnemia'] }}
                    </span>
                </div>
            </div>
        </div>

        {{-- RIWAYAT KUNJUNGAN --}}
        <p class="text-sm font-bold text-violet-600 uppercase tracking-wider">Riwayat Kunjungan ANC</p>

        @php
        $warnaMap = [
        'green' => ['badge' => 'bg-green-100 text-green-700'],
        'yellow' => ['badge' => 'bg-amber-100 text-amber-700'],
        'orange' => ['badge' => 'bg-orange-100 text-orange-700'],
        'red' => ['badge' => 'bg-red-100 text-red-700'],
        ];
        @endphp

        <div class="space-y-3">
            @foreach($kunjungan as $k)
            @php $warna = $warnaMap[$k['warnaStatus']] ?? $warnaMap['yellow']; @endphp
            <div class="bg-white rounded-2xl border border-violet-100 shadow-sm px-4 py-4">
                <p class="text-sm font-extrabold text-gray-800 mb-3">{{ $k['tanggal'] }}</p>
                <div class="space-y-1.5 mb-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">Usia Kehamilan</span>
                        <span class="text-xs font-semibold text-gray-700">{{ $k['usiaKehamilan'] }} minggu</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">Hemoglobin (Hb)</span>
                        <span class="text-xs font-semibold text-gray-700">{{ $k['hemoglobin'] }} g/dL</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">Berat Badan</span>
                        <span class="text-xs font-semibold text-gray-700">{{ $k['weight'] }} kg</span>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                    <span class="text-xs font-semibold text-gray-500">Status Anemia</span>
                    <span class="text-xs font-bold px-3 py-1 rounded-full {{ $warna['badge'] }}">
                        {{ $k['statusAnemia'] }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('anc-visit') }}" wire:navigate class="hidden lg:flex items-center justify-center gap-2 w-full py-4 rounded-2xl bg-violet-600 hover:bg-violet-700
                   text-white font-extrabold text-sm tracking-widest uppercase
                   shadow-lg shadow-violet-200 transition-all active:scale-[0.98]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Kunjungan
        </a>
        @endif
    </div>

    {{-- TOMBOL TAMBAH (fixed bottom, hanya tampil jika sudah ada kunjungan) --}}
    @if($ringkasan !== null)
    <div
        class="bottom-0 left-0 right-0 px-5 pb-8 pt-3 bg-gradient-to-t from-violet-50 via-violet-50 to-transparent lg:hidden">
        <a href="{{ route('anc-visit') }}" wire:navigate class="flex items-center justify-center gap-2 w-full py-4 rounded-2xl bg-violet-600 hover:bg-violet-700
                text-white font-extrabold text-sm tracking-widest uppercase
                shadow-lg shadow-violet-200 transition-all active:scale-[0.98]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Kunjungan
        </a>
    </div>
    @endif

</div>