{{-- resources/views/livewire/pages/update-status.blade.php --}}

<div x-data="{ selected: $wire.entangle('selectedStatus') }" class="flex flex-col min-h-full bg-pink-50">

    <div class="flex-1 px-5 lg:pt-10 pt-8 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">
        {{-- Ilustrasi --}}
        <div class="w-48 h-48 mb-6 mx-auto">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <circle cx="100" cy="100" r="90" fill="#fce7f3" opacity="0.6" />
                <path d="M65 72 Q50 100 52 140 Q54 155 62 157" stroke="#1a0a00" stroke-width="16" fill="none"
                    stroke-linecap="round" />
                <path d="M135 72 Q150 100 148 140 Q146 155 138 157" stroke="#1a0a00" stroke-width="16" fill="none"
                    stroke-linecap="round" />
                <ellipse cx="100" cy="58" rx="36" ry="38" fill="#1a0a00" />
                <ellipse cx="100" cy="66" rx="28" ry="32" fill="#f8c8a0" />
                <ellipse cx="89" cy="62" rx="3.5" ry="4" fill="#1a0a00" />
                <ellipse cx="88.5" cy="61" rx="1.2" ry="1.2" fill="white" opacity="0.6" />
                <ellipse cx="111" cy="62" rx="3.5" ry="4" fill="#1a0a00" />
                <ellipse cx="110.5" cy="61" rx="1.2" ry="1.2" fill="white" opacity="0.6" />
                <path d="M84 55 Q89 52 94 55" stroke="#5a3010" stroke-width="1.8" fill="none" stroke-linecap="round" />
                <path d="M106 55 Q111 52 116 55" stroke="#5a3010" stroke-width="1.8" fill="none"
                    stroke-linecap="round" />
                <path d="M99 70 Q100 73 101 70" stroke="#c8956a" stroke-width="1.4" fill="none"
                    stroke-linecap="round" />
                <path d="M91 78 Q100 82 109 78" stroke="#c8704a" stroke-width="2" fill="none" stroke-linecap="round" />
                <circle cx="80" cy="72" r="6" fill="#fda4af" opacity="0.45" />
                <circle cx="120" cy="72" r="6" fill="#fda4af" opacity="0.45" />
                <rect x="92" y="93" width="16" height="14" rx="5" fill="#f8c8a0" />
                <path
                    d="M64 108 Q58 130 60 170 Q62 182 100 182 Q138 182 140 170 Q142 130 136 108 Q128 102 100 102 Q72 102 64 108Z"
                    fill="#ec4899" />
                <path d="M64 115 Q46 125 44 143 Q44 150 52 150" stroke="#ec4899" stroke-width="16" fill="none"
                    stroke-linecap="round" />
                <ellipse cx="50" cy="152" rx="9" ry="8" fill="#f8c8a0" />
                <path d="M50 148 Q62 138 72 136" stroke="#f8c8a0" stroke-width="5" fill="none" stroke-linecap="round" />
                <path d="M136 115 Q154 125 156 143 Q156 150 148 150" stroke="#ec4899" stroke-width="16" fill="none"
                    stroke-linecap="round" />
                <ellipse cx="150" cy="152" rx="9" ry="8" fill="#f8c8a0" />
                <text x="138" y="52" font-size="32" font-weight="bold" fill="#ec4899" font-family="serif">?</text>
                <path d="M52 100 Q54 97 56.5 99 Q59 97 61 100 Q61 103 56.5 106 Q52 103 52 100Z" fill="#fda4af" />
            </svg>
        </div>

        {{-- Teks sambutan --}}
        <h1 class="text-2xl font-extrabold text-gray-900 text-center leading-tight mb-2">
            Selamat datang, {{ $userName }}!
        </h1>
        <p class="text-sm text-gray-500 text-center leading-relaxed max-w-xs mb-8 mx-auto">
            Untuk memberikan informasi dan rekomendasi yang tepat, pilih kondisi kamu saat ini.
        </p>

        {{-- Pertanyaan --}}
        <p class="text-base font-bold text-gray-800 text-center mb-4">Apakah kamu sedang hamil?</p>

        {{-- Pilihan --}}
        <div class="grid grid-cols-2 gap-4 w-full">

            {{-- Hamil --}}
            <button @click="selected = 'hamil'" :class="selected === 'hamil'
                    ? 'border-rose-400 bg-rose-50 ring-2 ring-rose-300 shadow-md'
                    : 'border-rose-200 bg-white hover:border-rose-400 hover:bg-rose-50'"
                class="rounded-2xl border-2 p-5 flex flex-col items-center gap-3 active:scale-95 transition-all shadow-sm">
                <svg viewBox="0 0 64 64" class="w-16 h-16" fill="none">
                    <circle cx="32" cy="18" r="9" fill="#ec4899" opacity="0.9" />
                    <path d="M18 34 C18 26 24 23 32 23 C40 23 46 26 46 34 L46 46 C46 51 41 55 32 55 C23 55 18 51 18 46Z"
                        fill="#ec4899" opacity="0.85" />
                    <ellipse cx="32" cy="42" rx="12" ry="10" fill="#f9a8d4" opacity="0.9" />
                    <path
                        d="M27 39 C27 37 29 35.5 32 37.5 C35 35.5 37 37 37 39 C37 41 32 44.5 32 44.5 C32 44.5 27 41 27 39Z"
                        fill="white" opacity="0.9" />
                    <path d="M18 34 Q10 37 10 44" stroke="#ec4899" stroke-width="5" fill="none"
                        stroke-linecap="round" />
                    <path d="M46 34 Q54 37 54 44" stroke="#ec4899" stroke-width="5" fill="none"
                        stroke-linecap="round" />
                </svg>
                <div class="flex items-center gap-1.5">
                    <span class="text-base font-extrabold text-rose-500">Hamil</span>
                    <svg x-show="selected === 'hamil'" class="w-4 h-4 text-rose-500 shrink-0" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>

            {{-- Belum Hamil --}}
            <button @click="selected = 'tidak_hamil'" :class="selected === 'tidak_hamil'
                    ? 'border-purple-200 bg-purple-100 ring-2 ring-purple-300 shadow-md'
                    : 'border-purple-100 bg-white hover:border-purple-400 hover:bg-purple-50'"
                class="rounded-2xl border-2 p-5 flex flex-col items-center gap-3 active:scale-95 transition-all shadow-sm">
                <svg viewBox="0 0 64 64" class="w-16 h-16" fill="none">
                    <circle cx="32" cy="17" r="9" fill="#a855f7" opacity="0.8" />
                    <path d="M18 33 C18 25 24 22 32 22 C40 22 46 25 46 33 L46 52 C46 57 41 60 32 60 C23 60 18 57 18 52Z"
                        fill="#a855f7" opacity="0.65" />
                    <path d="M18 33 Q10 36 10 43" stroke="#a855f7" stroke-width="5" fill="none"
                        stroke-linecap="round" />
                    <path d="M46 33 Q54 36 54 43" stroke="#a855f7" stroke-width="5" fill="none"
                        stroke-linecap="round" />
                </svg>
                <div class="flex items-center gap-1.5">
                    <span class="text-base font-extrabold text-purple-500">Belum Hamil</span>
                    <svg x-show="selected === 'tidak_hamil'" class="w-4 h-4 text-purple-500 shrink-0"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>

        </div>

        {{-- Tombol Simpan --}}
        <button wire:click="simpan" wire:loading.attr="disabled" wire:target="simpan" class="w-full py-4 rounded-2xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                   text-white font-extrabold text-sm tracking-widest uppercase
                   shadow-lg shadow-rose-200 transition-all
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

        <button wire:click="batalkan"
            class="w-full py-3.5 rounded-2xl border-2 border-gray-200 hover:border-gray-300
                   text-gray-500 font-bold text-sm tracking-wider
                   transition-all active:scale-[0.98]">
            Batal
        </button>

    </div>

</div>