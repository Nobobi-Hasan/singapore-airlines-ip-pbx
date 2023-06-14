<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class QueueExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('queueTable', ['results' => Session::get('queues')] );
    }
}
