{{--
    resources/views/livewire/partials/_menu-card.blade.php

    @param string $route    — nama route Laravel
    @param string $icon     — nama file icon (tanpa ekstensi) di public/images/icons/
    @param string $iconBg   — Tailwind class background icon wrap
    @param string $title    — judul kartu
    @param string $desc     — deskripsi singkat
--}}

<button
    wire:click="navigate('{{ $route }}')"
    class="menu-card group w-full"
>
    {{-- Icon --}}
    <div class="menu-icon-wrap {{ $iconBg }}">
        <img
            src="{{ asset('images/icons/' . $icon . '.png') }}"
            alt="{{ $title }}"
            class="w-8 h-8 lg:w-10 lg:h-10 object-contain"
        />
    </div>

    {{-- Label --}}
    <span class="menu-title">{{ $title }}</span>
    <span class="menu-desc">{{ $desc }}</span>
</button>