<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\AbandonmentExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    function exportAbandonment(){

        return Excel::download(new AbandonmentExport(), 'abandonment.xlsx');

    }
}
