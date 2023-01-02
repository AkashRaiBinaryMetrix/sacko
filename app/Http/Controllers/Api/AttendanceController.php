<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;


class AttendanceController extends Controller
{
    
    public function attendanceIn(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'   => 'required',
                                            ]);
        if ($v->fails())
        {
            $jsonArray['status'] = true;
            $jsonArray['message'] = $v->errors();
            return response()->json($jsonArray);  
        }
        else
        {
            try 
            {
                $attendanceIn            = new \App\Models\Attendance();
                $attendanceImage		 = 'storage/uploads/attendance/';
				$image			         = $request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	 = $image->getClientOriginalName();
					$ext1				 = $image->getClientOriginalExtension();				
					$temp1				 = explode(".",$headerImageName);				 
					$newHeaderLogo		 = 'image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		 = $attendanceImage.$newHeaderLogo;
					$image->move($attendanceImage,$newHeaderLogo);
					$attendanceIn->image = $headerTarget;
				}
                $attendanceIn->user_id        = $request['user_id'];
                $attendanceIn->punch_in       = $request['punch_in'];
                $attendanceIn->latitude       = $request['latitude'];
                $attendanceIn->longitude      = $request['longitude'];
                $attendanceIn->status         = $request['status'];
                $attendanceIn->save();
                if($attendanceIn->status=='1')
                {
                    $jsonArray['status'] = true;
                    $jsonArray['message'] = "Attendance In Successfully";
                    $jsonArray['result']['attendance'] = $attendanceIn;
                    return response()->json($jsonArray);
                }
                elseif($attendanceIn->status=='2')
                {
                    $jsonArray['status'] = true;
                    $jsonArray['message'] = "Attendance Weekly Off Successfully";
                    $jsonArray['result']['attendance'] = $attendanceIn;
                    return response()->json($jsonArray);
                }
                elseif($attendanceIn->status=='3')
                {
                    $jsonArray['status'] = true;
                    $jsonArray['message'] = "Attendance Market closed Successfully";
                    $jsonArray['result']['attendance'] = $attendanceIn;
                    return response()->json($jsonArray);
                }
                elseif($attendanceIn->status=='4')
                {
                    $jsonArray['status'] = true;
                    $jsonArray['message'] = "Attendance Working on Holiday Successfully";
                    $jsonArray['result']['attendance'] = $attendanceIn;
                    return response()->json($jsonArray);
                }
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
        
    }

    public function attendanceOut(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
                                            'attendance_id'     => 'required',
                                            ]);
        if ($v->fails())
        {
            $jsonArray['status'] = false;
            $jsonArray['message'] = $v->errors();
            return response()->json($jsonArray);  
        }
        else
        {
            try 
            {
                $attendanceOut              = \App\Models\Attendance::where('user_id',$request['user_id'])->where('id',$request['attendance_id'])->first();
                $attendanceImage		    = 'storage/uploads/attendance/';
				$image			            = $request->file('punch_out_image');    
				if(!empty($image))
				{				  
					$headerImageName	    = $image->getClientOriginalName();
					$ext1				    = $image->getClientOriginalExtension();				
					$temp1				    = explode(".",$headerImageName);				 
					$newHeaderLogo		    = 'image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		    = $attendanceImage.$newHeaderLogo;
					$image->move($attendanceImage,$newHeaderLogo);
					$attendanceOut->punch_out_image   = $headerTarget;
				}
                $attendanceOut->punch_out               = $request['punch_out'];
                $attendanceOut->latitude                = $request['latitude'];
                $attendanceOut->longitude               = $request['longitude'];
                $attendanceOut->save();
                $jsonArray['status']  = true;
                $jsonArray['message'] = "Attendance Out Successfully";
                $jsonArray['data']['edit_daily_task'] = $attendanceOut;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }
    
    public function viewAttendance(Request $request, $id='')
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $viewAttendance = \App\Models\Attendance::select('attendances.*', 'users.name AS username')
                        ->leftJoin('users', 'users.id', '=', 'attendances.user_id')
                        ->viewAttendanceByUserId($request->user_id);
        }
        else
        {
            $viewAttendance = \App\Models\Attendance::select('attendances.*', 'users.name AS username')
                        ->leftJoin('users', 'users.id', '=', 'attendances.user_id')
                        ->get();
        }
        $jsonArray['status'] = true;
        $jsonArray['message'] = "Success";
        $jsonArray['result']['view_attendance'] = $viewAttendance;
        return response()->json($jsonArray);
    }
    
    // public function getTotalAttendance(Request $request)
    // {
    //     if(isset($request['user_id']) && !empty($request['user_id']))
    //     {
    //         $totalAttendance = DB::select("SELECT a.*,b.name AS username,b.email,b.employee_id,b.mobile,
    //         (SELECT COUNT(id) FROM `attendances` WHERE `user_id` IN (SELECT id FROM `users` WHERE assign_tl=a.user_id))As TotalAttendances,
    //         (SELECT COUNT(id) FROM `attendances` WHERE `user_id` IN (SELECT id FROM `users` WHERE assign_tl=a.user_id) and date(created_at) = curdate()) As TodayAttendances
    //         FROM attendances a LEFT join  users b ON a.user_id=b.id WHERE a.user_id = '{$request->user_id}'");  
    //     }
    //     $jsonArray['status'] = true;
    //     $jsonArray['message'] = "Success";
    //     $jsonArray['data']['total_attendance'] = $totalAttendance;
    //     return response()->json($jsonArray);

    // }
    
    public function getTotalAttendance(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $totalAttendance = DB::select("SELECT 
            -- (SELECT COUNT(id) FROM `attendances` WHERE `user_id` IN (SELECT id FROM `users` WHERE assign_tl=a.user_id))As TotalAttendances,
            (SELECT COUNT(id) FROM `attendances` WHERE `user_id` IN (SELECT id FROM `users` WHERE assign_tl=a.user_id) and date(created_at) = curdate()) As today_attendance,
            (SELECT count(id) FROM `users` WHERE `assign_tl`=a.user_id) as total_users
            FROM attendances a LEFT join  users b ON a.user_id=b.id WHERE a.user_id = '{$request->user_id}'");  
        }
        $jsonArray['status'] = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']= $totalAttendance[0];
        return response()->json($jsonArray);

    }
    
    public function tlAttendanceUpdate(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
                                            'attendance_id'     => 'required',
                                            ]);
        if ($v->fails())
        {
            $jsonArray['status'] = false;
            $jsonArray['message'] = $v->errors();
            return response()->json($jsonArray);  
        }
        else
        {
            try 
            {
                $tlAttendanceUpdate              = \App\Models\Attendance::where('user_id',$request['user_id'])->where('id',$request['attendance_id'])->first();
                $tlAttendanceUpdate->punch_in    = $request['punch_in'];
                $tlAttendanceUpdate->punch_out   = $request['punch_out'];
                $tlAttendanceUpdate->status      = $request['status'];
                $tlAttendanceUpdate->save();
                $jsonArray['status']  = true;
                $jsonArray['message'] = "Attendance Updateed Successfully";
                $jsonArray['data']['tl_employee_attendance'] = $tlAttendanceUpdate;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }
    
   
    
    
    
    
}
