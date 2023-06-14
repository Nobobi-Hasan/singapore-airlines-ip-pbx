<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Controllers\Admin\DataController;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbandonmentExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('abandonmentTable', ['results' => Session::get('results')] );
        // return User::all();
    }
}
