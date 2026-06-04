<div class="flex items-stretch w-full pt-1
            pb-[env(safe-area-inset-bottom,0px)]">

    @php
    $items = [
        ['route' => 'home',        'label' => 'Beranda',     'icon' => 'home'],
        ['route' => 'rekam-medis', 'label' => 'Rekam Medis', 'icon' => 'clipboard'],
        ['route' => 'profil',      'label' => 'Profil',      'icon' => 'user'],
    ];
    @endphp

    @foreach($items as $item)
    @php $active = request()->routeIs($item['route'] . '*'); @endphp

    <a
        href="{{ route($item['route']) }}"
        wire:navigate
        class="nav-item {{ $active ? 'nav-item--active' : '' }}"
        aria-label="{{ $item['label'] }}"
    >
        {{-- Indicator garis atas --}}
        @if($active)
        <span class="absolute top-0 left-1/2 -translate-x-1/2
                      w-7 h-0.5 bg-rose-500 rounded-b-full"
              aria-hidden="true">
        </span>
        @endif

        {{-- Icon --}}
        @if($item['icon'] === 'home')
        <svg class="nav-icon" fill="{{ $active ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline stroke-linecap="round" stroke-linejoin="round" points="9 22 9 12 15 12 15 22"/>
        </svg>

        @elseif($item['icon'] === 'clipboard')
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v2"/>
        </svg>

        @elseif($item['icon'] === 'user')
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/>
        </svg>
        @endif

        <span class="nav-label">{{ $item['label'] }}</span>
    </a>
    @endforeach

</div>