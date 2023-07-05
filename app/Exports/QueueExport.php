<?php

namespace App\Exports;

use App\Models\AsterisCdrModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class QueueExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        // return view('queueTable', ['results' => Session::get('queues')] );

        $query = AsterisCdrModel::select(['calldate', 'src', 'dst', 'dstchannel', 'disposition', 'duration', 'billsec'])
                                    ->where('disposition', 'ANSWERED');


        if (Session::get('selectedDateFrom') != null) {
            $query->whereDate('calldate', '>=', Session::get('selectedDateFrom'));
        }
        if (Session::get('selectedDateTo') != null) {
            $query->whereDate('calldate', '<=', Session::get('selectedDateTo'));
        }

        $details = $query->get();

        return view('queueDetailsTable', ['details' =>  $details] );
    }
}
