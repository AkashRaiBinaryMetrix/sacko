<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

class ClaimController extends Controller
{
    public function claim(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'   => 'required',
                                            'title'     => 'required',
                                            'date'      => 'required',
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
                $target            		= 'storage/uploads/claim/';
				$claimDocument          = $request->file('document');                
				if(!empty($claimDocument))
				{
					$headerImageName	= $claimDocument->getClientOriginalName();
					$ext1				= $claimDocument->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'document'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/claim/'.$newHeaderLogo;
					$claimDocument->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget		    = '';
				}
                $claim                  = new \App\Models\Claim();
                $claim->user_id         = $request['user_id'];
                $claim->title           = $request['title'];
                $claim->date 	        = $request['date'];
                $claim->time 	        = $request['time'];
                $claim->description 	= $request['description'];
                $claim->document	    = $headerTarget;
                $claim->save();

                $jsonArray['status'] = true;
                $jsonArray['message'] = "Claim Submitted Successfully";
                $jsonArray['data']['claim'] = $claim;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function getclaim(Request $request)
    {
        $claim = \App\Models\Claim::select(['claims.*', 'users.name AS user_name'])
                                    ->leftJoin('users', 'users.id', '=', 'claims.user_id')
                                    ->getAllClaimByUserId($request->user_id );
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray["data"]['claim_list'] = $claim;
        return response()->json($jsonArray);
    }
}
