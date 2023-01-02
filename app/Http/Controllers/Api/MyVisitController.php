<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Validator;

class MyVisitController extends Controller
{
    public function myVisitIn(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'       => 'required',
                                            'state_id'      => 'required',
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
                $myVisit                 = new \App\Models\MyVisit();
                $visitImage		         = 'storage/uploads/myVisit/';
				$image			         = $request->file('time_in_image');    
				if(!empty($image))
				{				  
					$headerImageName	 = $image->getClientOriginalName();
					$ext1				 = $image->getClientOriginalExtension();				
					$temp1				 = explode(".",$headerImageName);				 
					$newHeaderLogo		 = 'image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		 = $visitImage.$newHeaderLogo;
					$image->move($visitImage,$newHeaderLogo);
					$myVisit->time_in_image   = $headerTarget;
				}
                $myVisit->user_id             = $request['user_id'];
                $myVisit->dealer_id           = $request['dealer_id'];
                $myVisit->distributor_id 	  = $request['distributor_id'];
                $myVisit->state_id 	          = $request['state_id'];
                $myVisit->time_in             = $request['time_in'];
                $myVisit->save();

                $jsonArray['status'] = true;
                $jsonArray['message'] = "My Visit In Successfully";
                $jsonArray['data']['my_visit'] = $myVisit;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function myVisitOut(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'       => 'required',
                                            'visit_id'      => 'required',
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
                $myVisitOut                 = \App\Models\MyVisit::where('user_id',$request['user_id'])->where('id',$request['visit_id'])->first();
                $visitImage		            = 'storage/uploads/myVisit/';
				$image			            = $request->file('time_out_image');    
				if(!empty($image))
				{				  
					$headerImageName	    = $image->getClientOriginalName();
					$ext1				    = $image->getClientOriginalExtension();				
					$temp1				    = explode(".",$headerImageName);				 
					$newHeaderLogo		    = 'image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		    = $visitImage.$newHeaderLogo;
					$image->move($visitImage,$newHeaderLogo);
					$myVisitOut->time_out_image   = $headerTarget;
				}
                $myVisitOut->time_out             = $request['time_out'];
                $myVisitOut->save();
                $jsonArray['status']  = true;
                $jsonArray['message'] = "MyVisit Update Successfully";
                $jsonArray['data']['edit_my_visit'] = $myVisitOut;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function getMyVisit(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $myVisit = DB::select("SELECT a.*, b.name AS username,c.name AS dealer_name,d.name AS distributor_name, e.name AS state_name            
            FROM my_visits a left join users b ON a.user_id=b.id left join dealers c ON a.dealer_id=c.id
            left join distributors d ON a.distributor_id=d.id left join states e ON a.state_id=e.id
            WHERE a.user_id='{$request->user_id}' and a.created_at between '{$request->from_date}' and DATE_ADD('{$request->to_date}', INTERVAL 1 DAY)");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['my_visit_list'] = $myVisit;
        return response()->json($jsonArray);
    }
}
