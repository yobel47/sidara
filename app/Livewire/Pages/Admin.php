<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\User;
use App\Models\ChUser;
use App\Models\Pregnancy;
use App\Models\Screening;
use App\Models\Childbirth;
use App\Models\Baby;

class Admin extends Component
{
    use WithPagination;

    public string $search        = '';
    public ?int   $selectedUserId = null;
    public string $adminNotice   = '';

    // Edit Profil (ChUser)
    public bool  $editingProfile = false;
    public array $profileForm    = [];

    // Edit satu record (pregnancy/screening/childbirth/baby) — hanya satu yang aktif sekaligus
    public ?string $editingRecordType = null;
    public ?int    $editingRecordId   = null;
    public array   $recordForm        = [];

    public function mount(): void
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Akses ditolak.');
        }
    }

    public function toggleAdmin(int $userId): void
    {
        if ($userId === auth()->id()) {
            $this->adminNotice = 'Tidak bisa mengubah status admin akun sendiri.';
            return;
        }

        $user = User::findOrFail($userId);

        if ($user->is_admin) {
            if (User::where('is_admin', true)->count() <= 1) {
                $this->adminNotice = 'Minimal harus ada satu admin yang tersisa.';
                return;
            }
            $user->update(['is_admin' => false]);
            $this->adminNotice = "{$user->name} tidak lagi menjadi admin.";
        } else {
            $user->update(['is_admin' => true]);
            $this->adminNotice = "{$user->name} sekarang menjadi admin.";
        }
    }

    public function deleteUser(int $userId): void
    {
        if ($userId === auth()->id()) {
            $this->adminNotice = 'Tidak bisa menghapus akun sendiri.';
            return;
        }

        $user = User::find($userId);
        if (!$user) return;

        $name = $user->chUser?->fullname ?? $user->name;
        $user->delete(); // cascade: ch_user, pregnancy, screening, childbirth, baby ikut terhapus

        if ($this->selectedUserId === $userId) {
            $this->selectedUserId = null;
        }

        $this->adminNotice = "Akun {$name} beserta seluruh datanya berhasil dihapus.";
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function lihatDetail(int $userId): void
    {
        $this->selectedUserId = $userId;
        $this->editingProfile = false;
        $this->cancelEditRecord();
    }

    public function tutupDetail(): void
    {
        $this->selectedUserId = null;
        $this->editingProfile = false;
        $this->cancelEditRecord();
    }

    // ── EDIT PROFIL (ChUser) ────────────────────────────────

    public function editProfile(): void
    {
        $ch = $this->selectedUser?->chUser;
        if (!$ch) return;

        $this->profileForm = [
            'fullname'       => $ch->fullname,
            'address'        => $ch->address,
            'age'            => (string) $ch->age,
            'phone'          => $ch->phone,
            'weight'         => (string) $ch->weight,
            'height'         => (string) $ch->height,
            'statusPregnant' => $ch->statusPregnant,
            'gestationalAge' => $ch->gestationalAge ?? '',
            'maritalStatus'  => $ch->maritalStatus ?? '',
            'weddingDate'    => $ch->weddingDate?->format('Y-m-d') ?? '',
        ];
        $this->editingProfile = true;
    }

    public function cancelEditProfile(): void
    {
        $this->editingProfile = false;
        $this->resetErrorBag();
    }

    public function saveProfile(): void
    {
        $rules = [
            'profileForm.fullname'       => 'required|string|min:3|max:100',
            'profileForm.address'        => 'required|string|min:5',
            'profileForm.age'            => 'required|integer|min:10|max:60',
            'profileForm.phone'          => 'required|string|min:10|max:15',
            'profileForm.weight'         => 'required|numeric|min:20|max:200',
            'profileForm.height'         => 'required|numeric|min:100|max:250',
            'profileForm.statusPregnant' => 'required|in:hamil,tidak_hamil',
            'profileForm.maritalStatus'  => 'required|in:sudah_menikah,belum_menikah',
            'profileForm.weddingDate'    => 'nullable|date|required_if:profileForm.maritalStatus,sudah_menikah',
        ];

        if ($this->profileForm['statusPregnant'] === 'hamil') {
            $rules['profileForm.gestationalAge'] = 'required|string';
        }

        $this->validate($rules, [
            'profileForm.fullname.required'       => 'Nama lengkap wajib diisi.',
            'profileForm.address.required'        => 'Alamat wajib diisi.',
            'profileForm.age.required'             => 'Usia wajib diisi.',
            'profileForm.phone.required'           => 'No. HP wajib diisi.',
            'profileForm.weight.required'          => 'Berat badan wajib diisi.',
            'profileForm.height.required'          => 'Tinggi badan wajib diisi.',
            'profileForm.statusPregnant.required'  => 'Status hamil wajib dipilih.',
            'profileForm.gestationalAge.required'  => 'Usia kehamilan wajib diisi.',
            'profileForm.maritalStatus.required'   => 'Status pernikahan wajib dipilih.',
            'profileForm.weddingDate.required_if'  => 'Tanggal pernikahan wajib diisi.',
        ]);

        ChUser::where('id_user', $this->selectedUserId)->update([
            'fullname'       => $this->profileForm['fullname'],
            'address'        => $this->profileForm['address'],
            'age'            => (int) $this->profileForm['age'],
            'phone'          => $this->profileForm['phone'],
            'weight'         => (float) $this->profileForm['weight'],
            'height'         => (float) $this->profileForm['height'],
            'statusPregnant' => $this->profileForm['statusPregnant'],
            'gestationalAge' => $this->profileForm['statusPregnant'] === 'hamil' ? $this->profileForm['gestationalAge'] : null,
            'maritalStatus'  => $this->profileForm['maritalStatus'],
            'weddingDate'    => $this->profileForm['maritalStatus'] === 'sudah_menikah' ? $this->profileForm['weddingDate'] : null,
        ]);

        $this->editingProfile = false;
        $this->adminNotice    = 'Data profil berhasil diperbarui.';
    }

    // ── EDIT / HAPUS RECORD (pregnancy/screening/childbirth/baby) ──

    private function recordModel(string $type): string
    {
        return match ($type) {
            'pregnancy'  => Pregnancy::class,
            'screening'  => Screening::class,
            'childbirth' => Childbirth::class,
            'baby'       => Baby::class,
        };
    }

    public function editRecord(string $type, int $id): void
    {
        $modelClass = $this->recordModel($type);
        $record     = $modelClass::find($id);
        if (!$record) return;

        $this->recordForm = match ($type) {
            'pregnancy' => [
                'date_pregnancy'  => $record->date_pregnancy->format('Y-m-d'),
                'gestational_age' => (string) $record->gestational_age,
                'hemoglobin'      => (string) $record->hemoglobin,
                'weight'          => (string) $record->weight,
                'notes'           => $record->notes ?? '',
            ],
            'screening' => [
                'date_screening' => $record->date_screening->format('Y-m-d'),
                'weight'         => (string) $record->weight,
                'height'         => (string) $record->height,
                'hemoglobin'     => (string) $record->hemoglobin,
                'complaint'      => $record->complaint,
            ],
            'childbirth' => [
                'date_childbirth' => $record->date_childbirth->format('Y-m-d'),
                'gestational_age' => (string) $record->gestational_age,
                'place'           => $record->place,
                'type'            => $record->type,
                'helper'          => $record->helper,
                'condition'       => $record->condition,
                'complication'    => $record->complication ?? '',
                'notes'           => $record->notes ?? '',
            ],
            'baby' => [
                'name'       => $record->name,
                'gender'     => $record->gender,
                'date_birth' => $record->date_birth->format('Y-m-d'),
                'time_birth' => $record->time_birth ? substr($record->time_birth, 0, 5) : '',
                'weight'     => (string) round($record->weight * 1000), // gram, biar konsisten sama form ibu
                'height'     => (string) $record->height,
            ],
        };

        $this->editingRecordType = $type;
        $this->editingRecordId   = $id;
    }

    public function cancelEditRecord(): void
    {
        $this->editingRecordType = null;
        $this->editingRecordId   = null;
        $this->recordForm        = [];
        $this->resetErrorBag();
    }

    public function saveRecord(): void
    {
        $type = $this->editingRecordType;

        $rules = match ($type) {
            'pregnancy' => [
                'recordForm.date_pregnancy'  => 'required|date',
                'recordForm.gestational_age' => 'required|integer|min:1|max:42',
                'recordForm.hemoglobin'      => 'required|numeric|min:1|max:25',
                'recordForm.weight'          => 'required|numeric|min:20|max:200',
                'recordForm.notes'           => 'nullable|string|max:500',
            ],
            'screening' => [
                'recordForm.date_screening' => 'required|date',
                'recordForm.weight'         => 'required|numeric|min:20|max:200',
                'recordForm.height'         => 'required|numeric|min:100|max:250',
                'recordForm.hemoglobin'     => 'required|numeric|min:1|max:25',
                'recordForm.complaint'      => 'required|string|min:3',
            ],
            'childbirth' => [
                'recordForm.date_childbirth' => 'required|date',
                'recordForm.gestational_age' => 'required|integer|min:20|max:45',
                'recordForm.place'           => 'required|string',
                'recordForm.type'            => 'required|in:Normal,SC',
                'recordForm.helper'          => 'required|in:Bidan,Dokter,Dukun,Lainnya',
                'recordForm.condition'       => 'required|in:Sehat,Sakit',
                'recordForm.complication'    => 'nullable|string|max:255',
                'recordForm.notes'           => 'nullable|string|max:300',
            ],
            'baby' => [
                'recordForm.name'       => 'required|string|max:100',
                'recordForm.gender'     => 'required|in:Laki-laki,Perempuan',
                'recordForm.date_birth' => 'required|date',
                'recordForm.time_birth' => 'nullable|date_format:H:i',
                'recordForm.weight'     => 'required|numeric|min:500|max:10000',
                'recordForm.height'     => 'required|numeric|min:20|max:70',
            ],
            default => [],
        };

        $this->validate($rules);

        $data = match ($type) {
            'pregnancy' => [
                'date_pregnancy'  => $this->recordForm['date_pregnancy'],
                'gestational_age' => (int) $this->recordForm['gestational_age'],
                'hemoglobin'      => (float) $this->recordForm['hemoglobin'],
                'weight'          => (float) $this->recordForm['weight'],
                'notes'           => $this->recordForm['notes'] ?: null,
            ],
            'screening' => [
                'date_screening' => $this->recordForm['date_screening'],
                'weight'         => (float) $this->recordForm['weight'],
                'height'         => (float) $this->recordForm['height'],
                'hemoglobin'     => (float) $this->recordForm['hemoglobin'],
                'complaint'      => $this->recordForm['complaint'],
            ],
            'childbirth' => [
                'date_childbirth' => $this->recordForm['date_childbirth'],
                'gestational_age' => (int) $this->recordForm['gestational_age'],
                'place'           => $this->recordForm['place'],
                'type'            => $this->recordForm['type'],
                'helper'          => $this->recordForm['helper'],
                'condition'       => $this->recordForm['condition'],
                'complication'    => $this->recordForm['complication'] ?: null,
                'notes'           => $this->recordForm['notes'] ?: null,
            ],
            'baby' => [
                'name'       => $this->recordForm['name'],
                'gender'     => $this->recordForm['gender'],
                'date_birth' => $this->recordForm['date_birth'],
                'time_birth' => $this->recordForm['time_birth'] ?: null,
                'weight'     => (float) $this->recordForm['weight'] / 1000,
                'height'     => (float) $this->recordForm['height'],
            ],
        };

        $modelClass = $this->recordModel($type);
        $modelClass::find($this->editingRecordId)?->update($data);

        $this->cancelEditRecord();
        $this->adminNotice = 'Data berhasil diperbarui.';
    }

    public function deleteRecord(string $type, int $id): void
    {
        $modelClass = $this->recordModel($type);
        $modelClass::destroy($id);

        if ($this->editingRecordType === $type && $this->editingRecordId === $id) {
            $this->cancelEditRecord();
        }

        $this->adminNotice = 'Data berhasil dihapus.';
    }

    #[Computed]
    public function selectedUser(): ?User
    {
        if (!$this->selectedUserId) return null;

        return User::with([
            'chUser',
            'pregnancy'  => fn($q) => $q->orderBy('date_pregnancy', 'desc'),
            'screening'  => fn($q) => $q->orderBy('date_screening', 'desc'),
            'childbirth' => fn($q) => $q->orderBy('date_childbirth', 'desc'),
            'baby'       => fn($q) => $q->orderBy('date_birth', 'desc'),
        ])->find($this->selectedUserId);
    }

    public function render()
    {
        $users = User::with('chUser')
            ->withCount(['pregnancy', 'screening', 'childbirth', 'baby'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('username', 'like', "%{$this->search}%")
                    ->orWhereHas('chUser', function ($q2) {
                        $q2->where('fullname', 'like', "%{$this->search}%")
                            ->orWhere('phone', 'like', "%{$this->search}%");
                    });
                });
            })
            ->latest()
            ->paginate(20);

        return view('livewire.pages.admin', ['users' => $users])
            ->layout('layouts.admin', ['pageTitle' => 'Admin — SI DARA']);
    }
}
