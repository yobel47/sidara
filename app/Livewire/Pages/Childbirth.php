<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Childbirth as ChildbirthModel;
use App\Models\Pregnancy;

class Childbirth extends Component
{
    public string  $mode     = 'form'; // 'form' | 'view'
    public ?int    $recordId = null;
    public ?array  $viewData = null;

    // Form fields
    public string $dateChildbirth = '';
    public string $gestationalAge = '';
    public string $place          = 'Puskesmas';
    public string $type           = 'Normal';
    public string $helper         = 'Bidan';
    public string $condition      = 'Sehat';
    public string $complication   = 'Tidak ada';
    public string $notes          = '';

    public function mount(): void
    {
        $existing = ChildbirthModel::where('id_user', auth()->id())->first();

        if ($existing) {
            $this->mode     = 'view';
            $this->recordId = $existing->id_childbirth;
            $this->viewData = $this->toViewData($existing);
            return;
        }

        $this->dateChildbirth = now()->format('Y-m-d');

        // Usia kehamilan dari kunjungan ANC terakhir
        $lastVisit = Pregnancy::where('id_user', auth()->id())
            ->latest('date_pregnancy')
            ->orderByDesc('created_at')
            ->first();

        if ($lastVisit) {
            $this->gestationalAge = (string) $lastVisit->gestational_age;
        }
    }

    public function edit(): void
    {
        $existing = ChildbirthModel::find($this->recordId);
        if (!$existing) return;

        $this->dateChildbirth = $existing->date_childbirth->format('Y-m-d');
        $this->gestationalAge = (string) $existing->gestational_age;
        $this->place          = $existing->place;
        $this->type           = $existing->type;
        $this->helper         = $existing->helper;
        $this->condition      = $existing->condition;
        $this->complication   = $existing->complication ?? 'Tidak ada';
        $this->notes          = $existing->notes ?? '';
        $this->mode           = 'form';
    }

    public function simpan(): void
    {
        $this->validate([
            'dateChildbirth' => 'required|date',
            'gestationalAge' => 'required|integer|min:20|max:45',
            'place'          => 'required|string',
            'type'           => 'required|in:Normal,SC',
            'helper'         => 'required|in:Bidan,Dokter,Dukun,Lainnya',
            'condition'      => 'required|in:Sehat,Sakit',
            'complication'   => 'nullable|string|max:255',
            'notes'          => 'nullable|string|max:300',
        ], [
            'dateChildbirth.required' => 'Tanggal persalinan wajib diisi.',
            'dateChildbirth.date'     => 'Format tanggal persalinan tidak valid.',
            'gestationalAge.required' => 'Usia kehamilan wajib diisi.',
            'gestationalAge.integer'  => 'Usia kehamilan harus berupa angka.',
            'gestationalAge.min'      => 'Usia kehamilan minimal 20 minggu.',
            'gestationalAge.max'      => 'Usia kehamilan maksimal 45 minggu.',
            'place.required'          => 'Tempat persalinan wajib diisi.',
            'type.required'           => 'Jenis persalinan wajib dipilih.',
            'type.in'                 => 'Jenis persalinan tidak valid.',
            'helper.required'         => 'Penolong persalinan wajib dipilih.',
            'helper.in'               => 'Penolong persalinan tidak valid.',
            'condition.required'      => 'Keadaan ibu wajib dipilih.',
            'condition.in'            => 'Keadaan ibu tidak valid.',
            'complication.max'        => 'Komplikasi maksimal 255 karakter.',
            'notes.max'               => 'Catatan maksimal 300 karakter.',
        ]);

        $data = [
            'date_childbirth' => $this->dateChildbirth,
            'gestational_age' => (int) $this->gestationalAge,
            'place'           => $this->place,
            'type'            => $this->type,
            'helper'          => $this->helper,
            'condition'       => $this->condition,
            'complication'    => $this->complication ?: null,
            'notes'           => $this->notes ?: null,
        ];

        if ($this->recordId) {
            ChildbirthModel::where('id_childbirth', $this->recordId)->update($data);
        } else {
            $record         = ChildbirthModel::create(['id_user' => auth()->id()] + $data);
            $this->recordId = $record->id_childbirth;
        }

        $this->viewData = $this->toViewData(ChildbirthModel::find($this->recordId));
        $this->mode     = 'view';
    }

    private function toViewData(ChildbirthModel $record): array
    {
        return [
            'tanggal'       => $record->date_childbirth->translatedFormat('d F Y'),
            'usiaKehamilan' => $record->gestational_age . ' minggu',
            'place'         => $record->place,
            'type'          => $record->type === 'SC' ? 'Section Caesarea (SC)' : 'Normal',
            'helper'        => $record->helper,
            'condition'     => $record->condition,
            'complication'  => $record->complication ?? 'Tidak ada',
            'notes'         => $record->notes,
        ];
    }

    public function render()
    {
        return view('livewire.pages.childbirth')
            ->layout('layouts.app', ['pageTitle' => 'Persalinan']);
    }
}