<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

class FeedbackController extends Controller
{
    public function feedback(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
                                            'feedback_type'     => 'required',
                                            ]);
        if ($v->fails())
        {
            $jsonArray['status'] = false;
            $jsonArray['message'] = $v->errors();
            return response()->json($jsonArray);  
        }
        else
        {
            // try 
            // {
                $feedback                   = new \App\Models\Feedbacks();
                $feedbackDocument		    = 'storage/uploads/feedback/';
				$document			        = $request->file('document');    
				if(!empty($document))
				{				  
					$headerImageName	    = $document->getClientOriginalName();
					$ext1				    = $document->getClientOriginalExtension();				
					$temp1				    = explode(".",$headerImageName);				 
					$newHeaderLogo		    = 'document'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		    = $feedbackDocument.$newHeaderLogo;
					$document->move($feedbackDocument,$newHeaderLogo);
					$feedback->document     = $headerTarget;
				}
                $feedback->user_id          = $request['user_id'];
                $feedback->feedback_type    = $request['feedback_type'];
                $feedback->description 	    = $request['description'];
                $feedback->save();
                                
                $jsonArray['status'] = true;
                $jsonArray['message'] = "Feedback sent Successfully";
                $jsonArray['data']['feedback'] = $feedback;
                return response()->json($jsonArray);
            // }
            // catch (\Throwable $th)
            // {
            //     $jsonArray['status'] = false;
            //     $jsonArray['message'] = 'Internal Problems';
            // }
        }
    }
}
