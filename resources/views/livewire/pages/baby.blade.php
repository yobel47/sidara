{{-- resources/views/livewire/pages/baby.blade.php --}}

<div class="flex flex-col flex-1 bg-sky-50">

    {{-- HEADER (mobile only) --}}
    <div class="lg:hidden px-5 pt-10 pb-6 bg-sky-50">

        <a href="{{ route('home') }}" wire:navigate
            class="flex items-center gap-1.5 text-sky-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Data Bayi</h1>
                <p class="text-sm text-gray-500 mt-1 max-w-[200px] leading-relaxed">
                    Catat data kelahiran dan kondisi bayi Anda.
                </p>
            </div>
            <div class="w-24 h-24 shrink-0">
                <svg viewBox="0 0 100 100" fill="none" class="w-full h-full">
                    <circle cx="62" cy="58" r="28" fill="#e0f2fe" opacity="0.8" />
                    {{-- Selimut / bedong --}}
                    <path d="M28 52 Q26 72 40 80 Q54 88 62 76 Q70 64 62 52 Q54 42 44 42 Q34 42 28 52Z"
                        fill="#7dd3fc" />
                    <path d="M30 54 Q28 72 40 79 Q52 86 60 75 Q68 64 61 53 Q54 44 44 44 Q35 44 30 54Z"
                        fill="#bae6fd" opacity="0.6" />
                    {{-- Kepala bayi --}}
                    <circle cx="44" cy="40" r="16" fill="#f8c8a0" />
                    {{-- Rambut --}}
                    <path d="M30 36 Q32 24 44 24 Q56 24 58 36" fill="#4c1d95" opacity="0.6" />
                    {{-- Mata --}}
                    <ellipse cx="39" cy="38" rx="1.5" ry="1.8" fill="#1a0a00" />
                    <ellipse cx="49" cy="38" rx="1.5" ry="1.8" fill="#1a0a00" />
                    {{-- Senyum --}}
                    <path d="M40 44 Q44 48 48 44" stroke="#c8704a" stroke-width="1.2" fill="none"
                        stroke-linecap="round" />
                    {{-- Pipi merah --}}
                    <ellipse cx="36" cy="42" rx="3" ry="2" fill="#fca5a5" opacity="0.5" />
                    <ellipse cx="52" cy="42" rx="3" ry="2" fill="#fca5a5" opacity="0.5" />
                    {{-- Bintang dekorasi --}}
                    <path d="M72 22 L73.2 25.6 L77 25.6 L74 27.8 L75.2 31.4 L72 29.2 L68.8 31.4 L70 27.8 L67 25.6 L70.8 25.6Z"
                        fill="#fbbf24" opacity="0.8" />
                    <circle cx="22" cy="30" r="3" fill="#86efac" opacity="0.7" />
                    <circle cx="78" cy="44" r="2" fill="#f9a8d4" opacity="0.7" />
                </svg>
            </div>
        </div>
    </div>

    {{-- KONTEN --}}
    <div class="flex-1 px-5 lg:pt-10 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        @if($mode === 'form')

        {{-- ── FORM MODE ── --}}
        <p class="text-sm font-bold text-sky-600 uppercase tracking-wider">Data Bayi</p>

        <div class="bg-white rounded-2xl border border-sky-100 shadow-sm overflow-hidden">

            {{-- Nama Bayi --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Nama Bayi</span>
                    <input wire:model="name" type="text" placeholder="Nama lengkap bayi"
                        class="w-44 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent placeholder-gray-300" />
                </div>
                @error('name')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Jenis Kelamin</span>
                    <select wire:model="gender"
                        class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent appearance-none cursor-pointer">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
            </div>

            {{-- Tanggal Lahir --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Tanggal Lahir</span>
                    <input wire:model="dateBirth" type="date"
                        class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent cursor-pointer" />
                </div>
                @error('dateBirth')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Waktu Lahir --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Waktu Lahir</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="timeBirth" type="time"
                            class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent cursor-pointer" />
                        <span class="text-sm text-gray-400">WIB</span>
                    </div>
                </div>
                @error('timeBirth')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Berat Lahir --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Berat Lahir</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="weight" type="number" min="500" max="10000" step="1" placeholder="3500"
                            class="w-20 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">gram</span>
                    </div>
                </div>
                @error('weight')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Panjang Badan --}}
            <div>
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Panjang Badan</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="height" type="number" min="20" max="70" step="0.1" placeholder="0.0"
                            class="w-16 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">cm</span>
                    </div>
                </div>
                @error('height')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Tombol Simpan --}}
        <button wire:click="simpan" wire:loading.attr="disabled" wire:target="simpan" class="w-full py-4 rounded-2xl bg-sky-500 hover:bg-sky-600 active:scale-[0.98]
                           text-white font-extrabold text-sm tracking-widest uppercase
                           shadow-lg shadow-sky-200 transition-all
                           flex items-center justify-center gap-2
                           disabled:opacity-70 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="simpan" class="w-4 h-4 animate-spin shrink-0" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <span wire:loading.remove wire:target="simpan">Simpan</span>
            <span wire:loading wire:target="simpan">Menyimpan...</span>
        </button>

        @else

        {{-- ── VIEW MODE ── --}}
        <p class="text-sm font-bold text-sky-600 uppercase tracking-wider">Data Bayi</p>

        <div class="bg-white rounded-2xl border border-sky-100 shadow-sm overflow-hidden">

            {{-- Nama --}}
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Nama Bayi</span>
                <span class="text-sm font-bold text-gray-800">{{ $viewData['name'] }}</span>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Jenis Kelamin</span>
                @php
                    $genderColor = $viewData['gender'] === 'Laki-laki'
                        ? 'bg-blue-100 text-blue-700'
                        : 'bg-pink-100 text-pink-700';
                    $genderIcon  = $viewData['gender'] === 'Laki-laki' ? '♂' : '♀';
                @endphp
                <span class="text-xs font-bold px-2.5 py-0.5 rounded-full {{ $genderColor }}">
                    {{ $genderIcon }} {{ $viewData['gender'] }}
                </span>
            </div>

            {{-- Tanggal Lahir --}}
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Tanggal Lahir</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['tanggal'] }}</span>
            </div>

            {{-- Waktu Lahir --}}
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Waktu Lahir</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['waktu'] }}</span>
            </div>

            {{-- Berat Lahir --}}
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Berat Lahir</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['weight'] }}</span>
            </div>

            {{-- Panjang Badan --}}
            <div class="flex items-center justify-between px-4 py-3.5">
                <span class="text-sm text-gray-500">Panjang Badan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['height'] }}</span>
            </div>

        </div>

        {{-- Tombol Edit --}}
        <button wire:click="edit" class="w-full py-3.5 rounded-2xl border-2 border-sky-200 hover:border-sky-400
                           text-sky-500 hover:text-sky-600 font-bold text-sm tracking-wider
                           transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
            </svg>
            Edit Data
        </button>

        @endif

    </div>

</div>
