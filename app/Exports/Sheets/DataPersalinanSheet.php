<?php

namespace App\Exports\Sheets;

use App\Models\Childbirth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPersalinanSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    private int $no = 0;

    public function collection(): Collection
    {
        return Childbirth::with('user.chUser')
            ->orderBy('date_childbirth')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No', 'Nama Ibu', 'Tanggal Persalinan', 'Usia Kehamilan (minggu)', 'Tempat',
            'Jenis Persalinan', 'Penolong', 'Kondisi Ibu', 'Komplikasi', 'Catatan',
        ];
    }

    public function map($c): array
    {
        return [
            ++$this->no,
            $c->user?->chUser?->fullname ?? $c->user?->name,
            $c->date_childbirth?->format('d-m-Y'),
            $c->gestational_age,
            $c->place,
            $c->type,
            $c->helper,
            $c->condition,
            $c->complication,
            $c->notes,
        ];
    }

    public function title(): string
    {
        return 'Data Persalinan';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
