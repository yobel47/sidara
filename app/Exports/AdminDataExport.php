<?php

namespace App\Exports;

use App\Exports\Sheets\DataAncSheet;
use App\Exports\Sheets\DataBayiSheet;
use App\Exports\Sheets\DataPenggunaSheet;
use App\Exports\Sheets\DataPersalinanSheet;
use App\Exports\Sheets\DataSkriningSheet;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdminDataExport implements Export, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new DataPenggunaSheet,
            new DataAncSheet,
            new DataSkriningSheet,
            new DataPersalinanSheet,
            new DataBayiSheet,
        ];
    }
}
