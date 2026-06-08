{{-- resources/views/livewire/pages/admin.blade.php --}}

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-gray-800">Data Pengguna</h1>
            <p class="text-sm text-gray-400 mt-0.5">{{ $users->total() }} pengguna terdaftar</p>
        </div>
        <div class="relative w-full sm:w-72">
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0Z" />
                </svg>
            </span>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama, username, no. telepon..."
                class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-white
                    focus:outline-none focus:border-rose-400 focus:ring-1 focus:ring-rose-100 transition-all">
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-left">
                        <th class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider w-10">No
                        </th>
                        <th class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Usia / BB /
                            TB</th>
                        <th class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th
                            class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">
                            ANC</th>
                        <th
                            class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">
                            Skrining</th>
                        <th
                            class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">
                            Persalinan</th>
                        <th
                            class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">
                            Bayi</th>
                        <th class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-4 py-3.5 text-gray-400 text-xs">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-3.5">
                            <p class="font-semibold text-gray-800">
                                {{ $user->chUser?->fullname ?? $user->name }}
                            </p>
                            <p class="text-xs text-gray-400">{{ '@' . $user->username }}
                                @if($user->email) · {{ $user->email }} @endif
                            </p>
                        </td>

                        <td class="px-4 py-3.5 text-gray-700">
                            @if($user->chUser)
                            <p class="font-medium">{{ $user->chUser->age }} tahun</p>
                            <p class="text-xs text-gray-400">
                                {{ $user->chUser->weight }} kg &middot; {{ $user->chUser->height }} cm
                            </p>
                            @else
                            <span class="text-gray-300 text-xs italic">Belum diisi</span>
                            @endif
                        </td>

                        <td class="px-4 py-3.5">
                            @if($user->chUser)
                            @if($user->chUser->statusPregnant === 'hamil')
                            <span
                                class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-600">
                                Hamil
                            </span>
                            @if($user->chUser->gestationalAge)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $user->chUser->gestationalAge }} minggu</p>
                            @endif
                            @else
                            <span
                                class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-500">
                                Tidak Hamil
                            </span>
                            @endif
                            @else
                            <span class="text-gray-300">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3.5 text-center">
                            @if($user->pregnancy_count > 0)
                            <span
                                class="inline-block min-w-[1.5rem] px-2 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-600">
                                {{ $user->pregnancy_count }}
                            </span>
                            @else
                            <span class="text-gray-200">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3.5 text-center">
                            @if($user->screening_count > 0)
                            <span
                                class="inline-block min-w-[1.5rem] px-2 py-0.5 rounded-full text-xs font-bold bg-violet-50 text-violet-600">
                                {{ $user->screening_count }}
                            </span>
                            @else
                            <span class="text-gray-200">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3.5 text-center">
                            @if($user->childbirth_count > 0)
                            <svg class="w-4 h-4 text-green-500 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" />
                            </svg>
                            @else
                            <span class="text-gray-200">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3.5 text-center">
                            @if($user->baby_count > 0)
                            <span
                                class="inline-block min-w-[1.5rem] px-2 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-600">
                                {{ $user->baby_count }}
                            </span>
                            @else
                            <span class="text-gray-200">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3.5 text-right">
                            <button wire:click="lihatDetail({{ $user->id }})" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                       text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors">
                                Detail
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-16 text-center text-gray-400 text-sm">
                            @if($search)
                            Tidak ada pengguna yang cocok dengan
                            "<span class="font-semibold text-gray-600">{{ $search }}</span>"
                            @else
                            Belum ada pengguna terdaftar.
                            @endif
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="px-4 py-3.5 border-t border-gray-100">
            {{ $users->links() }}
        </div>
        @endif
    </div>


    {{-- ─── SLIDE-OVER DETAIL ─── --}}
    <div x-data="{ tab: 'profil' }" x-init="$watch('$wire.selectedUserId', v => { if (v) tab = 'profil'; })" x-cloak
        x-show="$wire.selectedUserId !== null" class="!mt-0 fixed inset-0 z-50 overflow-hidden"
        x-transition:enter="ease-in-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" wire:click="tutupDetail"></div>

        {{-- Panel --}}
        <div class="absolute right-0 inset-y-0 w-full max-w-2xl bg-white shadow-2xl flex flex-col"
            x-transition:enter="transform ease-in-out duration-300" x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0" x-transition:leave="transform ease-in-out duration-200"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

            @if($this->selectedUser)

            {{-- Panel header --}}
            <div class="px-6 py-5 border-b border-gray-100 flex items-start justify-between shrink-0">
                <div class="min-w-0">
                    <h2 class="text-lg font-extrabold text-gray-800 truncate">
                        {{ $this->selectedUser->chUser?->fullname ?? $this->selectedUser->name }}
                    </h2>
                    <p class="text-sm text-gray-400 mt-0.5">
                        &#64;{{ $this->selectedUser->username }}
                        @if($this->selectedUser->email)
                        &middot; {{ $this->selectedUser->email }}
                        @endif
                    </p>
                </div>
                <button wire:click="tutupDetail"
                    class="ml-4 shrink-0 p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Tabs --}}
            <div class="px-6 border-b border-gray-100 flex gap-1 shrink-0 overflow-x-auto">
                @foreach([
                'profil' => 'Profil',
                'anc' => 'Kunjungan ANC',
                'skrining' => 'Skrining',
                'persalinan' => 'Persalinan',
                'bayi' => 'Bayi',
                ] as $key => $label)
                <button @click="tab = '{{ $key }}'" :class="tab === '{{ $key }}'
                        ? 'border-b-2 border-rose-500 text-rose-600 font-bold'
                        : 'text-gray-400 hover:text-gray-700'"
                    class="py-3.5 px-2 text-sm whitespace-nowrap transition-colors shrink-0">
                    {{ $label }}
                </button>
                @endforeach
            </div>

            {{-- Tab content --}}
            <div class="flex-1 overflow-y-auto p-6 space-y-0">

                {{-- ── PROFIL ── --}}
                <div x-show="tab === 'profil'">
                    @if($this->selectedUser->chUser)
                    @php $ch = $this->selectedUser->chUser; @endphp
                    <dl class="grid grid-cols-2 gap-3">
                        <div class="col-span-2 bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Nama Lengkap</dt>
                            <dd class="font-semibold text-gray-800">{{ $ch->fullname }}</dd>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Usia</dt>
                            <dd class="font-semibold text-gray-800">{{ $ch->age }} tahun</dd>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">No. Telepon</dt>
                            <dd class="font-semibold text-gray-800">{{ $ch->phone }}</dd>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Tinggi Badan</dt>
                            <dd class="font-semibold text-gray-800">{{ $ch->height }} cm</dd>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Berat Badan</dt>
                            <dd class="font-semibold text-gray-800">{{ $ch->weight }} kg</dd>
                        </div>
                        <div class="col-span-2 bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Status Kehamilan</dt>
                            <dd class="font-semibold text-gray-800">
                                {{ $ch->statusPregnant === 'hamil' ? 'Sedang Hamil' : 'Tidak Hamil' }}
                                @if($ch->gestationalAge) &middot; {{ $ch->gestationalAge }} minggu @endif
                            </dd>
                        </div>
                        <div class="col-span-2 bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Alamat</dt>
                            <dd class="font-semibold text-gray-800">{{ $ch->address }}</dd>
                        </div>
                    </dl>
                    @else
                    <p class="text-center text-gray-400 text-sm py-16">Pengguna belum mengisi data identitas.</p>
                    @endif
                </div>

                {{-- ── KUNJUNGAN ANC ── --}}
                <div x-show="tab === 'anc'" class="space-y-3">
                    @forelse($this->selectedUser->pregnancy as $p)
                    @php
                    $diag = $p->diagnosis;
                    $badgeClass = match($diag['warna']) {
                    'green' => 'bg-green-100 text-green-700',
                    'yellow' => 'bg-yellow-100 text-yellow-700',
                    'orange' => 'bg-orange-100 text-orange-700',
                    'red' => 'bg-red-100 text-red-700',
                    default => 'bg-gray-100 text-gray-600',
                    };
                    @endphp
                    <div class="border border-gray-100 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <p class="font-bold text-gray-800 text-sm">
                                {{ $p->date_pregnancy->translatedFormat('d F Y') }}
                            </p>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $badgeClass }}">
                                {{ $diag['label'] }}
                            </span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <p class="text-xs text-gray-400">Hemoglobin</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->hemoglobin }} g/dL</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Usia Kehamilan</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->gestational_age }} minggu</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Berat Badan</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->weight }} kg</p>
                            </div>
                        </div>
                        @if($p->notes)
                        <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">{{ $p->notes }}</p>
                        @endif
                    </div>
                    @empty
                    <p class="text-center text-gray-400 text-sm py-16">Belum ada data kunjungan ANC.</p>
                    @endforelse
                </div>

                {{-- ── SKRINING ── --}}
                <div x-show="tab === 'skrining'" class="space-y-3">
                    @forelse($this->selectedUser->screening as $s)
                    @php
                    $diag = $s->diagnosis;
                    $badgeClass = match($diag['warna']) {
                    'green' => 'bg-green-100 text-green-700',
                    'yellow' => 'bg-yellow-100 text-yellow-700',
                    'orange' => 'bg-orange-100 text-orange-700',
                    'red' => 'bg-red-100 text-red-700',
                    default => 'bg-gray-100 text-gray-600',
                    };
                    @endphp
                    <div class="border border-gray-100 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <p class="font-bold text-gray-800 text-sm">
                                {{ $s->date_screening->translatedFormat('d F Y') }}
                            </p>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $badgeClass }}">
                                {{ $diag['label'] }}
                            </span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <p class="text-xs text-gray-400">Hemoglobin</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $s->hemoglobin }} g/dL</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Tinggi Badan</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $s->height }} cm</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Berat Badan</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $s->weight }} kg</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">
                            <span class="text-gray-400">Keluhan:</span> {{ $s->complaint }}
                        </p>
                    </div>
                    @empty
                    <p class="text-center text-gray-400 text-sm py-16">Belum ada data skrining.</p>
                    @endforelse
                </div>

                {{-- ── PERSALINAN ── --}}
                <div x-show="tab === 'persalinan'" class="space-y-3">
                    @forelse($this->selectedUser->childbirth as $c)
                    <div class="border border-gray-100 rounded-xl p-4">
                        <p class="font-bold text-gray-800 text-sm mb-3">
                            {{ $c->date_childbirth->translatedFormat('d F Y') }}
                        </p>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-gray-400">Usia Kehamilan</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $c->gestational_age }} minggu</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Tempat</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $c->place }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Jenis Persalinan</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $c->type }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Penolong</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $c->helper }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Kondisi Ibu</p>
                                <p class="font-semibold text-sm
                                        {{ $c->condition === 'Sehat' ? 'text-green-600' : 'text-orange-600' }}">
                                    {{ $c->condition }}
                                </p>
                            </div>
                            @if($c->complication)
                            <div>
                                <p class="text-xs text-gray-400">Komplikasi</p>
                                <p class="font-semibold text-red-600 text-sm">{{ $c->complication }}</p>
                            </div>
                            @endif
                        </div>
                        @if($c->notes)
                        <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">{{ $c->notes }}</p>
                        @endif
                    </div>
                    @empty
                    <p class="text-center text-gray-400 text-sm py-16">Belum ada data persalinan.</p>
                    @endforelse
                </div>

                {{-- ── BAYI ── --}}
                <div x-show="tab === 'bayi'" class="space-y-3">
                    @forelse($this->selectedUser->baby as $b)
                    <div class="border border-gray-100 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <p class="font-bold text-gray-800">{{ $b->name }}</p>
                            <span
                                class="px-2.5 py-0.5 rounded-full text-xs font-bold
                                    {{ $b->gender === 'Laki-laki' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600' }}">
                                {{ $b->gender }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-gray-400">Tanggal Lahir</p>
                                <p class="font-semibold text-gray-800 text-sm">
                                    {{ $b->date_birth->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            @if($b->time_birth)
                            <div>
                                <p class="text-xs text-gray-400">Waktu Lahir</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $b->time_birth }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-xs text-gray-400">Berat Lahir</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ number_format($b->weight * 1000, 0, ',', '.') }} gram</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Panjang Lahir</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $b->height }} cm</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-400 text-sm py-16">Belum ada data bayi.</p>
                    @endforelse
                </div>

            </div>
            @endif

        </div>
    </div>

</div>