<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Carbon\Carbon;
use App\Exports\ExportAttendance;
use Session;
use Validator;
use DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $datacountlists = \App\Models\Attendance::get();
        $attendance     = \App\Models\Attendance::select('attendances.*', 'users.name', 'users.mobile', 'users.employee_type', 'users.role_id', 'roles.name AS role_name')
                            ->leftJoin('users', 'users.id', '=', 'attendances.user_id')
                            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                            ->orderBy('created_at','DESC')
                            ->paginate(10);
        return view('admin.attendance.index', compact(['attendance', 'datacountlists']));
    }

    public function view(Request $request, $id='')
    {
        $attendance = \App\Models\Attendance::select('attendances.*', 'users.name', 'users.mobile', 'users.employee_type', 'users.role_id', 'roles.name AS role_name')
                            ->leftJoin('users', 'users.id', '=', 'attendances.user_id')
                            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                            ->find($id);
        return view('admin.attendance.view', compact(['attendance']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\Attendance::whereIn('id',$ids)->delete();
        Session::flash('message', 'Attendance Deleted Successfully! ');
        return redirect('admin/attendance');
    }

    public function exportAttendance(Request $request)
	{
        return Excel::download(new ExportAttendance, 'attendance.xlsx');
    }

    public function markAttendance(Request $request){
        $mark_state = $request->mark_state;
        $current_date = $request->current_date;
        $current_time = $request->current_time;
        $ampm = $request->ampm;
        $emp_id = Auth::user()->id;

        if($mark_state == "in"){
            //punch-in
            $aData = [
                'user_id' => $emp_id,
                'punch_in' => $current_date,
                'punchin_time' => $current_time,
                'punchin_time_ampm' => $ampm
            ];

            $iId = DB::table('attendances')->insertGetId($aData);
        }else{
            //punch-out
             DB::table('attendances')
                    ->where('user_id', $emp_id)
                    ->update(
                        array(
                            'punch_out' => $current_date,
                            'punchout_time' => $current_time,
                            'punchout_time_ampm' => $ampm
                    ));
        }

        return redirect()->route('admin.dashboard');

    }

}
