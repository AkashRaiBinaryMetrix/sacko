<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Validator;

class TeamLeadController extends Controller
{
    public function getTeamLeadEmployeeList(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $teamLeadEmployeeList = DB::select("SELECT a.id,a.employee_id,a.name,a.email,a.mobile,a.image,a.address,a.status,a.assign_tl,a.employee_type,a.created_at,a.updated_at
            FROM users a  WHERE a.assign_tl='{$request->user_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['tl_employee_list'] = $teamLeadEmployeeList;
        return response()->json($jsonArray);
    }
    
    public function getEmployeeList(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $employeeList = DB::select("SELECT a.id,a.employee_id,a.name,a.email,a.mobile,a.image,a.address,a.status,a.assign_tl,a.employee_type,a.created_at,a.updated_at
            FROM users a  WHERE a.id='{$request->user_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['employee_list'] = $employeeList;
        return response()->json($jsonArray);
    }
}
