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

    {{-- Notifikasi --}}
    @if($adminNotice)
    <div class="bg-rose-50 border border-rose-200 rounded-xl px-4 py-3 flex items-center justify-between gap-3">
        <p class="text-sm text-rose-600 font-medium">{{ $adminNotice }}</p>
        <button wire:click="$set('adminNotice', '')" class="text-rose-400 hover:text-rose-600 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Table — desktop only --}}
    <div class="hidden lg:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
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
                        <th
                            class="px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">
                            Admin</th>
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

                        <td class="px-4 py-3.5 text-center">
                            <div class="flex flex-col items-center gap-1.5">
                                @if($user->is_admin)
                                <span
                                    class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-600">
                                    Admin
                                </span>
                                @endif

                                @if($user->id === auth()->id())
                                <span class="text-[11px] text-gray-300 italic">Akun Anda</span>
                                @elseif($user->is_admin)
                                <button
                                    @click="confirmAction('Cabut akses admin dari ' + @js($user->name) + '?', {confirmText: 'Ya, Cabut', confirmColor: '#6b7280'}).then(ok => ok && $wire.toggleAdmin({{ $user->id }}))"
                                    class="text-[11px] font-semibold text-gray-400 hover:text-gray-600 transition-colors">
                                    Cabut
                                </button>
                                @else
                                <button wire:click="toggleAdmin({{ $user->id }})"
                                    class="text-[11px] font-semibold text-violet-500 hover:text-violet-700 transition-colors">
                                    Jadikan Admin
                                </button>
                                @endif
                            </div>
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
                        <td colspan="10" class="px-4 py-16 text-center text-gray-400 text-sm">
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

    {{-- Card list — mobile only --}}
    <div class="lg:hidden space-y-3">
        @forelse($users as $user)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="font-semibold text-gray-800 truncate">
                        {{ $user->chUser?->fullname ?? $user->name }}
                    </p>
                    <p class="text-xs text-gray-400 truncate">{{ '@' . $user->username }}
                        @if($user->email) &middot; {{ $user->email }} @endif
                    </p>
                </div>
                @if($user->is_admin)
                <span class="shrink-0 inline-flex px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-600">
                    Admin
                </span>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-1.5 mt-3">
                @if($user->chUser)
                @if($user->chUser->statusPregnant === 'hamil')
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-600">Hamil</span>
                @else
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 text-gray-500">Tidak Hamil</span>
                @endif
                @else
                <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-gray-50 text-gray-300 italic">Belum diisi</span>
                @endif

                @if($user->pregnancy_count > 0)
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-600">ANC {{ $user->pregnancy_count }}</span>
                @endif
                @if($user->screening_count > 0)
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-violet-50 text-violet-600">Skrining {{ $user->screening_count }}</span>
                @endif
                @if($user->childbirth_count > 0)
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-green-50 text-green-600">Persalinan</span>
                @endif
                @if($user->baby_count > 0)
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-600">Bayi {{ $user->baby_count }}</span>
                @endif
            </div>

            <div class="flex items-center justify-between gap-2 mt-3.5 pt-3.5 border-t border-gray-50">
                @if($user->id === auth()->id())
                <span class="text-xs text-gray-300 italic">Akun Anda</span>
                @elseif($user->is_admin)
                <button
                    @click="confirmAction('Cabut akses admin dari ' + @js($user->name) + '?', {confirmText: 'Ya, Cabut', confirmColor: '#6b7280'}).then(ok => ok && $wire.toggleAdmin({{ $user->id }}))"
                    class="text-xs font-semibold text-gray-400 hover:text-gray-600 transition-colors">
                    Cabut Admin
                </button>
                @else
                <button wire:click="toggleAdmin({{ $user->id }})"
                    class="text-xs font-semibold text-violet-500 hover:text-violet-700 transition-colors">
                    Jadikan Admin
                </button>
                @endif

                <button wire:click="lihatDetail({{ $user->id }})" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold
                           text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors">
                    Detail
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center text-gray-400 text-sm">
            @if($search)
            Tidak ada pengguna yang cocok dengan
            "<span class="font-semibold text-gray-600">{{ $search }}</span>"
            @else
            Belum ada pengguna terdaftar.
            @endif
        </div>
        @endforelse

        @if($users->hasPages())
        <div class="pt-2">
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

        {{-- Panel — full-width di mobile, w-full max-w-2xl di lg+ --}}
        <div class="absolute right-0 inset-y-0 w-full max-w-2xl bg-white shadow-2xl flex flex-col"
            x-transition:enter="transform ease-in-out duration-300" x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0" x-transition:leave="transform ease-in-out duration-200"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

            @if($this->selectedUser)

            {{-- Panel header --}}
            <div class="px-5 lg:px-6 py-4 lg:py-5 border-b border-gray-100 flex items-start justify-between gap-3 shrink-0">
                <div class="min-w-0">
                    <h2 class="text-lg font-extrabold text-gray-800 truncate">
                        {{ $this->selectedUser->chUser?->fullname ?? $this->selectedUser->name }}
                    </h2>
                    <p class="text-sm text-gray-400 mt-0.5 truncate">
                        &#64;{{ $this->selectedUser->username }}
                        @if($this->selectedUser->email)
                        &middot; {{ $this->selectedUser->email }}
                        @endif
                    </p>
                </div>
                <div class="flex items-center gap-1 shrink-0">
                    @if($this->selectedUser->id !== auth()->id())
                    <button
                        @click="confirmAction('Hapus akun ' + @js($this->selectedUser->chUser?->fullname ?? $this->selectedUser->name) + ' beserta SEMUA data kesehatannya secara permanen? Tindakan ini tidak bisa dibatalkan.', {title: 'Hapus Akun?', confirmText: 'Ya, Hapus Permanen'}).then(ok => ok && $wire.deleteUser({{ $this->selectedUser->id }}))"
                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors"
                        aria-label="Hapus Akun" title="Hapus Akun">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                    @endif
                    <button wire:click="tutupDetail"
                        class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="px-5 lg:px-6 border-b border-gray-100 flex gap-1 shrink-0 overflow-x-auto">
                @foreach([
                'profil' => 'Profil',
                'skrining' => 'Skrining',
                'anc' => 'Kunjungan ANC',
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
            <div class="flex-1 overflow-y-auto p-5 lg:p-6 space-y-0">

                {{-- ── PROFIL ── --}}
                <div x-show="tab === 'profil'">
                    @if($this->selectedUser->chUser)
                    @php $ch = $this->selectedUser->chUser; @endphp

                    @if(!$editingProfile)
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
                            <dt class="text-xs text-gray-400 mb-1">Status Pernikahan</dt>
                            <dd class="font-semibold text-gray-800">
                                @if($ch->maritalStatus === 'sudah_menikah')
                                Sudah Menikah
                                @elseif($ch->maritalStatus === 'belum_menikah')
                                Belum Menikah
                                @else
                                <span class="text-gray-300 font-normal italic">Belum diisi</span>
                                @endif
                            </dd>
                        </div>
                        @if($ch->maritalStatus === 'sudah_menikah')
                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Tanggal Pernikahan</dt>
                            <dd class="font-semibold text-gray-800">
                                {{ $ch->weddingDate?->translatedFormat('d F Y') ?? '—' }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Pernikahan Ke Berapa</dt>
                            <dd class="font-semibold text-gray-800">
                                {{ $ch->marriageNumber ? 'Ke-' . $ch->marriageNumber : '—' }}
                            </dd>
                        </div>
                        @endif
                        <div class="col-span-2 bg-gray-50 rounded-xl p-4">
                            <dt class="text-xs text-gray-400 mb-1">Alamat</dt>
                            <dd class="font-semibold text-gray-800">{{ $ch->address }}</dd>
                        </div>
                    </dl>

                    <button wire:click="editProfile" class="w-full mt-4 py-3 rounded-xl border-2 border-rose-200 hover:border-rose-400
                               text-rose-500 hover:text-rose-600 font-bold text-sm transition-all">
                        Edit Profil
                    </button>

                    @else
                    {{-- EDIT FORM PROFIL --}}
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Nama Lengkap</label>
                            <input wire:model="profileForm.fullname" type="text"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                       {{ $errors->has('profileForm.fullname') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                            @error('profileForm.fullname')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Alamat</label>
                            <input wire:model="profileForm.address" type="text"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                       {{ $errors->has('profileForm.address') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                            @error('profileForm.address')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Usia</label>
                                <input wire:model="profileForm.age" type="number"
                                    class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                           {{ $errors->has('profileForm.age') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                @error('profileForm.age')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">No. HP</label>
                                <input wire:model="profileForm.phone" type="text"
                                    class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                           {{ $errors->has('profileForm.phone') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                @error('profileForm.phone')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Berat Badan (kg)</label>
                                <input wire:model="profileForm.weight" type="number" step="0.1"
                                    class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                           {{ $errors->has('profileForm.weight') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                @error('profileForm.weight')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Tinggi Badan (cm)</label>
                                <input wire:model="profileForm.height" type="number" step="0.1"
                                    class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                           {{ $errors->has('profileForm.height') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                @error('profileForm.height')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Status Hamil</label>
                            <select wire:model.live="profileForm.statusPregnant"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                       {{ $errors->has('profileForm.statusPregnant') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                <option value="hamil">Hamil</option>
                                <option value="tidak_hamil">Tidak Hamil</option>
                            </select>
                            @error('profileForm.statusPregnant')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        @if(($profileForm['statusPregnant'] ?? null) === 'hamil')
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Usia Kehamilan</label>
                            <select wire:model="profileForm.gestationalAge"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                       {{ $errors->has('profileForm.gestationalAge') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                <option value="">Pilih usia kehamilan</option>
                                <option value="1-4">1-4 Minggu (Trimester 1)</option>
                                <option value="5-8">5-8 Minggu (Trimester 1)</option>
                                <option value="9-12">9-12 Minggu (Trimester 1)</option>
                                <option value="13-16">13-16 Minggu (Trimester 2)</option>
                                <option value="17-20">17-20 Minggu (Trimester 2)</option>
                                <option value="21-24">21-24 Minggu (Trimester 2)</option>
                                <option value="25-28">25-28 Minggu (Trimester 3)</option>
                                <option value="29-32">29-32 Minggu (Trimester 3)</option>
                                <option value="33-36">33-36 Minggu (Trimester 3)</option>
                                <option value="37-40">37-40 Minggu (Trimester 3)</option>
                            </select>
                            @error('profileForm.gestationalAge')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        @endif
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Status Pernikahan</label>
                            <select wire:model.live="profileForm.maritalStatus"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                       {{ $errors->has('profileForm.maritalStatus') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                <option value="belum_menikah">Belum Menikah</option>
                                <option value="sudah_menikah">Sudah Menikah</option>
                            </select>
                            @error('profileForm.maritalStatus')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        @if(($profileForm['maritalStatus'] ?? null) === 'sudah_menikah')
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Tanggal Pernikahan</label>
                            <input wire:model="profileForm.weddingDate" type="date"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                       {{ $errors->has('profileForm.weddingDate') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                            @error('profileForm.weddingDate')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Pernikahan Ke Berapa</label>
                            <input wire:model="profileForm.marriageNumber" type="number" min="1" max="10"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                       {{ $errors->has('profileForm.marriageNumber') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                            @error('profileForm.marriageNumber')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        @endif

                        <div class="flex items-center gap-2 pt-2">
                            <button wire:click="saveProfile" class="flex-1 py-3 rounded-xl bg-rose-500 hover:bg-rose-600 active:scale-[0.98]
                                       text-white font-bold text-sm transition-all">
                                Simpan
                            </button>
                            <button wire:click="cancelEditProfile" class="px-5 py-3 rounded-xl border border-gray-200 hover:border-gray-300
                                       text-gray-500 font-semibold text-sm transition-all">
                                Batal
                            </button>
                        </div>
                    </div>
                    @endif

                    @else
                    <p class="text-center text-gray-400 text-sm py-16">Pengguna belum mengisi data identitas.</p>
                    @endif

                    {{-- ── RESET PASSWORD (admin) ── --}}
                    @if(!$resettingPassword)
                    <button wire:click="resetPasswordForm" class="w-full mt-2 py-3 rounded-xl border-2 border-amber-200 hover:border-amber-400
                               text-amber-600 hover:text-amber-700 font-bold text-sm transition-all">
                        Reset Password
                    </button>
                    @else
                    <div class="mt-3 space-y-3 bg-amber-50/60 border border-amber-100 rounded-xl p-4">
                        <p class="text-xs text-gray-500">
                            Set password baru untuk akun ini. Berikan password ini ke penggunanya secara langsung.
                        </p>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Password Baru</label>
                            <input wire:model="newPassword" type="text"
                                class="w-full px-4 py-3 rounded-xl border text-sm text-gray-800 outline-none transition-all
                                       {{ $errors->has('newPassword') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100' }}">
                            @error('newPassword')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex items-center gap-2 pt-1">
                            <button
                                @click="confirmAction('Reset password akun ini sekarang?', {title: 'Reset Password?', confirmText: 'Ya, Reset', confirmColor: '#f59e0b'}).then(ok => ok && $wire.resetPassword())"
                                class="flex-1 py-3 rounded-xl bg-amber-500 hover:bg-amber-600 active:scale-[0.98]
                                       text-white font-bold text-sm transition-all">
                                Simpan Password Baru
                            </button>
                            <button wire:click="cancelResetPassword" class="px-5 py-3 rounded-xl border border-gray-200 hover:border-gray-300
                                       text-gray-500 font-semibold text-sm transition-all">
                                Batal
                            </button>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- ── KUNJUNGAN ANC ── --}}
                <div x-show="tab === 'anc'" class="space-y-3">
                    @forelse($this->selectedUser->pregnancy as $p)
                    <div class="border border-gray-100 rounded-xl p-4">
                        @if($editingRecordType === 'pregnancy' && $editingRecordId === $p->id_pregnancy)
                        {{-- EDIT FORM --}}
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Tanggal Kunjungan</label>
                                    <input wire:model="recordForm.date_pregnancy" type="date"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.date_pregnancy') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.date_pregnancy')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Usia Kehamilan (minggu)</label>
                                    <input wire:model="recordForm.gestational_age" type="number"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.gestational_age') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.gestational_age')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Hemoglobin (g/dL)</label>
                                    <input wire:model="recordForm.hemoglobin" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.hemoglobin') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.hemoglobin')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Berat Badan (kg)</label>
                                    <input wire:model="recordForm.weight" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.weight') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.weight')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider pt-1">Khusus ANC1 / Kunjungan Pertama</p>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">HPHT (Hari Pertama Haid Terakhir)</label>
                                    <input wire:model="recordForm.hpht" type="date"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.hpht') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.hpht')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Tinggi Badan (cm)</label>
                                    <input wire:model="recordForm.height" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.height') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.height')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider pt-1">Setiap Kunjungan</p>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Tekanan Darah (mmHg)</label>
                                    <div class="flex items-center gap-1.5">
                                        <input wire:model="recordForm.systolic" type="number" placeholder="Sistole"
                                            class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                                   {{ $errors->has('recordForm.systolic') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                        <span class="text-gray-400">/</span>
                                        <input wire:model="recordForm.diastolic" type="number" placeholder="Diastole"
                                            class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                                   {{ $errors->has('recordForm.diastolic') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    </div>
                                    @error('recordForm.systolic')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                    @error('recordForm.diastolic')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">LILA / Lingkar Lengan Atas (cm)</label>
                                    <input wire:model="recordForm.lila" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.lila') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.lila')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Konsumsi Tablet Tambah Darah / MMS</label>
                                <select wire:model="recordForm.tookIronSupplement"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                           {{ $errors->has('recordForm.tookIronSupplement') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    <option value="">Pilih</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                                @error('recordForm.tookIronSupplement')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Catatan</label>
                                <textarea wire:model="recordForm.notes" rows="2"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all resize-none
                                           {{ $errors->has('recordForm.notes') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"></textarea>
                                @error('recordForm.notes')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center gap-2">
                                <button wire:click="saveRecord" class="flex-1 py-2.5 rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-bold text-sm transition-all">Simpan</button>
                                <button wire:click="cancelEditRecord" class="px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 font-semibold text-sm transition-all">Batal</button>
                            </div>
                        </div>
                        @else
                        {{-- TAMPILAN --}}
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
                            @if($p->hpht)
                            <div>
                                <p class="text-xs text-gray-400">HPHT (Hari Pertama Haid Terakhir)</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->hpht->translatedFormat('d F Y') }}</p>
                            </div>
                            @endif
                            @if($p->height)
                            <div>
                                <p class="text-xs text-gray-400">Tinggi Badan</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->height }} cm</p>
                            </div>
                            @endif
                            @if($p->systolic && $p->diastolic)
                            <div>
                                <p class="text-xs text-gray-400">Tekanan Darah</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->systolic }}/{{ $p->diastolic }} mmHg</p>
                            </div>
                            @endif
                            @if($p->lila)
                            <div>
                                <p class="text-xs text-gray-400">LILA (Lingkar Lengan Atas)</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->lila }} cm</p>
                            </div>
                            @endif
                            @if(!is_null($p->took_iron_supplement))
                            <div>
                                <p class="text-xs text-gray-400">Tablet Tambah Darah/MMS</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $p->took_iron_supplement ? 'Ya' : 'Tidak' }}</p>
                            </div>
                            @endif
                        </div>
                        @if($p->notes)
                        <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">{{ $p->notes }}</p>
                        @endif
                        <div class="flex items-center gap-4 mt-3 pt-3 border-t border-gray-50">
                            <button wire:click="editRecord('pregnancy', {{ $p->id_pregnancy }})"
                                class="text-xs font-semibold text-violet-500 hover:text-violet-700 transition-colors">
                                Edit
                            </button>
                            <button
                                @click="confirmAction('Hapus data kunjungan ANC tanggal {{ $p->date_pregnancy->translatedFormat('d F Y') }}?').then(ok => ok && $wire.deleteRecord('pregnancy', {{ $p->id_pregnancy }}))"
                                class="text-xs font-semibold text-red-400 hover:text-red-600 transition-colors">
                                Hapus
                            </button>
                        </div>
                        @endif
                    </div>
                    @empty
                    <p class="text-center text-gray-400 text-sm py-16">Belum ada data kunjungan ANC.</p>
                    @endforelse
                </div>

                {{-- ── SKRINING ── --}}
                <div x-show="tab === 'skrining'" class="space-y-3">
                    @forelse($this->selectedUser->screening as $s)
                    <div class="border border-gray-100 rounded-xl p-4">
                        @if($editingRecordType === 'screening' && $editingRecordId === $s->id_screening)
                        {{-- EDIT FORM --}}
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Tanggal Skrining</label>
                                    <input wire:model="recordForm.date_screening" type="date"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.date_screening') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.date_screening')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Hemoglobin (g/dL)</label>
                                    <input wire:model="recordForm.hemoglobin" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.hemoglobin') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.hemoglobin')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Berat Badan (kg)</label>
                                    <input wire:model="recordForm.weight" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.weight') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.weight')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Tinggi Badan (cm)</label>
                                    <input wire:model="recordForm.height" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.height') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.height')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Keluhan</label>
                                <textarea wire:model="recordForm.complaint" rows="2"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all resize-none
                                           {{ $errors->has('recordForm.complaint') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"></textarea>
                                @error('recordForm.complaint')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center gap-2">
                                <button wire:click="saveRecord" class="flex-1 py-2.5 rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-bold text-sm transition-all">Simpan</button>
                                <button wire:click="cancelEditRecord" class="px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 font-semibold text-sm transition-all">Batal</button>
                            </div>
                        </div>
                        @else
                        {{-- TAMPILAN --}}
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
                        <div class="flex items-center gap-4 mt-3 pt-3 border-t border-gray-50">
                            <button wire:click="editRecord('screening', {{ $s->id_screening }})"
                                class="text-xs font-semibold text-violet-500 hover:text-violet-700 transition-colors">
                                Edit
                            </button>
                            <button
                                @click="confirmAction('Hapus data skrining tanggal {{ $s->date_screening->translatedFormat('d F Y') }}?').then(ok => ok && $wire.deleteRecord('screening', {{ $s->id_screening }}))"
                                class="text-xs font-semibold text-red-400 hover:text-red-600 transition-colors">
                                Hapus
                            </button>
                        </div>
                        @endif
                    </div>
                    @empty
                    <p class="text-center text-gray-400 text-sm py-16">Belum ada data skrining.</p>
                    @endforelse
                </div>

                {{-- ── PERSALINAN ── --}}
                <div x-show="tab === 'persalinan'" class="space-y-3">
                    @forelse($this->selectedUser->childbirth as $c)
                    <div class="border border-gray-100 rounded-xl p-4">
                        @if($editingRecordType === 'childbirth' && $editingRecordId === $c->id_childbirth)
                        {{-- EDIT FORM --}}
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Tanggal Persalinan</label>
                                    <input wire:model="recordForm.date_childbirth" type="date"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.date_childbirth') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.date_childbirth')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Usia Kehamilan (minggu)</label>
                                    <input wire:model="recordForm.gestational_age" type="number"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.gestational_age') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.gestational_age')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Tempat Persalinan</label>
                                <select wire:model="recordForm.place"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                           {{ $errors->has('recordForm.place') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    <option>Puskesmas</option>
                                    <option>Rumah Sakit</option>
                                    <option>Klinik</option>
                                    <option>Bidan Praktik</option>
                                    <option>Rumah</option>
                                    <option>Lainnya</option>
                                </select>
                                @error('recordForm.place')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Jenis Persalinan</label>
                                    <select wire:model="recordForm.type"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                               {{ $errors->has('recordForm.type') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                        <option value="Normal">Normal</option>
                                        <option value="SC">Section Caesarea (SC)</option>
                                    </select>
                                    @error('recordForm.type')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Penolong</label>
                                    <select wire:model="recordForm.helper"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                               {{ $errors->has('recordForm.helper') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                        <option>Bidan</option>
                                        <option>Dokter</option>
                                        <option>Dukun</option>
                                        <option>Lainnya</option>
                                    </select>
                                    @error('recordForm.helper')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Keadaan Ibu</label>
                                <select wire:model="recordForm.condition"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                           {{ $errors->has('recordForm.condition') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    <option value="Sehat">Sehat</option>
                                    <option value="Sakit">Sakit</option>
                                </select>
                                @error('recordForm.condition')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Komplikasi</label>
                                <input wire:model="recordForm.complication" type="text" placeholder="Tidak ada"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                           {{ $errors->has('recordForm.complication') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                @error('recordForm.complication')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Catatan</label>
                                <textarea wire:model="recordForm.notes" rows="2"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all resize-none
                                           {{ $errors->has('recordForm.notes') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}"></textarea>
                                @error('recordForm.notes')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center gap-2">
                                <button wire:click="saveRecord" class="flex-1 py-2.5 rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-bold text-sm transition-all">Simpan</button>
                                <button wire:click="cancelEditRecord" class="px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 font-semibold text-sm transition-all">Batal</button>
                            </div>
                        </div>
                        @else
                        {{-- TAMPILAN --}}
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
                        <div class="flex items-center gap-4 mt-3 pt-3 border-t border-gray-50">
                            <button wire:click="editRecord('childbirth', {{ $c->id_childbirth }})"
                                class="text-xs font-semibold text-violet-500 hover:text-violet-700 transition-colors">
                                Edit
                            </button>
                            <button
                                @click="confirmAction('Hapus data persalinan tanggal {{ $c->date_childbirth->translatedFormat('d F Y') }}?').then(ok => ok && $wire.deleteRecord('childbirth', {{ $c->id_childbirth }}))"
                                class="text-xs font-semibold text-red-400 hover:text-red-600 transition-colors">
                                Hapus
                            </button>
                        </div>
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
                        @if($editingRecordType === 'baby' && $editingRecordId === $b->id_baby)
                        {{-- EDIT FORM --}}
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Nama Bayi</label>
                                <input wire:model="recordForm.name" type="text"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                           {{ $errors->has('recordForm.name') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                @error('recordForm.name')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Jenis Kelamin</label>
                                    <select wire:model="recordForm.gender"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none appearance-none bg-white transition-all
                                               {{ $errors->has('recordForm.gender') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('recordForm.gender')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Waktu Lahir</label>
                                    <input wire:model="recordForm.time_birth" type="time"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.time_birth') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.time_birth')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">Tanggal Lahir</label>
                                <input wire:model="recordForm.date_birth" type="date"
                                    class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                           {{ $errors->has('recordForm.date_birth') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                @error('recordForm.date_birth')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Berat Lahir (gram)</label>
                                    <input wire:model="recordForm.weight" type="number"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.weight') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.weight')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Panjang Lahir (cm)</label>
                                    <input wire:model="recordForm.height" type="number" step="0.1"
                                        class="w-full px-3 py-2.5 rounded-lg border text-sm text-gray-800 outline-none transition-all
                                               {{ $errors->has('recordForm.height') ? 'border-rose-400 ring-2 ring-rose-100' : 'border-gray-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100' }}">
                                    @error('recordForm.height')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button wire:click="saveRecord" class="flex-1 py-2.5 rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-bold text-sm transition-all">Simpan</button>
                                <button wire:click="cancelEditRecord" class="px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 font-semibold text-sm transition-all">Batal</button>
                            </div>
                        </div>
                        @else
                        {{-- TAMPILAN --}}
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
                        <div class="flex items-center gap-4 mt-3 pt-3 border-t border-gray-50">
                            <button wire:click="editRecord('baby', {{ $b->id_baby }})"
                                class="text-xs font-semibold text-violet-500 hover:text-violet-700 transition-colors">
                                Edit
                            </button>
                            <button
                                @click="confirmAction('Hapus data bayi ' + @js($b->name) + '?').then(ok => ok && $wire.deleteRecord('baby', {{ $b->id_baby }}))"
                                class="text-xs font-semibold text-red-400 hover:text-red-600 transition-colors">
                                Hapus
                            </button>
                        </div>
                        @endif
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
