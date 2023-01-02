<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function getSalarySlip(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $salarySlip = DB::select("SELECT a.*, b.name AS username 
            FROM salaries a left join users b ON a.user_id=b.id WHERE a.user_id='{$request->user_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['salary_slip'] = $salarySlip;
        return response()->json($jsonArray);
    }
}
