<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AsterisCdrModel;
use App\Models\AsterisUserModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{

    public function getAverageCallTimeOfAgent(Request $request)
    {
        try {

            $query = AsterisCdrModel::query()
                ->rightJoin('asterisk.users', function ($join) {
                    $join->on('cdr.src', '=', 'users.extension')
                        ->orOn('cdr.dst', '=', 'users.extension');
                })
                ->select(
                    'users.extension',
                    'users.name',
                    DB::raw('count(CASE WHEN cdr.src = users.extension THEN cdr.src END) as outgoing'),
                    DB::raw('count(CASE WHEN cdr.dst = users.extension THEN cdr.dst END) as incomming'),
                    DB::raw('sum(cdr.duration) as totalTime'),
                    DB::raw('AVG(cdr.duration) as avgDuration')
                )
                ->groupBy('users.extension')
                ->groupBy('users.name')
                ->orderBy('users.extension');


            if ($request->search !== null) {
                $values = explode(",",$request->search);
                $query->whereIn('extension', $values);
                $query->orWhereIn('name', $values);
            }

            if ($request->date !== null) {
                $values = $request->date;
                $query->where('calldate','LIKE', $values.'%');
            }

            $averageDurations = $query->get();
            Session::put('averageDurations', $averageDurations);

            if ($averageDurations) {
                return view('agent', compact('averageDurations'));
            } else {
                return view('agent', compact('averageDurations'));
            }
        }catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred', 'error_message' => $e->getMessage()]);
        }
    }

    public function getAverageCallAbandonment(Request $request)
    {
        try {

            $totalCall = AsterisCdrModel::count();
            $receivedCall = AsterisCdrModel::where('disposition', 'ANSWERED')
                            ->count();
            $abandonCall = $totalCall - $receivedCall;


            if ($totalCall) {
                return $receivedCall;
            } else {
                return view('agent', compact('averageDurations'));
            }


        }catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred', 'error_message' => $e->getMessage()]);
        }
    }


    public function getCallAbandonment(Request $request)
    {
        $selectedDate = $request->input('date');

        $query = AsterisCdrModel::select(
            DB::raw('DATE(calldate) as date'),
            DB::raw('COUNT(*) as totalCalls'),
            DB::raw('SUM(CASE WHEN disposition != "ANSWERED" THEN 1 ELSE 0 END) as abandonedCalls')
        )
            ->groupBy('date')
            ->orderBy('date', 'desc');

        if ($selectedDate) {
            $query->whereDate('calldate', '=', $selectedDate);
        }

        $results = $query->get();
        Session::put('abandonments', $results);

        $totalCalls = $results->sum('totalCalls');
        $totalAbandonedCalls = $results->sum('abandonedCalls');
        $abandonedCallsPercentage = $totalCalls > 0 ? ($totalAbandonedCalls / $totalCalls) * 100 : 0;

        $responseData = [
            'results' => $results,
            'totalCalls' => $totalCalls,
            'totalAbandonedCalls' => $totalAbandonedCalls,
            'abandonedCallsPercentage' => $abandonedCallsPercentage,
            'selectedDate' => $selectedDate
        ];

        return view('abandonment', [
            'results' => $results,
            'totalCalls' => $totalCalls,
            'totalAbandonedCalls' => $totalAbandonedCalls,
            'abandonedCallsPercentage' => $abandonedCallsPercentage,
            'selectedDate' => $selectedDate
        ]);
    }

    public function getQueueTime(Request $request)
    {
        $selectedDateFrom = $request->input('date_from');
        $selectedDateTo = $request->input('date_to');

        $query = AsterisCdrModel::select(
            DB::raw('DATE(calldate) as date'),
            DB::raw('COUNT(*) as totalCalls'),
            DB::raw('SUM(duration) as totalDuration'),
            DB::raw('SUM(billsec) as totalBillsec'),

            DB::raw('SUM(duration) - SUM(billsec) as totalQueue' ),
            DB::raw('(SUM(duration) - SUM(billsec)) / COUNT(*) as averageQueue'),
        )
            ->where('disposition', 'ANSWERED')
            ->groupBy('date')
            ->orderBy('date', 'desc');

        Session::forget('selectedDateFrom');
        Session::forget('selectedDateTo');

        if ($selectedDateFrom) {
            $query->whereDate('calldate', '>=', $selectedDateFrom);
            Session::put('selectedDateFrom', $selectedDateFrom);
        }
        if ($selectedDateTo) {
            $query->whereDate('calldate', '<=', $selectedDateTo);
            Session::put('selectedDateTo', $selectedDateTo);
        }

        $results = $query->get();
        // Session::put('queues', $results);

        $totalCalls = $results->sum('totalCalls');
        $totalQueue = $results->sum('totalQueue');
        $totalAverageQueue = $totalCalls > 0 ? ($totalQueue / $totalCalls) : 0;

        $responseData = [
            'results' => $results,
            'totalCalls' => $totalCalls,
            'totalQueue' => $totalQueue,
            'totalAverageQueue' => $totalAverageQueue,
        ];


        return view('queue', [
            'results' => $results,
            'totalCalls' => $totalCalls,
            'totalQueue' => $totalQueue,
            'totalAverageQueue' => $totalAverageQueue,
        ]);
    }

    public function queueDetailsModal($date) {

        $details = AsterisCdrModel::select(['calldate', 'src', 'dst', 'dstchannel', 'disposition', 'duration', 'billsec'])
                                    ->where('disposition', 'ANSWERED')
                                    ->where('calldate','LIKE',"{$date}%")
                                    ->get();

        Session::put('queueDetails', $details);

        $first = '<table class="table table-hover fs-6">
                    <thead>
                        <tr>
                            <th scope="col">Call Start</th>
                            <th scope="col">Call Answered</th>
                            <th scope="col">Src</th>
                            <th scope="col">Dst Channel</th>
                            <th scope="col">Dst</th>
                            <th scope="col">Status</th>
                            <th scope="col">Queue Time(sec)</th>
                        </tr>
                    </thead>

                    <tbody>';

        $html = "";

        if($details){
            foreach($details as $detail){

                $queue = $detail->duration - $detail->billsec;

                $start = strtotime($detail->calldate);
                $callAnswered = date('Y-m-d H:i:s', $start + $queue);

                $htmlNew=
                '<tr>
                    <td>'.$detail->calldate.'</td>
                    <td>'.$callAnswered .'</td>
                    <td>'.$detail->src.'</td>
                    <td>'.$detail->dst.'</td>
                    <td>'.$detail->dstchannel.'</td>
                    <td>'.$detail->disposition.'</td>
                    <td>'.$queue.'</td>
                <tr>';

                $html = $html.$htmlNew;
            }
        }

        $last = '</tbody>
                </table>';

        $table = $first.$html.$last;

        $response = $table;

        return response()->json($response);

    }

}
