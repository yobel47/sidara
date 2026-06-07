{{-- resources/views/livewire/pages/anc-visit.blade.php --}}

<div class="flex flex-col flex-1 bg-violet-50">

    {{-- HEADER (mobile only) --}}
    <div class="lg:hidden px-5 pt-10 pb-6 bg-violet-50">

        <a href="{{ route('kehamilan') }}" wire:navigate
            class="flex items-center gap-1.5 text-violet-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Tambah Kunjungan ANC</h1>
                <p class="text-sm text-gray-500 mt-1 max-w-[200px] leading-relaxed">
                    Catat data kunjungan ANC terbaru Anda.
                </p>
            </div>
            <div class="w-20 h-20 shrink-0">
                <svg viewBox="0 0 80 80" fill="none" class="w-full h-full">
                    <circle cx="55" cy="50" r="24" fill="#ede9fe" opacity="0.8" />
                    <ellipse cx="32" cy="16" rx="13" ry="14" fill="#4c1d95" />
                    <ellipse cx="32" cy="20" rx="10" ry="11" fill="#f8c8a0" />
                    <ellipse cx="28" cy="19" rx="1.2" ry="1.4" fill="#1a0a00" />
                    <ellipse cx="36" cy="19" rx="1.2" ry="1.4" fill="#1a0a00" />
                    <path d="M29 24 Q32 27 35 24" stroke="#c8704a" stroke-width="1" fill="none" stroke-linecap="round" />
                    <rect x="28" y="30" width="8" height="5" rx="2" fill="#f8c8a0" />
                    <path d="M18 40 Q14 52 16 66 Q18 72 32 72 Q46 72 48 66 Q50 52 46 40 Q42 36 32 36 Q22 36 18 40Z" fill="#7c3aed" />
                    <ellipse cx="32" cy="58" rx="16" ry="14" fill="#8b5cf6" opacity="0.7" />
                    <path d="M18 44 Q10 50 12 58" stroke="#7c3aed" stroke-width="7" fill="none" stroke-linecap="round" />
                    <path d="M46 44 Q54 50 52 58" stroke="#7c3aed" stroke-width="7" fill="none" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="flex-1 px-5 lg:pt-10 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        {{-- Data Kunjungan --}}
        <p class="text-sm font-bold text-violet-600 uppercase tracking-wider">Data Kunjungan</p>

        <div class="bg-white rounded-2xl border border-violet-100 shadow-sm overflow-hidden">

            {{-- Tanggal Kunjungan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Tanggal Kunjungan</span>
                    <input wire:model="datePregnancy" type="date"
                        class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent cursor-pointer" />
                </div>
                @error('datePregnancy')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Usia Kehamilan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Usia Kehamilan</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="gestationalAge" type="number" min="1" max="42" placeholder="0"
                            class="w-14 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">minggu</span>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
                @error('gestationalAge')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hemoglobin --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Hemoglobin (Hb)</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model.live.debounce.500ms="hemoglobin" type="number" min="1" max="25" step="0.1" placeholder="0"
                            class="w-14 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">g/dL</span>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
                @error('hemoglobin')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Berat Badan --}}
            <div>
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Berat Badan</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="weight" type="number" min="20" max="200" step="0.1" placeholder="0"
                            class="w-14 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">kg</span>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
                @error('weight')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Hasil Status Anemia (live preview) --}}
        @if($preview !== null)
        @php
            $warna = [
                'green'  => ['bg' => 'bg-green-50',  'border' => 'border-green-100',  'title' => 'text-green-600',  'icon' => 'text-green-400',  'badge' => 'bg-green-100 text-green-700'],
                'yellow' => ['bg' => 'bg-amber-50',  'border' => 'border-amber-100',  'title' => 'text-amber-600',  'icon' => 'text-amber-400',  'badge' => 'bg-amber-100 text-amber-700'],
                'orange' => ['bg' => 'bg-orange-50', 'border' => 'border-orange-100', 'title' => 'text-orange-600', 'icon' => 'text-orange-400', 'badge' => 'bg-orange-100 text-orange-700'],
                'red'    => ['bg' => 'bg-red-50',    'border' => 'border-red-100',    'title' => 'text-red-600',    'icon' => 'text-red-400',    'badge' => 'bg-red-100 text-red-700'],
            ][$preview['warna']] ?? [];
        @endphp

        <p class="text-sm font-bold text-violet-600 uppercase tracking-wider">Hasil Status Anemia</p>

        <div class="{{ $warna['bg'] }} {{ $warna['border'] }} border rounded-2xl p-4">
            <div class="flex items-start gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 {{ $warna['icon'] }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8 2 4 7 4 12c0 4 3.5 8 8 8s8-4 8-8c0-5-4-10-8-10z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-extrabold {{ $warna['title'] }} text-lg leading-tight">{{ $preview['kategori'] }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $preview['deskripsi'] }}</p>
                </div>
            </div>
            <div class="bg-white bg-opacity-60 rounded-xl px-3 py-2 mb-3">
                <p class="text-xs text-gray-500">Batas Normal Hb: <span class="font-semibold text-gray-700">{{ $preview['batasNormal'] }}</span></p>
            </div>
            @if(!empty($preview['saran']))
            <div class="bg-white bg-opacity-60 rounded-xl px-3 py-2.5">
                <p class="text-xs font-bold text-gray-600 mb-2">Saran Singkat</p>
                <ul class="space-y-1.5">
                    @foreach($preview['saran'] as $s)
                    <li class="text-xs text-gray-600 flex gap-2">
                        <span class="{{ $warna['title'] }} font-bold shrink-0">•</span>
                        {{ $s }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @endif

        {{-- Catatan (Opsional) --}}
        <p class="text-sm font-bold text-violet-600 uppercase tracking-wider">Catatan <span class="text-gray-400 font-normal normal-case tracking-normal">(Opsional)</span></p>

        <div class="bg-white rounded-2xl border border-violet-100 shadow-sm">
            <div class="px-4 py-3.5">
                <textarea wire:model="notes" rows="3"
                    placeholder="Tuliskan keluhan atau catatan lainnya..."
                    maxlength="500"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent resize-none
                           border border-gray-200 rounded-xl px-3 py-2.5
                           focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition-all"></textarea>
                <p class="text-right text-xs text-gray-300 mt-1">{{ strlen($notes) }}/500</p>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <button wire:click="simpan"
                wire:loading.attr="disabled"
                wire:target="simpan"
                class="w-full py-4 rounded-2xl bg-violet-600 hover:bg-violet-700 active:scale-[0.98]
                       text-white font-extrabold text-sm tracking-widest uppercase
                       shadow-lg shadow-violet-200 transition-all
                       flex items-center justify-center gap-2
                       disabled:opacity-70 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="simpan" class="w-4 h-4 animate-spin shrink-0" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <span wire:loading.remove wire:target="simpan">Simpan Kunjungan</span>
            <span wire:loading wire:target="simpan">Menyimpan...</span>
        </button>

    </div>
</div>
