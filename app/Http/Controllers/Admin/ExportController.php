<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminDataExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __invoke()
    {
        abort_unless(auth()->user()->is_admin, 403, 'Akses ditolak.');

        return Excel::download(new AdminDataExport, 'data-sidara-' . now()->format('Y-m-d') . '.xlsx');
    }
}
