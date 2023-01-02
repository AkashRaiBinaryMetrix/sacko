<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;

class ApplyLeaveController extends Controller
{
    public function apply_leave(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'   => 'required',
                                            'leave_type_id' => 'required',
                                            'from_date'     => 'required',
                                            'to_date'       => 'required',
                                            'description'   => 'required', 
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
                $assign_tl                  = \App\Models\User::where('id', $request->user_id)->first();
                $assign_tl                  = $assign_tl->assign_tl;
                $applyLeave                 = new \App\Models\Leave();
                $applyLeave->tl_id          = $assign_tl;
                $applyLeave->user_id        = $request['user_id'];
                $applyLeave->leave_type_id  = $request['leave_type_id'];
                $applyLeave->from_date 	    = $request['from_date'];
                $applyLeave->to_date 	    = $request['to_date'];
                $applyLeave->description    = $request['description'];
                $applyLeave->save();
                                
                $jsonArray['status'] = true;
                $jsonArray['message'] = "Leave Applied Successfully";
                $jsonArray['result']['ApplyLeave'] = $applyLeave;
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
