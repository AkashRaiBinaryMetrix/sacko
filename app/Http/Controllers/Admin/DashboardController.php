<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Hash;
use Helper;

class DashboardController extends Controller
{
    public function getIndex()
    {   
        $user       = \App\Models\User::where('role_id', '1')->count();
        $employee   = \App\Models\User::where('role_id', '3')->count();
        $lineChart  = \App\Models\User::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"),\DB::raw('max(created_at) as createdAt'))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month_name')
                    ->orderBy('createdAt')
                    ->get();
                    
        $line = array();
        for($i=0; $i<=5; $i++)
        {
            $line[$i]['year']  = date("M",strtotime("-".$i." month"));
            $line[$i]['count'] = \App\Models\User::select(\DB::raw("COUNT(*) as count"))->whereMonth('created_at', date("m",strtotime("-".$i." month")))->whereYear('created_at',date("Y"))->first()['count'];
        }
        //echo "<pre>"; print_r($line); die;
        return view('admin.dashboard.index', compact(['user', 'employee', 'lineChart','line']));
    }

    // public function getUsersGraphData(Request $request)
    // {
    //     $labels = $users = [];
    //     $date_range = getDaysBetweenDates($request->start_date, $request->end_date);

    //     $result = \App\Models\User::select(\DB::raw('COUNT(id) AS users, DATE(created_at) AS label'))
    //         ->whereBetween(\DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
    //         ->groupBy(\DB::raw('DATE(created_at)'))
    //         ->pluck('users', 'label')
    //         ->toArray();

    //     foreach ($date_range as $date) {
    //         $labels[] = date('Y') == date('Y', strtotime($date)) ? date('d-M', strtotime($date)) : date('d-M-y', strtotime($date));
    //         $users[] = (int) @$result[$date];
    //     }

    //     return response()->json(compact('labels', 'users'));
    // }

    
}
