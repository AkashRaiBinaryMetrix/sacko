<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Hash;
use Auth;
use Helper;
use DB;

class DashboardController extends Controller
{
    public function getIndex()
    {   
        $user 	=   \App\Models\User::where('id',Auth::user()->id)->first();
        $role	=	AdminMenuController::userMenus($user->role_id);
        Session::put('role',$user->role_id);

        $attendances = DB::table('attendances')->get();

        return view('admin.dashboard.index', compact(['user']), ['attendances' => $attendances]);
    }

    public function getTodayAttendanceData(Request $request){
        //check if absent

        //check if employee is on leave  
        $user   =   \App\Models\User::where('id',Auth::user()->id)->first();
        $punch_date = $request->punch_date;

        $result = DB::table('leaves')
                    ->whereDate('from_date', $punch_date)
                    ->orWhereDate('to_date', $punch_date)
                    ->get();

        if(count($result) == 0){
            //check if current date punch-in done or not done
            $result = DB::table('attendances')
                    ->where('punch_in', $punch_date)
                    ->get();

            echo count($result);          
        }
    }
}
