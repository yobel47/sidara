{{-- resources/views/livewire/pages/profile.blade.php --}}

<div class="flex flex-col flex-1 bg-gray-50 lg:pb-8">

    {{-- HEADER (mobile only) --}}
    <div class="lg:hidden px-5 pt-10 pb-4 bg-gray-50">
        <a href="{{ route('home') }}" wire:navigate
            class="flex items-center gap-1.5 text-rose-500 text-sm font-semibold mb-4 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-extrabold text-gray-900">Profil</h1>
    </div>

    {{-- KONTEN --}}
    <div class="flex-1 px-5 lg:pt-8 pb-8 space-y-5 lg:px-10 lg:max-w-2xl lg:mx-auto lg:w-full">

        {{-- Avatar + nama --}}
        <div class="flex flex-col items-center py-4 gap-2">
            <div class="w-20 h-20 rounded-full bg-rose-100 flex items-center justify-center">
                <span class="text-3xl font-extrabold text-rose-500">
                    {{ strtoupper(substr($chUser->fullname ?? $user->name ?? '?', 0, 1)) }}
                </span>
            </div>
            <p class="text-lg font-extrabold text-gray-900">{{ $chUser->fullname ?? $user->name }}</p>
            <span class="text-xs font-bold px-3 py-1 rounded-full {{ $kondisi['statusColor'] }}">
                {{ $kondisi['status'] }}
            </span>
        </div>

        @if($mode === 'view')

        {{-- ── VIEW MODE ── --}}

        {{-- Informasi Pribadi --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Informasi Pribadi</p>

        <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Nama Lengkap</span>
                <span class="text-sm font-semibold text-gray-800">{{ $chUser->fullname }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Username</span>
                <span class="text-sm font-semibold text-gray-800">{{ $user->username }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Email</span>
                <span
                    class="text-sm font-semibold text-gray-800 text-right max-w-[60%] truncate">{{ $user->email }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">No. HP</span>
                <span class="text-sm font-semibold text-gray-800">{{ $chUser->phone }}</span>
            </div>
            <div class="flex items-start justify-between px-4 py-3.5">
                <span class="text-sm text-gray-500 shrink-0">Alamat</span>
                <span
                    class="text-sm font-semibold text-gray-800 text-right max-w-[60%] leading-snug">{{ $chUser->address }}</span>
            </div>
        </div>

        {{-- Kondisi Kesehatan --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Kondisi Kesehatan</p>

        <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Usia</span>
                <span class="text-sm font-semibold text-gray-800">{{ $kondisi['usia'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Tinggi Badan</span>
                <span class="text-sm font-semibold text-gray-800">{{ $kondisi['tinggiBadan'] }}</span>
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Berat Badan</span>
                @if($kondisi['fromAnc'])
                <div class="flex flex-col items-end gap-0.5">
                    <span class="text-sm font-semibold text-gray-800">{{ $kondisi['beratBadan'] }}</span>
                    <span class="text-xs text-gray-400">dari kunjungan ANC terakhir</span>
                </div>
                @else
                <span class="text-sm font-semibold text-gray-800">{{ $kondisi['beratBadan'] }}</span>
                @endif
            </div>
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-50">
                <span class="text-sm text-gray-500">Usia Kehamilan</span>
                @if($kondisi['fromAnc'])
                <div class="flex flex-col items-end gap-0.5">
                    <span class="text-sm font-semibold text-gray-800">{{ $kondisi['usiaKehamilan'] }}</span>
                    <span class="text-xs text-gray-400">dari kunjungan ANC terakhir</span>
                </div>
                @else
                <span class="text-sm font-semibold text-gray-800">{{ $kondisi['usiaKehamilan'] }}</span>
                @endif
            </div>
            <div class="flex items-center justify-between px-4 py-3.5">
                <span class="text-sm text-gray-500">Status</span>
                <span class="text-xs font-bold px-2.5 py-0.5 rounded-full {{ $kondisi['statusColor'] }}">
                    {{ $kondisi['status'] }}
                </span>
            </div>
        </div>

        {{-- Tombol Edit --}}
        <button wire:click="edit" class="w-full py-3.5 rounded-2xl border-2 border-rose-200 hover:border-rose-400
                   text-rose-500 hover:text-rose-600 font-bold text-sm tracking-wider
                   transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
            </svg>
            Edit Profil
        </button>

        {{-- Ubah Status Kehamilan — disembunyikan untuk user melahirkan --}}
        @if($kondisi['status'] !== 'Melahirkan')
        <a href="{{ route('perbarui-status') }}" wire:navigate
            class="w-full py-3.5 rounded-2xl border-2 border-purple-200 hover:border-purple-400
                   text-purple-500 hover:text-purple-600 font-bold text-sm tracking-wider
                   transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            Ubah Status Kehamilan
        </a>
        @endif

        {{-- Tombol Logout — mobile only (desktop ada di sidebar) --}}
        <button wire:click="logout" class="lg:hidden w-full py-3.5 rounded-2xl bg-gray-100 hover:bg-gray-200
                   text-gray-500 hover:text-gray-700 font-bold text-sm tracking-wider
                   transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
            </svg>
            Keluar
        </button>


        @else

        {{-- ── EDIT MODE ── --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Edit Profil</p>

        <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden space-y-0">

            {{-- Nama Lengkap --}}
            <div class="border-b border-gray-50 px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">Nama Lengkap</label>
                <input wire:model="fullname" type="text" placeholder="Nama lengkap"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('fullname')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Username --}}
            <div class="border-b border-gray-50 px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">Username</label>
                <input wire:model="username" type="text" placeholder="username"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('username')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div class="border-b border-gray-50 px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">Email</label>
                <input wire:model="email" type="email" placeholder="email@contoh.com"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('email')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- No. HP --}}
            <div class="border-b border-gray-50 px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">No. HP</label>
                <input wire:model="phone" type="tel" placeholder="08xxxxxxxxxx"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('phone')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Alamat --}}
            <div class="px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">Alamat</label>
                <input wire:model="address" type="text" placeholder="Alamat lengkap"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('address')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>

        </div>

        {{-- Ganti Password (opsional) --}}
        <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Ganti Password</p>
        <p class="text-xs text-gray-400 -mt-3">Kosongkan jika tidak ingin mengubah password.</p>

        <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden">
            <div class="border-b border-gray-50 px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">Password Saat Ini</label>
                <input wire:model="currentPassword" type="password" placeholder="••••••"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('currentPassword')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="border-b border-gray-50 px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">Password Baru</label>
                <input wire:model="newPassword" type="password" placeholder="••••••"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('newPassword')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="px-4 py-3.5">
                <label class="block text-xs text-gray-400 mb-1">Konfirmasi Password Baru</label>
                <input wire:model="newPasswordConfirmation" type="password" placeholder="••••••"
                    class="w-full text-sm text-gray-800 placeholder-gray-300 outline-none bg-transparent border-none" />
                @error('newPasswordConfirmation')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Simpan --}}
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
            <span wire:loading.remove wire:target="simpan">Simpan Perubahan</span>
            <span wire:loading wire:target="simpan">Menyimpan...</span>
        </button>

        <button wire:click="cancel" class="w-full py-3.5 rounded-2xl border-2 border-gray-200 hover:border-gray-300
                   text-gray-500 font-bold text-sm tracking-wider
                   transition-all active:scale-[0.98]">
            Batal
        </button>

        @endif

    </div>

</div>