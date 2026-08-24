<?php

namespace App\Exports\Sheets;

use App\Models\Screening;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataSkriningSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    private int $no = 0;

    public function collection(): Collection
    {
        return Screening::with('user.chUser')
            ->orderBy('date_screening')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No', 'Nama', 'Tanggal Skrining', 'Berat Badan (kg)', 'Tinggi Badan (cm)',
            'Hemoglobin (g/dL)', 'Diagnosis', 'Keluhan',
        ];
    }

    public function map($s): array
    {
        return [
            ++$this->no,
            $s->user?->chUser?->fullname ?? $s->user?->name,
            $s->date_screening?->format('d-m-Y'),
            $s->weight,
            $s->height,
            $s->hemoglobin,
            $s->diagnosis['kategori'] ?? null,
            $s->complaint,
        ];
    }

    public function title(): string
    {
        return 'Data Skrining';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
