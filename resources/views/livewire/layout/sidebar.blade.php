<div class="flex flex-col w-full h-full px-3 py-5">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-3 pb-5 mb-3 border-b border-pink-50">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0
                    bg-gradient-to-br from-pink-400 to-rose-500
                    shadow-sm shadow-rose-200">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001z"/>
            </svg>
        </div>
        <div>
            <p class="text-sm font-extrabold text-gray-900 leading-none">SiAnemia</p>
            <p class="text-xs text-gray-400 mt-0.5">Kesehatan Ibu & Bayi</p>
        </div>
    </div>

    {{-- Nav --}}
    @php
    $navItems = [
        ['route' => 'home',         'label' => 'Beranda',      'icon' => 'home'],
        ['route' => 'skrining-awal','label' => 'Skrining Awal','icon' => 'search'],
        ['route' => 'kehamilan',    'label' => 'Kehamilan',    'icon' => 'heart'],
        ['route' => 'persalinan',   'label' => 'Persalinan',   'icon' => 'baby'],
        ['route' => 'data-bayi',    'label' => 'Data Bayi',    'icon' => 'face'],
        ['route' => 'rekam-medis',  'label' => 'Rekam Medis',  'icon' => 'clipboard'],
    ];
    @endphp

    <nav class="flex-1 space-y-0.5" aria-label="Menu utama">
        @foreach($navItems as $item)
        @php $active = request()->routeIs($item['route'] . '*'); @endphp

        <a
            href="{{ route($item['route']) }}"
            wire:navigate
            class="sidebar-item {{ $active ? 'sidebar-item--active' : '' }}"
        >
            {{-- Icon --}}
            @if($item['icon'] === 'home')
            <svg class="sidebar-icon" fill="{{ $active ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            </svg>

            @elseif($item['icon'] === 'search')
            <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z"/>
            </svg>

            @elseif($item['icon'] === 'heart')
            <svg class="sidebar-icon" fill="{{ $active ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
            </svg>

            @elseif($item['icon'] === 'baby')
            <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm5.25 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75z"/>
            </svg>

            @elseif($item['icon'] === 'face')
            <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>

            @elseif($item['icon'] === 'clipboard')
            <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/>
            </svg>
            @endif

            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    {{-- User di bawah --}}
    <div class="mt-auto pt-4 border-t border-pink-50">
        <a
            href="{{ route('profil') }}"
            wire:navigate
            class="flex items-center gap-3 p-2 rounded-xl
                   hover:bg-pink-50 transition-colors"
        >
            <div class="w-9 h-9 rounded-full shrink-0 flex items-center justify-center
                        bg-gradient-to-br from-pink-200 to-rose-300
                        text-sm font-extrabold text-pink-700">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-gray-700 truncate leading-none">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </p>
                <p class="text-xs text-gray-400 mt-0.5">Lihat profil</p>
            </div>
        </a>
    </div>

</div>