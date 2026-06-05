{{-- resources/views/livewire/pages/auth/login.blade.php --}}

<div class="flex flex-col min-h-screen lg:min-h-0 px-6 pt-12 pb-8 lg:px-8 lg:pt-10 lg:pb-10">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-rose-500 leading-tight">Login</h1>
            <p class="text-sm text-gray-400 mt-1">Masuk ke akun Anda</p>
        </div>
        <div class="w-28 h-28 -mt-2 -mr-2 shrink-0">
            <svg viewBox="0 0 140 160" fill="none" class="w-full h-full">
                <ellipse cx="70" cy="155" rx="35" ry="6" fill="#fce7f3" opacity="0.6"/>
                <path d="M42 65 Q34 95 36 130 Q38 142 46 144" stroke="#1a0a00" stroke-width="12" fill="none" stroke-linecap="round"/>
                <path d="M98 65 Q106 95 104 130 Q102 142 94 144" stroke="#1a0a00" stroke-width="12" fill="none" stroke-linecap="round"/>
                <ellipse cx="70" cy="44" rx="28" ry="30" fill="#1a0a00"/>
                <ellipse cx="70" cy="52" rx="22" ry="24" fill="#f8c8a0"/>
                <ellipse cx="62" cy="49" rx="2.5" ry="3" fill="#1a0a00"/>
                <ellipse cx="78" cy="49" rx="2.5" ry="3" fill="#1a0a00"/>
                <path d="M58 44 Q62 42 66 44" stroke="#5a3010" stroke-width="1.3" fill="none" stroke-linecap="round"/>
                <path d="M74 44 Q78 42 82 44" stroke="#5a3010" stroke-width="1.3" fill="none" stroke-linecap="round"/>
                <path d="M63 61 Q70 66 77 61" stroke="#c8704a" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                <circle cx="57" cy="56" r="4.5" fill="#fda4af" opacity="0.45"/>
                <circle cx="83" cy="56" r="4.5" fill="#fda4af" opacity="0.45"/>
                <rect x="64" y="72" width="12" height="11" rx="4" fill="#f8c8a0"/>
                <path d="M44 88 Q38 112 40 148 Q42 158 70 158 Q98 158 100 148 Q102 112 96 88 Q88 82 70 82 Q52 82 44 88Z" fill="#ec4899"/>
                <path d="M70 82 L62 100 L70 96 L78 100 Z" fill="white" opacity="0.9"/>
                <path d="M44 95 Q28 88 22 75 Q18 66 24 62" stroke="#ec4899" stroke-width="12" fill="none" stroke-linecap="round"/>
                <ellipse cx="24" cy="60" rx="7" ry="8" fill="#f8c8a0"/>
                <path d="M20 55 Q18 50 21 48" stroke="#f8c8a0" stroke-width="3" fill="none" stroke-linecap="round"/>
                <path d="M24 54 Q23 48 26 47" stroke="#f8c8a0" stroke-width="3" fill="none" stroke-linecap="round"/>
                <path d="M28 55 Q28 49 30 48" stroke="#f8c8a0" stroke-width="3" fill="none" stroke-linecap="round"/>
                <path d="M96 95 Q112 105 114 118" stroke="#ec4899" stroke-width="12" fill="none" stroke-linecap="round"/>
                <ellipse cx="115" cy="122" rx="7" ry="7" fill="#f8c8a0"/>
            </svg>
        </div>
    </div>

    {{-- FORM --}}
    <form wire:submit="login" class="flex flex-col gap-4">

        {{-- Username atau Email --}}
        <div>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/>
                    </svg>
                </span>
                <input
                    wire:model="username"
                    type="text"
                    placeholder="Username atau Email"
                    autocomplete="username"
                    class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white text-sm text-gray-800 placeholder-gray-400 outline-none transition-all
                           {{ $errors->has('username') ? 'border-2 border-rose-400 ring-2 ring-rose-100' : 'border border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
                />
            </div>
            @error('username')
            <p class="text-xs text-rose-500 mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25z"/>
                    </svg>
                </span>
                <input
                    wire:model="password"
                    type="{{ $showPassword ? 'text' : 'password' }}"
                    placeholder="Password"
                    autocomplete="current-password"
                    class="w-full pl-11 pr-12 py-3.5 rounded-2xl bg-white text-sm text-gray-800 placeholder-gray-400 outline-none transition-all
                           {{ $errors->has('password') ? 'border-2 border-rose-400 ring-2 ring-rose-100' : 'border border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"
                />
                {{-- 
                    wire:target="togglePassword" — tombol ini hanya trigger loading
                    untuk dirinya sendiri, tidak mempengaruhi button submit
                --}}
                <button type="button"
                        wire:click="togglePassword"
                        wire:target="togglePassword"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    @if($showPassword)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                    </svg>
                    @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    </svg>
                    @endif
                </button>
            </div>
            @error('password')
            <p class="text-xs text-rose-500 mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        @if(session('error'))
        <div class="bg-rose-50 border border-rose-200 rounded-xl px-4 py-3 -mt-1">
            <p class="text-xs text-rose-600 font-medium">{{ session('error') }}</p>
        </div>
        @endif

        <button type="submit"
                class="w-full py-4 rounded-2xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                       text-white font-extrabold text-sm tracking-widest uppercase
                       shadow-lg shadow-rose-200 transition-all mt-1
                       flex items-center justify-center gap-2
                       disabled:opacity-70 disabled:cursor-not-allowed"
                wire:loading.attr="disabled"
                wire:target="login">

            <svg wire:loading wire:target="login"
                 class="w-4 h-4 animate-spin shrink-0"
                 fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <span wire:loading.remove wire:target="login">LOGIN</span>
            <span wire:loading wire:target="login">Memproses...</span>

        </button>

    </form>

    <p class="text-center text-sm text-gray-400 mt-8">
        Belum punya akun?
        <a href="{{ route('register') }}" wire:navigate
           class="font-bold text-rose-500 hover:text-rose-600 ml-1">
            Daftar di sini
        </a>
    </p>

</div>