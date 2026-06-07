<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Pregnancy;
use App\Models\Childbirth;
use App\Models\Baby;

class Profile extends Component
{
    public string $mode = 'view';

    // Hanya field yang bisa diedit
    public string $fullname = '';
    public string $username = '';
    public string $email    = '';
    public string $phone    = '';
    public string $address  = '';

    // Ganti password (opsional)
    public string $currentPassword           = '';
    public string $newPassword               = '';
    public string $newPasswordConfirmation   = '';

    // Data read-only untuk tampilan
    public array $kondisi = [];

    public function mount(): void
    {
        $this->loadEditableFields();
        $this->loadKondisi();
    }

    public function edit(): void
    {
        $this->loadEditableFields();
        $this->mode = 'edit';
    }

    public function cancel(): void
    {
        $this->loadEditableFields();
        $this->resetPasswordFields();
        $this->resetValidation();
        $this->mode = 'view';
    }

    public function simpan(): void
    {
        $userId = auth()->id();

        $this->validate([
            'fullname' => 'required|string|min:3|max:100',
            'username' => ['required', 'string', 'min:3', 'max:50', Rule::unique('users', 'username')->ignore($userId)],
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'phone'    => 'required|string|min:10|max:15',
            'address'  => 'required|string|min:5',
        ], [
            'fullname.required' => 'Nama lengkap wajib diisi.',
            'fullname.min'      => 'Nama minimal 3 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.min'      => 'Username minimal 3 karakter.',
            'username.unique'   => 'Username sudah digunakan.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah digunakan.',
            'phone.required'    => 'No. HP wajib diisi.',
            'phone.min'         => 'No. HP minimal 10 digit.',
            'address.required'  => 'Alamat wajib diisi.',
            'address.min'       => 'Alamat terlalu singkat.',
        ]);

        $user = auth()->user();

        $user->update([
            'name'     => $this->fullname,
            'username' => $this->username,
            'email'    => $this->email,
        ]);

        $user->chUser->update([
            'fullname' => $this->fullname,
            'phone'    => $this->phone,
            'address'  => $this->address,
        ]);

        // Ganti password jika diisi
        if ($this->newPassword !== '') {
            $this->validate([
                'currentPassword'         => 'required',
                'newPassword'             => 'required|string|min:6|same:newPasswordConfirmation',
                'newPasswordConfirmation' => 'required',
            ], [
                'currentPassword.required'         => 'Password saat ini wajib diisi.',
                'newPassword.required'             => 'Password baru wajib diisi.',
                'newPassword.min'                  => 'Password baru minimal 6 karakter.',
                'newPassword.same'                 => 'Konfirmasi password tidak cocok.',
                'newPasswordConfirmation.required' => 'Konfirmasi password wajib diisi.',
            ]);

            if (!Hash::check($this->currentPassword, $user->password)) {
                $this->addError('currentPassword', 'Password saat ini tidak sesuai.');
                return;
            }

            $user->update(['password' => Hash::make($this->newPassword)]);
        }

        $user->refresh();
        $this->loadKondisi();
        $this->resetPasswordFields();
        $this->mode = 'view';
        $this->dispatch('toast', message: 'Profil berhasil diperbarui.');
    }

    public function logout(): void
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect(route('login'), navigate: true);
    }

    private function resetPasswordFields(): void
    {
        $this->currentPassword         = '';
        $this->newPassword             = '';
        $this->newPasswordConfirmation = '';
    }

    private function loadEditableFields(): void
    {
        $user   = auth()->user();
        $chUser = $user->chUser;

        $this->fullname = $chUser->fullname ?? '';
        $this->username = $user->username ?? '';
        $this->email    = $user->email ?? '';
        $this->phone    = $chUser->phone ?? '';
        $this->address  = $chUser->address ?? '';
    }

    private function loadKondisi(): void
    {
        $userId = auth()->id();
        $chUser = auth()->user()->chUser;

        // Ambil kunjungan ANC terakhir berdasarkan created_at
        $latestAnc = Pregnancy::where('id_user', $userId)->latest('created_at')->first();

        // Status: prioritas Melahirkan > Hamil > Tidak Hamil
        $hasBirth = Childbirth::where('id_user', $userId)->exists();
        $hasBaby  = Baby::where('id_user', $userId)->exists();

        if ($hasBirth && $hasBaby) {
            $status      = 'Melahirkan';
            $statusColor = 'bg-green-100 text-green-700';
        } elseif ($chUser->statusPregnant === 'hamil') {
            $status      = 'Hamil';
            $statusColor = 'bg-rose-100 text-rose-600';
        } else {
            $status      = 'Tidak Hamil';
            $statusColor = 'bg-gray-100 text-gray-600';
        }

        $this->kondisi = [
            'usia'          => ($chUser->age ?? '-') . ' tahun',
            'tinggiBadan'   => $chUser->height ? number_format($chUser->height, 1) . ' cm' : '-',
            'beratBadan'    => $latestAnc
                ? number_format($latestAnc->weight, 1) . ' kg'
                : ($chUser->weight ? number_format($chUser->weight, 1) . ' kg' : '-'),
            'usiaKehamilan' => $latestAnc
                ? $latestAnc->gestational_age . ' minggu'
                : ($chUser->gestationalAge ? $chUser->gestationalAge : '-'),
            'fromAnc'       => $latestAnc !== null,
            'status'        => $status,
            'statusColor'   => $statusColor,
        ];
    }

    public function render()
    {
        return view('livewire.pages.profile', [
            'user'   => auth()->user(),
            'chUser' => auth()->user()->chUser,
        ])->layout('layouts.app', ['pageTitle' => 'Profil']);
    }
}
