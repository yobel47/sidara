{{-- resources/views/livewire/pages/childbirth.blade.php --}}

<div class="flex flex-col flex-1 bg-pink-50">

    {{-- HEADER (mobile only) --}}
    <div class="lg:hidden px-5 pt-10 pb-6 bg-pink-50">

        <a href="{{ route('home') }}" wire:navigate
            class="flex items-center gap-1.5 text-rose-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Persalinan</h1>
                <p class="text-sm text-gray-500 mt-1 max-w-[200px] leading-relaxed">
                    Catat data persalinan dan kondisi ibu saat melahirkan.
                </p>
            </div>
            <div class="w-24 h-24 shrink-0">
                <svg viewBox="0 0 100 100" fill="none" class="w-full h-full">
                    <circle cx="65" cy="60" r="28" fill="#fce7f3" opacity="0.8" />
                    {{-- Ibu --}}
                    <ellipse cx="38" cy="18" rx="13" ry="14" fill="#1a0a00" />
                    <ellipse cx="38" cy="22" rx="10" ry="11" fill="#f8c8a0" />
                    <ellipse cx="34" cy="21" rx="1.5" ry="1.8" fill="#1a0a00" />
                    <ellipse cx="42" cy="21" rx="1.5" ry="1.8" fill="#1a0a00" />
                    <path d="M35 27 Q38 30 41 27" stroke="#c8704a" stroke-width="1" fill="none"
                        stroke-linecap="round" />
                    <rect x="34" y="32" width="8" height="5" rx="2" fill="#f8c8a0" />
                    <path d="M22 44 Q18 58 20 76 Q22 84 38 84 Q54 84 56 76 Q58 58 54 44 Q48 39 38 39 Q28 39 22 44Z"
                        fill="#f43f5e" />
                    {{-- Bayi --}}
                    <circle cx="38" cy="62" r="10" fill="#f8c8a0" />
                    <ellipse cx="35" cy="60" rx="1" ry="1.2" fill="#1a0a00" />
                    <ellipse cx="41" cy="60" rx="1" ry="1.2" fill="#1a0a00" />
                    <path d="M36 64 Q38 66 40 64" stroke="#c8704a" stroke-width="1" fill="none"
                        stroke-linecap="round" />
                    {{-- Selimut bayi --}}
                    <path d="M28 68 Q28 80 38 80 Q48 80 48 68 Q44 64 38 64 Q32 64 28 68Z" fill="#fda4af" />
                    {{-- Tangan ibu --}}
                    <path d="M22 50 Q14 56 20 68" stroke="#f43f5e" stroke-width="8" fill="none"
                        stroke-linecap="round" />
                    <path d="M54 50 Q62 56 56 68" stroke="#f43f5e" stroke-width="8" fill="none"
                        stroke-linecap="round" />
                    {{-- Hati --}}
                    <path d="M60 20 C60 17 63 15 65 18 C67 15 70 17 70 20 C70 24 65 28 65 28 C65 28 60 24 60 20Z"
                        fill="#f43f5e" />
                </svg>
            </div>
        </div>
    </div>

    {{-- KONTEN --}}
    <div class="flex-1 px-5 lg:pt-10 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        @if($mode === 'form')

        {{-- ── FORM MODE ── --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Data Persalinan</p>

        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm overflow-hidden">

            {{-- Tanggal --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Tanggal Persalinan</span>
                    <input wire:model="dateChildbirth" type="date"
                        class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent cursor-pointer" />
                </div>
                @error('dateChildbirth')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Usia Kehamilan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Usia Kehamilan</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="gestationalAge" type="number" min="20" max="45" placeholder="0"
                            class="w-14 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />
                        <span class="text-sm text-gray-400">minggu</span>

                    </div>
                </div>
                @error('gestationalAge')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tempat Persalinan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Tempat Persalinan</span>
                    <div class="flex items-center gap-1">
                        <select wire:model="place"
                            class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent appearance-none cursor-pointer">
                            <option>Puskesmas</option>
                            <option>Rumah Sakit</option>
                            <option>Klinik</option>
                            <option>Bidan Praktik</option>
                            <option>Rumah</option>
                            <option>Lainnya</option>
                        </select>

                    </div>
                </div>
                @error('place')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Persalinan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Jenis Persalinan</span>
                    <div class="flex items-center gap-1">
                        <select wire:model="type"
                            class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent appearance-none cursor-pointer">
                            <option value="Normal">Normal</option>
                            <option value="SC">Section Caesarea (SC)</option>
                        </select>

                    </div>
                </div>
            </div>

            {{-- Penolong Persalinan --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Penolong Persalinan</span>
                    <div class="flex items-center gap-1">
                        <select wire:model="helper"
                            class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent appearance-none cursor-pointer">
                            <option>Bidan</option>
                            <option>Dokter</option>
                            <option>Dukun</option>
                            <option>Lainnya</option>
                        </select>

                    </div>
                </div>
            </div>

            {{-- Keadaan Ibu --}}
            <div class="border-b border-gray-50">
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Keadaan Ibu</span>
                    <div class="flex items-center gap-1">
                        <select wire:model="condition"
                            class="text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent appearance-none cursor-pointer">
                            <option>Sehat</option>
                            <option>Sakit</option>
                        </select>

                    </div>
                </div>
            </div>

            {{-- Komplikasi --}}
            <div>
                <div class="flex items-center justify-between px-4 py-3.5">
                    <span class="text-sm text-gray-600">Komplikasi</span>
                    <div class="flex items-center gap-1.5">
                        <input wire:model="complication" type="text" placeholder="Tidak ada"
                            class="w-36 text-sm text-gray-800 font-medium text-right border-none outline-none bg-transparent" />

                    </div>
                </div>
                @error('complication')
                <p class="text-xs text-rose-500 px-4 pb-2">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Catatan --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">
            Catatan
            <span class="text-gray-400 font-normal normal-case tracking-normal">(Alasan di Rujuk)</span>
        </p>

        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm">
            <div class="px-4 py-3.5">
                <textarea wire:model="notes" rows="3" maxlength="300"
                    placeholder="Tulis catatan atau alasan di rujuk (jika ada)." class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent resize-none
                               border border-gray-200 rounded-xl px-3 py-2.5
                               focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all"></textarea>
                <p class="text-right text-xs text-gray-300 mt-1">{{ strlen($notes) }}/300</p>
            </div>
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

        @else

        {{-- ── VIEW MODE ── --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Data Persalinan</p>

        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Tanggal Persalinan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['tanggal'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Usia Kehamilan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['usiaKehamilan'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Tempat Persalinan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['place'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Jenis Persalinan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['type'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Penolong Persalinan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['helper'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Keadaan Ibu</span>
                @php
                $condColor = $viewData['condition'] === 'Sehat'
                ? 'text-green-600 bg-green-100'
                : 'text-red-600 bg-red-100';
                @endphp
                <span class="text-xs font-bold px-2.5 py-0.5 rounded-full {{ $condColor }}">
                    {{ $viewData['condition'] }}
                </span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5">
                <span class="text-sm text-gray-500">Komplikasi</span>
                <span class="text-sm font-semibold text-gray-800">{{ $viewData['complication'] }}</span>
            </div>
        </div>

        @if($viewData['notes'])
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">
            Catatan
            <span class="text-gray-400 font-normal normal-case tracking-normal">(Alasan di Rujuk)</span>
        </p>
        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm px-4 py-3.5">
            <p class="text-sm text-gray-700 leading-relaxed">{{ $viewData['notes'] }}</p>
        </div>
        @endif

        {{-- Tombol Edit --}}
        <button wire:click="edit" class="w-full py-3.5 rounded-2xl border-2 border-rose-200 hover:border-rose-400
                           text-rose-500 hover:text-rose-600 font-bold text-sm tracking-wider
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