<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AgentExport;
use App\Exports\QueueExport;
use App\Exports\AbandonmentExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    function exportAbandonment(){

        return Excel::download(new AbandonmentExport(), 'abandonment.xlsx');

    }
    function exportQueue(){

        return Excel::download(new QueueExport(), 'queue.xlsx');

    }
    function exportAgent(){

        return Excel::download(new AgentExport(), 'agent.xlsx');

    }
}
