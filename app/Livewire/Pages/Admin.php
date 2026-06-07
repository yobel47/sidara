<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\User;

class Admin extends Component
{
    use WithPagination;

    public string $search        = '';
    public ?int   $selectedUserId = null;

    public function mount(): void
    {
        $allowed = array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', ''))));

        if (empty($allowed) || !in_array(auth()->user()->email, $allowed)) {
            abort(403, 'Akses ditolak.');
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function lihatDetail(int $userId): void
    {
        $this->selectedUserId = $userId;
    }

    public function tutupDetail(): void
    {
        $this->selectedUserId = null;
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