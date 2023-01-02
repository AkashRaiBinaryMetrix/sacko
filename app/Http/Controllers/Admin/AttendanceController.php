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

}
