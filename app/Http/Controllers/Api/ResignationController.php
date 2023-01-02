<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;

class ResignationController extends Controller
{
    public function resignation(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
                                            'reason'            => 'required',
                                            'notice_period'     => 'required',
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
                $resignation                  = new \App\Models\Resignation();
                $resignation->user_id         = $request['user_id'];
                $resignation->reason          = $request['reason'];
                $resignation->notice_period   = $request['notice_period'];
                $resignation->status          = 1;
                $resignation->save();

                $jsonArray['status'] = true;
                $jsonArray['message'] = "Resignation Submitted Successfully";
                $jsonArray['data']['resignation'] = $resignation;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }
    
    public function getResignation(Request $request)
    {
        $resignation = \App\Models\Resignation::select(['resignations.*', 'users.name AS user_name'])
                                    ->leftJoin('users', 'users.id', '=', 'resignations.user_id')
                                    ->getAllResignationByUserId($request->user_id )->first();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray["data"]['resignation'] = $resignation;
        return response()->json($jsonArray);
    }
}
