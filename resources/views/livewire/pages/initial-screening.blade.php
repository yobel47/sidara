{{-- resources/views/livewire/pages/skrining-awal.blade.php --}}

<div class="flex flex-col min-h-full bg-pink-50">

    {{-- ── HEADER ──
        Mobile  : tampil full (judul + deskripsi + ilustrasi)
        Desktop : HANYA back button + judul kecil, karena pageTitle sudah ada di top bar layout
    --}}
    <div class="lg:hidden px-5 pt-10 pb-6 bg-pink-50 lg:px-10">

        {{-- Back button --}}
        <a href="{{ route('home') }}" wire:navigate
            class="lg:hidden flex items-center gap-1.5 text-rose-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>

        {{-- Judul + ilustrasi — MOBILE ONLY (lg:hidden) --}}
        {{-- Di desktop, judul sudah muncul di top bar dari layout app.blade.php --}}
        <div class="lg:hidden flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Skrining Awal</h1>
                <p class="text-sm text-gray-500 mt-1 max-w-[220px] leading-relaxed">
                    Pemeriksaan awal untuk mengetahui risiko anemia pada ibu.
                </p>
            </div>
            <div class="w-20 h-20 shrink-0">
                <svg viewBox="0 0 80 80" fill="none" class="w-full h-full">
                    <circle cx="55" cy="55" r="22" fill="#fce7f3" opacity="0.7" />
                    <path
                        d="M32 10 C32 10 16 28 16 40 C16 50.493 23.163 59 32 59 C40.837 59 48 50.493 48 40 C48 28 32 10 32 10Z"
                        fill="#fb7185" />
                    <path
                        d="M32 10 C32 10 16 28 16 40 C16 50.493 23.163 59 32 59 C40.837 59 48 50.493 48 40 C48 28 32 10 32 10Z"
                        stroke="#f43f5e" stroke-width="1.5" />
                    <circle cx="57" cy="53" r="13" fill="white" stroke="#f43f5e" stroke-width="2" />
                    <circle cx="57" cy="53" r="8" fill="#fee2e2" />
                    <line x1="64" y1="60" x2="72" y2="68" stroke="#f43f5e" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="flex-1 px-5 lg:pt-10 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Data Pemeriksaan</p>

        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm overflow-hidden">

            {{-- Tanggal --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Tanggal Pemeriksaan</span>
                    <input wire:model="dateScreening" type="date"
                        class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent cursor-pointer" />
                </div>
                @error('dateScreening')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Usia (read only) --}}
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-600">Usia</span>
                <span class="text-sm text-gray-800 font-medium">{{ $usia ?? '-' }} tahun</span>
            </div>

            {{-- Berat Badan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Berat Badan (BB)</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="weight" type="number" min="20" max="200" step="0.1" placeholder="0"
                            class="w-16 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">kg</span>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
                @error('weight')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tinggi Badan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Tinggi Badan (TB)</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="height" type="number" min="100" max="250" step="0.1" placeholder="0"
                            class="w-16 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">cm</span>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
                @error('height')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hemoglobin --}}
            {{--
                Error diletakkan di DALAM div row, bukan di luar card
                supaya muncul di bawah label, bukan di bawah garis border
            --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Hemoglobin (Hb)</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="hemoglobin" type="number" min="1" max="25" step="0.1" placeholder="0"
                            class="w-20 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">g/dL</span>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
                @error('hemoglobin')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keluhan --}}
            <div>
                <div class="px-4 py-3.5">
                    <span class="block text-sm text-gray-600 mb-2">Keluhan</span>
                    <textarea wire:model="complaint" rows="3" placeholder="Tuliskan keluhan yang dirasakan..." class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent resize-none
                   border border-gray-200 rounded-xl px-3 py-2.5
                   focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all"></textarea>
                </div>
                @error('complaint')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Hasil placeholder --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Hasil Skrining</p>

        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm p-5 text-center">
            <p class="font-bold text-gray-700 mb-1">Hasil belum tersedia</p>
            <p class="text-sm text-gray-400 leading-relaxed mb-4">
                Lengkapi data pemeriksaan di atas kemudian lihat hasil skrining Anda.
            </p>
            <button wire:click="simpan" wire:loading.attr="disabled" wire:target="simpan" class="px-6 py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white text-sm font-bold
                        shadow-sm shadow-rose-200 transition-all active:scale-95 mx-auto
                        flex items-center gap-2">
                <svg wire:loading wire:target="simpan" class="w-4 h-4 animate-spin shrink-0" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z" />
                </svg>
                <span wire:loading.remove wire:target="simpan">Lihat Hasil</span>
                <span wire:loading wire:target="simpan">Memproses...</span>
            </button>
        </div>

        {{-- Tombol Simpan --}}
        <button wire:click="simpan" wire:loading.attr="disabled" wire:target="simpan" class="w-full py-4 rounded-2xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                    text-white font-extrabold text-sm tracking-widest uppercase
                    shadow-lg shadow-rose-200 transition-all
                    flex items-center justify-center gap-2
                    disabled:opacity-70">
            <svg wire:loading wire:target="simpan" class="w-4 h-4 animate-spin shrink-0" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <span wire:loading.remove wire:target="simpan">Simpan</span>
            <span wire:loading wire:target="simpan">Menyimpan...</span>
        </button>

    </div>
</div>