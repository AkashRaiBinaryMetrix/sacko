<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

class LeaveTypeController extends Controller
{
    public function leaveType(Request $request)
    {
        $leaveType = \App\Models\LeaveType::select(['id','name'])->get();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "Success !";
        $jsonArray['data']['leave_type'] = $leaveType;
        return response()->json($jsonArray);
    }
    
    // public function myLeave(Request $request)
    // {
    //     if(isset($request['user_id']) && !empty($request['user_id']))
    //     {
    //         $myLeave = \App\Models\Leave::select('leaves.*', 'users.name AS username')
    //                     ->leftJoin('users', 'users.id', '=', 'leaves.user_id')
    //                     ->viewMyLeaveByUserId($request->user_id);

    //         $jsonArray['status'] = true;
    //         $jsonArray['message'] = "Success";
    //         $jsonArray['data']['My Leave'] = $myLeave;
    //         return response()->json($jsonArray);
    //     }

    // }
    
    public function myLeave(Request $request)
    {
        $myLeave = \App\Models\Leave::select('leaves.*', 'users.name AS username','leave_types.name AS leave_type')
        ->leftJoin('users','users.id','=','leaves.user_id')
        ->leftJoin('leave_types','leave_types.id','=','leaves.leave_type_id')
        ->getAllLeaveByUserId($request->user_id);

        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray["data"]["my_leave"] = $myLeave;
        return response()->json($jsonArray);
    }
    
    public function leaveApproval(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
                                            'status'            => 'required',
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
                $leaveApproved                      = \App\Models\Leave::where('user_id',$request['user_id'])->where('id',$request['leave_id'])->where('tl_id',$request['tl_id'])->first();
                $leaveApproved->status              = $request['status'];
                $leaveApproved->save();
                if ($leaveApproved->status == 2)
                {
                    $jsonArray['status'] = true;
                    $jsonArray['message'] = "Leave Approved Successfully";
                    $jsonArray['result']['leave_approve'] = $leaveApproved;
                    return response()->json($jsonArray);
                }
                else
                {
                    $jsonArray['status'] = true;
                    $jsonArray['message'] = "Leave Rejected Successfully";
                    $jsonArray['result']['leave_reject'] = $leaveApproved;
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
    
    
    
}
