{{-- resources/views/livewire/layout/sidebar.blade.php --}}

<div class="flex flex-col w-full h-full px-3 py-5">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-3 pb-5 mb-2 border-b border-pink-50">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0
                    bg-gradient-to-br from-pink-400 to-rose-500 shadow-sm">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-extrabold text-gray-900 leading-none">SiAnemia</p>
            <p class="text-xs text-gray-400 mt-0.5">Kesehatan Ibu & Bayi</p>
        </div>
    </div>

    @php
    $items = [
        ['route'=>'home',         'label'=>'Beranda',      'icon'=>'home',      'active'=>['home']],
        ['route'=>'skrining-awal','label'=>'Skrining Awal','icon'=>'search',    'active'=>['skrining-awal', 'skrining-hasil']],
        ['route'=>'kehamilan',    'label'=>'Kehamilan',    'icon'=>'heart',     'active'=>['kehamilan', 'anc-visit']],
        ['route'=>'persalinan',   'label'=>'Persalinan',   'icon'=>'baby',      'active'=>['persalinan']],
        ['route'=>'data-bayi',    'label'=>'Data Bayi',    'icon'=>'face',      'active'=>['data-bayi']],
        ['route'=>'rekam-medis',  'label'=>'Rekam Medis',  'icon'=>'clipboard', 'active'=>['rekam-medis']],
    ];
    @endphp

    <nav class="flex-1 space-y-0.5 mt-2">
        @foreach($items as $item)
        @php $active = request()->routeIs($item['active']); @endphp
        <a href="{{ route($item['route']) }}" wire:navigate class="flex !mb-1 items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors
                {{ $active ? 'bg-pink-50 text-pink-600' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' }}">
            @if($item['icon']==='home')
            <svg class="w-5 h-5 shrink-0" fill="{{ $active?'currentColor':'none' }}" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            </svg>
            @elseif($item['icon']==='search')
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.2-5.2m0 0A7.5 7.5 0 1 0 5.2 5.2a7.5 7.5 0 0 0 10.6 10.6z" />
            </svg>
            @elseif($item['icon']==='heart')
            <svg class="w-5 h-5 shrink-0" fill="{{ $active?'currentColor':'none' }}" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            @elseif($item['icon']==='baby')
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                <path
                    d="M9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75s.168-.75.375-.75.375.336.375.75zm4.875 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75z"
                    fill="currentColor" />
            </svg>
            @elseif($item['icon']==='face')
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            </svg>
            @elseif($item['icon']==='clipboard')
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z" />
            </svg>
            @endif
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    <div class="mt-auto pt-3 border-t border-pink-50 space-y-0.5">

        {{-- Link ke profil --}}
        <a href="{{ route('profil') }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 mb-2 rounded-xl hover:bg-pink-50 transition-colors group">
            <div class="w-8 h-8 rounded-full shrink-0 bg-gradient-to-br from-pink-200 to-rose-300
                        flex items-center justify-center text-sm font-extrabold text-pink-700">
                {{ strtoupper(substr(auth()->user()->chUser->fullname ?? auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="flex-1 overflow-hidden">
                <p class="text-sm font-semibold text-gray-700 truncate leading-tight">
                    {{ auth()->user()->chUser->fullname ?? auth()->user()->name ?? 'Pengguna' }}
                </p>
                <p class="text-xs text-gray-400 leading-tight">Lihat profil</p>
            </div>
        </a>

        {{-- Tombol logout --}}
        <button wire:click="logout" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl
                   text-gray-400 hover:text-rose-500 hover:bg-rose-50
                   transition-colors text-sm font-semibold">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
            </svg>
            Keluar
        </button>

    </div>

</div>