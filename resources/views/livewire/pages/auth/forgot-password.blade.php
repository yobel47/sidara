{{-- resources/views/livewire/pages/auth/forgot-password.blade.php --}}

<div class="flex flex-col min-h-screen lg:min-h-0 px-6 pt-12 pb-8 lg:px-8 lg:pt-10 lg:pb-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <a href="{{ route('login') }}" wire:navigate
            class="lg:hidden flex items-center gap-1.5 text-rose-400 text-sm font-semibold mb-6 w-fit active:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-extrabold text-rose-500 leading-tight">Lupa Password</h1>
        <p class="text-sm text-gray-400 mt-1">
            @if($sent)
            Cek inbox atau folder spam email kamu.
            @else
            Masukkan email akun kamu, kami akan kirimkan link reset.
            @endif
        </p>
    </div>

    @if($sent)

    {{-- SUCCESS STATE --}}
    <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center pb-8">
        <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </div>
        <p class="font-extrabold text-green-700 mb-2">Email terkirim!</p>
        <p class="text-sm text-green-600 leading-relaxed">
            Link reset password sudah kami kirim ke<br>
            <span class="font-bold">{{ $email }}</span>
        </p>
    </div>

    <a href="{{ route('login') }}" wire:navigate class="w-full py-4 rounded-2xl border-2 border-rose-200 hover:border-rose-400
               text-rose-500 font-bold text-sm tracking-wider uppercase
               transition-all active:scale-[0.98] flex items-center justify-center mt-6">
        Kembali ke Login
    </a>

    @else

    {{-- FORM --}}
    <form wire:submit="kirim" class="flex flex-col gap-4">

        <div>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </span>
                <input wire:model="email" type="email" placeholder="Email kamu" autocomplete="email"
                    class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white text-sm text-gray-800 placeholder-gray-400 outline-none transition-all
                           {{ $errors->has('email') ? 'border-2 border-rose-400 ring-2 ring-rose-100' : 'border border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}" />
            </div>
            @error('email')
            <p class="text-xs text-rose-500 mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            wire:loading.attr="disabled" wire:target="kirim"
            @if($submitted) disabled @endif
            class="w-full py-4 rounded-2xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                   text-white font-extrabold text-sm tracking-widest uppercase
                   shadow-lg shadow-rose-200 transition-all mt-1
                   flex items-center justify-center gap-2
                   disabled:opacity-70 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="kirim" class="w-4 h-4 animate-spin shrink-0" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <span wire:loading.remove wire:target="kirim">Kirim Link Reset</span>
            <span wire:loading wire:target="kirim">Mengirim...</span>
        </button>

    </form>

    <p class="text-center text-sm text-gray-400 mt-8">
        Ingat password?
        <a href="{{ route('login') }}" wire:navigate class="font-bold text-rose-500 hover:text-rose-600 ml-1">
            Login di sini
        </a>
    </p>

    @endif

</div>