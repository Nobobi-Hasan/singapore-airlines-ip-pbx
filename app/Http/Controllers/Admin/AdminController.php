<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AsterisCdrModel;
use App\Models\AsterisUserModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function getAsterisUsers()
    {
        try {
            $astericUsers = AsterisUserModel::select('extension', 'name')
            ->get();
            if ($astericUsers) {
                return $astericUsers;
            } else {
                return response()->json(['success' => true, 'message' => 'Error occurred', 'error_message' => 'No HomeInternet found'], 201);
            }
        }catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred', 'error_message' => $e->getMessage()]);
        }
    }

    public function getAverageCallTimeOfAgent(Request $request)
    {
        try {

            $query = AsterisCdrModel::query()
                ->rightJoin('asteris.users', function ($join) {
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

            // $data = [];
            // foreach ($averageDurations as $averageDuration) {
            //     if($averageDuration->extension = 110)
            //     {

            //         $emp['extension'] = $averageDuration->extension;
            //         $emp['name'] = $averageDuration->name;
            //         $emp['outgoing'] = $averageDuration->outgoing;
            //         $emp['incomming'] = $averageDuration->incomming;
            //         $emp['totalTime'] = $averageDuration->totalTime;
            //         $emp['avgDuration'] = $averageDuration->avgDuration;

            //         array_push($data, $emp);
            //         // return $data;
            //     }
            // }
            // return $data;


            if ($averageDurations) {
                return view('agent', compact('averageDurations'));
            } else {
                // return response()->json(['success' => true, 'message' => 'Error occurred', 'error_message' => 'No HomeInternet found'], 201);
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
                // return response()->json(['success' => true, 'message' => 'Error occurred', 'error_message' => 'No HomeInternet found'], 201);
                return view('agent', compact('averageDurations'));
            }


        }catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred', 'error_message' => $e->getMessage()]);
        }
    }
}
