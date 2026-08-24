<?php

namespace App\Exports\Sheets;

use App\Models\Baby;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataBayiSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    private int $no = 0;

    public function collection(): Collection
    {
        return Baby::with('user.chUser')
            ->orderBy('date_birth')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No', 'Nama Bayi', 'Nama Ibu', 'Jenis Kelamin', 'Tanggal Lahir',
            'Waktu Lahir', 'Berat Lahir (gram)', 'Panjang Badan (cm)',
        ];
    }

    public function map($b): array
    {
        return [
            ++$this->no,
            $b->name,
            $b->user?->chUser?->fullname ?? $b->user?->name,
            $b->gender,
            $b->date_birth?->format('d-m-Y'),
            $b->time_birth ? substr($b->time_birth, 0, 5) : null,
            round($b->weight * 1000),
            $b->height,
        ];
    }

    public function title(): string
    {
        return 'Data Bayi';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
