{{-- resources/views/livewire/pages/auth/reset-password.blade.php --}}

<div class="flex flex-col min-h-screen lg:min-h-0 px-6 pt-12 pb-8 lg:px-8 lg:pt-10 lg:pb-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-rose-500 leading-tight">Reset Password</h1>
        <p class="text-sm text-gray-400 mt-1">Buat password baru untuk akun kamu.</p>
        @if($email)
        <p class="text-xs text-gray-400 mt-0.5">{{ $email }}</p>
        @endif
    </div>

    {{-- FORM --}}
    <form wire:submit="simpan" class="flex flex-col gap-4">

        {{-- Password Baru --}}
        <div x-data="{ show: false }">
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25z" />
                    </svg>
                </span>
                <input wire:model="password" :type="show ? 'text' : 'password'" placeholder="Password baru"
                    autocomplete="new-password"
                    class="w-full pl-11 pr-12 py-3.5 rounded-2xl bg-white text-sm text-gray-800 placeholder-gray-400 outline-none transition-all
                           {{ $errors->has('password') ? 'border-2 border-rose-400 ring-2 ring-rose-100' : 'border border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}" />
                <button type="button" @click="show = !show"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg>
                </button>
            </div>
            @error('password')
            <p class="text-xs text-rose-500 mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div x-data="{ show: false }">
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </span>
                <input wire:model="passwordConfirmation" :type="show ? 'text' : 'password'"
                    placeholder="Konfirmasi password baru" autocomplete="new-password"
                    class="w-full pl-11 pr-12 py-3.5 rounded-2xl bg-white text-sm text-gray-800 placeholder-gray-400 outline-none transition-all
                           {{ $errors->has('passwordConfirmation') ? 'border-2 border-rose-400 ring-2 ring-rose-100' : 'border border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}" />
                <button type="button" @click="show = !show"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg>
                </button>
            </div>
            @error('passwordConfirmation')
            <p class="text-xs text-rose-500 mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="simpan"
            class="w-full py-4 rounded-2xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                   text-white font-extrabold text-sm tracking-widest uppercase
                   shadow-lg shadow-rose-200 transition-all mt-1
                   flex items-center justify-center gap-2
                   disabled:opacity-70 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="simpan" class="w-4 h-4 animate-spin shrink-0" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <span wire:loading.remove wire:target="simpan">Simpan Password Baru</span>
            <span wire:loading wire:target="simpan">Menyimpan...</span>
        </button>

    </form>

</div>
