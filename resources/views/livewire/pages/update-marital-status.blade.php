{{-- resources/views/livewire/pages/update-marital-status.blade.php --}}

<div x-data="{ marital: $wire.entangle('maritalStatus') }" class="flex flex-col min-h-full bg-pink-50">

    <div class="flex-1 px-5 lg:pt-10 pt-8 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        {{-- Ilustrasi --}}
        <div class="w-20 h-20 mb-4 mx-auto rounded-full bg-rose-100 flex items-center justify-center">
            <svg class="w-10 h-10 text-rose-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12c1.5-1.5 3-3.5 3-5.5A3.5 3.5 0 0 0 16 3c-1.5 0-2.5.5-3.5 2-1-1.5-2-2-3.5-2A3.5 3.5 0 0 0 5.5 6.5c0 2 1.5 4 3 5.5l4 4 4-4Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v6m-3-3h6" />
            </svg>
        </div>

        {{-- Teks sambutan --}}
        <h1 class="text-2xl font-extrabold text-gray-900 text-center leading-tight mb-2">
            Halo, {{ $userName }}!
        </h1>
        <p class="text-sm text-gray-500 text-center leading-relaxed max-w-xs mb-6 mx-auto">
            Perbarui status pernikahan kamu supaya data di aplikasi tetap sesuai kondisi terkini.
        </p>

        {{-- Status Pernikahan --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Pernikahan</label>
            <div class="grid grid-cols-2 gap-3">
                <button type="button" @click="marital = 'sudah_menikah'"
                        class="px-4 py-3 rounded-xl border-2 transition-all text-sm font-bold"
                        :class="marital === 'sudah_menikah' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-gray-200 bg-white hover:border-rose-200 text-gray-500'">
                    Sudah Menikah
                </button>
                <button type="button" @click="marital = 'belum_menikah'"
                        class="px-4 py-3 rounded-xl border-2 transition-all text-sm font-bold"
                        :class="marital === 'belum_menikah' ? 'border-rose-400 bg-rose-50 text-rose-600' : 'border-gray-200 bg-white hover:border-rose-200 text-gray-500'">
                    Belum Menikah
                </button>
            </div>
            @error('maritalStatus')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal Pernikahan — hanya kalau sudah menikah --}}
        <div x-show="marital === 'sudah_menikah'" x-transition
             style="{{ $maritalStatus !== 'sudah_menikah' ? 'display:none' : '' }}">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Pernikahan</label>
            <input
                wire:model="weddingDate"
                type="date"
                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                       {{ $errors->has('weddingDate') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
            />
            @error('weddingDate')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Pernikahan Ke- — hanya kalau sudah menikah --}}
        <div x-show="marital === 'sudah_menikah'" x-transition
             style="{{ $maritalStatus !== 'sudah_menikah' ? 'display:none' : '' }}">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ini Pernikahan yang Ke Berapa?</label>
            <input
                wire:model="marriageNumber"
                type="number" min="1" max="10"
                placeholder="Contoh: 1 untuk pernikahan pertama"
                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                       {{ $errors->has('marriageNumber') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
            />
            @error('marriageNumber')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
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
