<?php

namespace App\Exports\Sheets;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPenggunaSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    private int $no = 0;

    public function collection(): Collection
    {
        return User::with('chUser')
            ->withCount(['pregnancy', 'screening', 'childbirth', 'baby'])
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'No', 'Nama Lengkap', 'Username', 'Email', 'No. HP', 'Usia',
            'Berat Badan (kg)', 'Tinggi Badan (cm)', 'Status Hamil', 'Usia Kehamilan',
            'Status Pernikahan', 'Jumlah ANC', 'Jumlah Skrining', 'Jumlah Persalinan',
            'Jumlah Bayi', 'Admin',
        ];
    }

    public function map($user): array
    {
        $ch = $user->chUser;

        return [
            ++$this->no,
            $ch?->fullname ?? $user->name,
            $user->username,
            $user->email,
            $ch?->phone,
            $ch?->age,
            $ch?->weight,
            $ch?->height,
            $ch === null ? null : ($ch->statusPregnant === 'hamil' ? 'Hamil' : 'Tidak Hamil'),
            $ch?->gestationalAge,
            match ($ch?->maritalStatus) {
                'sudah_menikah' => 'Sudah Menikah',
                'belum_menikah' => 'Belum Menikah',
                default         => null,
            },
            $user->pregnancy_count,
            $user->screening_count,
            $user->childbirth_count,
            $user->baby_count,
            $user->is_admin ? 'Ya' : 'Tidak',
        ];
    }

    public function title(): string
    {
        return 'Data Pengguna';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
