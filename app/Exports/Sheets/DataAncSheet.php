<?php

namespace App\Exports\Sheets;

use App\Models\Pregnancy;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataAncSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    private int $no = 0;

    public function collection(): Collection
    {
        return Pregnancy::with('user.chUser')
            ->orderBy('date_pregnancy')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No', 'Nama Ibu', 'Tanggal Kunjungan', 'Usia Kehamilan (minggu)', 'HPHT',
            'Hemoglobin (g/dL)', 'Berat Badan (kg)', 'Tinggi Badan (cm)',
            'Tekanan Darah (mmHg)', 'LILA (cm)', 'Konsumsi TTD/MMS', 'Diagnosis', 'Catatan',
        ];
    }

    public function map($p): array
    {
        return [
            ++$this->no,
            $p->user?->chUser?->fullname ?? $p->user?->name,
            $p->date_pregnancy?->format('d-m-Y'),
            $p->gestational_age,
            $p->hpht?->format('d-m-Y'),
            $p->hemoglobin,
            $p->weight,
            $p->height,
            ($p->systolic && $p->diastolic) ? "{$p->systolic}/{$p->diastolic}" : null,
            $p->lila,
            is_null($p->took_iron_supplement) ? null : ($p->took_iron_supplement ? 'Ya' : 'Tidak'),
            $p->diagnosis['kategori'] ?? null,
            $p->notes,
        ];
    }

    public function title(): string
    {
        return 'Data ANC';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
