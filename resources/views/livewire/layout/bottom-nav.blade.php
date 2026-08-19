{{-- 
    resources/views/livewire/layout/bottom-nav.blade.php
    Fixed bottom navigation — mobile only (hidden di lg: via inline style di wrapper)
--}}

<nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-100"
    style="padding-bottom: env(safe-area-inset-bottom, 0px);">
    <div class="flex items-stretch h-16">

        {{-- Beranda --}}
        @php $homeActive =
        $currentRoute = request()->route()->getName();
        // Tentukan route mana saja yang harus dikecualikan
        $excludedRoutes = ['rekam-medis', 'profil'];

        // Aktif jika route saat ini TIDAK ada di dalam daftar pengecualian
        $homeActive = !in_array($currentRoute, $excludedRoutes);
        @endphp
        <a href="{{ route('home') }}" wire:navigate class="flex-1 flex flex-col items-center justify-center gap-0.5 relative
                  {{ $homeActive ? 'text-rose-500' : 'text-gray-400' }}">
            @if($homeActive)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-0.5 bg-rose-500 rounded-b-full"></span>
            @endif
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="{{ $homeActive ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 12l8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-[10px] font-bold leading-none">Beranda</span>
        </a>

        {{-- Rekam Medis --}}
        @php $rekamActive = request()->routeIs('rekam-medis*'); @endphp
        <a href="{{ route('rekam-medis') }}" wire:navigate class="flex-1 flex flex-col items-center justify-center gap-0.5 relative
                  {{ $rekamActive ? 'text-rose-500' : 'text-gray-400' }}">
            @if($rekamActive)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-0.5 bg-rose-500 rounded-b-full"></span>
            @endif
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v2" />
            </svg>
            <span class="text-[10px] font-bold leading-none">Rekam Medis</span>
        </a>

        {{-- Profil --}}
        @php $profilActive = request()->routeIs('profil*'); @endphp
        <a href="{{ route('profil') }}" wire:navigate class="flex-1 flex flex-col items-center justify-center gap-0.5 relative
                  {{ $profilActive ? 'text-rose-500' : 'text-gray-400' }}">
            @if($profilActive)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-0.5 bg-rose-500 rounded-b-full"></span>
            @endif
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0" />
            </svg>
            <span class="text-[10px] font-bold leading-none">Profil</span>
        </a>

        {{-- Admin — hanya tampil untuk akun admin --}}
        @if($isAdmin)
        @php $adminActive = request()->routeIs('admin*'); @endphp
        <a href="{{ route('admin') }}" wire:navigate class="flex-1 flex flex-col items-center justify-center gap-0.5 relative
                  {{ $adminActive ? 'text-rose-500' : 'text-gray-400' }}">
            @if($adminActive)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-0.5 bg-rose-500 rounded-b-full"></span>
            @endif
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="{{ $adminActive ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
            <span class="text-[10px] font-bold leading-none">Admin</span>
        </a>
        @endif

    </div>
</nav>