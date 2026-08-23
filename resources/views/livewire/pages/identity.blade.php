{{-- resources/views/livewire/pages/identitas.blade.php --}}

<div class="flex flex-col min-h-full bg-white">

    {{-- ── TOP BAR — mobile only ── --}}
    {{-- Di desktop ini hidden, header sudah ada dari layouts/app.blade.php --}}
    <div class="flex items-center gap-3 px-4 py-4 bg-rose-500 text-white sticky top-0 z-10">
        <!-- <button wire:click="back"
                class="p-1.5 rounded-xl hover:bg-white/20 active:scale-95 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
            </svg>
        </button>
        <h1 class="text-base font-bold">Identitas Diri</h1> -->
        <h1 class="text-base font-bold ps-2">Identitas Diri</h1>
    </div>

    {{-- ── FORM ── --}}
    {{--
        padding-bottom mobile : tinggi bottom nav (64px) + tombol simpan (72px) + safe area
        padding-bottom desktop: cukup normal karena tidak ada fixed nav
    --}}
    <div class="flex-1 px-5 pt-6 pb-4 space-y-5 lg:max-w-2xl lg:mx-auto lg:w-full"
         x-data="{
            status: $wire.entangle('statusPregnant'),
            marital: $wire.entangle('maritalStatus'),
         }">

        @if($isUpdatingExisting)
        {{-- Notice: user lama, cuma perlu lengkapi field baru --}}
        <div class="flex items-start gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3.5">
            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <div>
                <p class="text-sm font-bold text-amber-700">Data kamu sebelumnya tetap tersimpan</p>
                <p class="text-xs text-amber-600 mt-0.5 leading-relaxed">
                    Cuma ada pertanyaan baru yang ditandai <span class="font-bold">"Baru"</span> di bawah — lengkapi itu saja, lalu simpan lagi ya.
                </p>
            </div>
        </div>
        @endif

        {{-- Nama Lengkap --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
            <input
                wire:model="fullname"
                type="text"
                placeholder="Masukkan nama lengkap"
                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                       {{ $errors->has('fullname') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
            />
            @error('fullname')
            <p class="text-xs text-rose-500 mt-1 ml-0.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat</label>
            <input
                wire:model="address"
                type="text"
                placeholder="Masukkan alamat lengkap"
                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                       {{ $errors->has('address') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
            />
            @error('address')
            <p class="text-xs text-rose-500 mt-1 ml-0.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Usia + No. HP --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Usia</label>
                <input
                    wire:model="age"
                    type="number" min="10" max="60"
                    placeholder="0"
                    class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                           {{ $errors->has('age') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
                />
                @error('age')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. HP</label>
                <input
                    wire:model="phone"
                    type="tel"
                    placeholder="08xxxxxxxxxx"
                    class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                           {{ $errors->has('phone') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
                />
                @error('phone')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Berat Badan + Tinggi Badan --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Berat Badan (BB)</label>
                <div class="relative">
                    <input
                        wire:model="weight"
                        type="number" min="20" max="200"
                        placeholder="0"
                        class="w-full pl-4 pr-10 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                               {{ $errors->has('weight') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
                    />
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400 pointer-events-none">kg</span>
                </div>
                @error('weight')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tinggi Badan (TB)</label>
                <div class="relative">
                    <input
                        wire:model="height"
                        type="number" min="100" max="250"
                        placeholder="0"
                        class="w-full pl-4 pr-10 py-3 rounded-xl border text-sm text-gray-800 placeholder-gray-300 outline-none transition-all
                               {{ $errors->has('height') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
                    />
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400 pointer-events-none">cm</span>
                </div>
                @error('height')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

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
            <label class="flex items-center gap-1.5 text-sm font-semibold text-gray-700 mb-1.5">
                Ini Pernikahan yang Ke Berapa?
                <span class="text-[10px] font-bold text-amber-600 bg-amber-100 px-1.5 py-0.5 rounded-full">Baru</span>
            </label>
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

        {{-- Status Hamil --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Hamil</label>
            <div class="grid grid-cols-2 gap-3">

                {{-- Hamil --}}
                <button type="button" @click="status = 'hamil'"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 transition-all"
                        :class="status === 'hamil' ? 'border-rose-400 bg-rose-50' : 'border-gray-200 bg-white hover:border-rose-200'">
                    <div class="w-9 h-9 shrink-0 rounded-full flex items-center justify-center"
                         :class="status === 'hamil' ? 'bg-rose-100' : 'bg-gray-100'">
                        <svg viewBox="0 0 36 36" class="w-6 h-6" fill="none">
                            <circle cx="18" cy="10" r="5" :fill="status === 'hamil' ? '#ec4899' : '#9ca3af'" opacity="0.9"/>
                            <path d="M10 20 C10 15 13 13 18 13 C23 13 26 15 26 20 L26 28 C26 31 23 33 18 33 C13 33 10 31 10 28Z"
                                :fill="status === 'hamil' ? '#ec4899' : '#9ca3af'" opacity="0.8"/>
                            <ellipse cx="18" cy="25" rx="6" ry="5"
                                :fill="status === 'hamil' ? '#f9a8d4' : '#d1d5db'"/>
                            <path d="M10 20 Q6 22 6 26" :stroke="status === 'hamil' ? '#ec4899' : '#9ca3af'" stroke-width="3" fill="none" stroke-linecap="round"/>
                            <path d="M26 20 Q30 22 30 26" :stroke="status === 'hamil' ? '#ec4899' : '#9ca3af'" stroke-width="3" fill="none" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold" :class="status === 'hamil' ? 'text-rose-600' : 'text-gray-500'">
                        Hamil
                    </span>
                </button>

                {{-- Tidak Hamil --}}
                <button type="button" @click="status = 'tidak_hamil'"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 transition-all"
                        :class="status === 'tidak_hamil' ? 'border-rose-400 bg-rose-50' : 'border-gray-200 bg-white hover:border-rose-200'">
                    <div class="w-9 h-9 shrink-0 rounded-full flex items-center justify-center"
                         :class="status === 'tidak_hamil' ? 'bg-rose-100' : 'bg-gray-100'">
                        <svg viewBox="0 0 36 36" class="w-6 h-6" fill="none">
                            <circle cx="18" cy="11" r="5" :fill="status === 'tidak_hamil' ? '#ec4899' : '#9ca3af'" opacity="0.9"/>
                            <path d="M11 21 C11 16 14 14 18 14 C22 14 25 16 25 21 L25 30 C25 32 22 34 18 34 C14 34 11 32 11 30Z"
                                :fill="status === 'tidak_hamil' ? '#ec4899' : '#9ca3af'" opacity="0.8"/>
                            <path d="M11 21 Q7 23 7 27" :stroke="status === 'tidak_hamil' ? '#ec4899' : '#9ca3af'" stroke-width="3" fill="none" stroke-linecap="round"/>
                            <path d="M25 21 Q29 23 29 27" :stroke="status === 'tidak_hamil' ? '#ec4899' : '#9ca3af'" stroke-width="3" fill="none" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold" :class="status === 'tidak_hamil' ? 'text-rose-600' : 'text-gray-500'">
                        Tidak Hamil
                    </span>
                </button>

            </div>
            @error('statusPregnant')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Usia Kehamilan — ditampilkan/disembunyikan murni oleh Alpine, tanpa request backend --}}
        <div x-show="status === 'hamil'" x-transition
             style="{{ $statusPregnant !== 'hamil' ? 'display:none' : '' }}">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Usia Kehamilan</label>
            <div class="relative">
                <select wire:model="gestationalAge"
                    class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                           appearance-none bg-white pr-10
                           {{ $errors->has('gestationalAge') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                    <option value="">Pilih usia kehamilan</option>
                    <option value="1-4">1-4 Minggu (Trimester 1)</option>
                    <option value="5-8">5-8 Minggu (Trimester 1)</option>
                    <option value="9-12">9-12 Minggu (Trimester 1)</option>
                    <option value="13-16">13-16 Minggu (Trimester 2)</option>
                    <option value="17-20">17-20 Minggu (Trimester 2)</option>
                    <option value="21-24">21-24 Minggu (Trimester 2)</option>
                    <option value="25-28">25-28 Minggu (Trimester 3)</option>
                    <option value="29-32">29-32 Minggu (Trimester 3)</option>
                    <option value="33-36">33-36 Minggu (Trimester 3)</option>
                    <option value="37-40">37-40 Minggu (Trimester 3)</option>
                </select>
                <span class="absolute right-[0.68rem] top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/>
                    </svg>
                </span>
            </div>
            @error('gestationalAge')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
        </div>
 
    </div>
 
    {{-- TOMBOL SIMPAN --}}
    <div class="px-5 pb-8 pt-2 lg:max-w-2xl lg:mx-auto lg:w-full">
        <button wire:click="simpan"
                class="w-full py-4 rounded-2xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                    text-white font-extrabold text-sm tracking-widest uppercase
                    shadow-lg shadow-rose-200 transition-all
                    flex items-center justify-center gap-2
                    disabled:opacity-70 disabled:cursor-not-allowed"
                wire:loading.attr="disabled" wire:target="simpan">
            <svg wire:loading wire:target="simpan" class="w-4 h-4 animate-spin shrink-0" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <span wire:loading.remove wire:target="simpan">SIMPAN</span>
            <span wire:loading wire:target="simpan">Menyimpan...</span>
        </button>
    </div>
 
</div>
 