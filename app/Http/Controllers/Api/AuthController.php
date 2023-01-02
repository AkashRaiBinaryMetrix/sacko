<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPasswordMailable;
use Hash;
use Validator;
use Session;    

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = \App\Models\User::where('employee_id', $request->employee_id)->first();
        if (!empty($user))
        {
            if (Hash::check($request->password, $user->password))
            {
                $jsonArray['status'] = true;
                $jsonArray['message'] = "Login Successfull";
                $jsonArray['result']['user'] = $user;
            }
            else
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = "Invalid Employee Id or Password";
            }
        }
        else
        {
            $jsonArray['status'] = false;
            $jsonArray['message'] = "Invalid Employee Id or Password";
        }
        return response()->json($jsonArray);
    }
    
    public function updateProfile(Request $request)
    {	
        $v = Validator::make($request->all(), [
                                            'user_id'   		=> 'required',
                                            'name' 				=> 'required',
                                            'mobile'  		    => 'required',
                                            ]);
        if ($v->fails())
        {
            $jsonArray['success'] 	= false;
            $jsonArray['message'] 	= $v->errors();
            return response()->json($jsonArray);  
        }
        else
        {
            try 
            {	
				$user_details = \App\Models\User::where("id",$request->user_id)->first();
    //             $user         = \App\Models\User::where('mobile', '=', $request->mobile)->first();
    //             if ($user != null)
    //             {
    //                 $jsonArray['status'] = false;
    //                 $jsonArray['message'] = "Mobile already exist!";
    //                 return response()->json($jsonArray);
    //             }
				// else
				// {
				    $targetUsers						= 'storage/uploads/users/';
					$image 								= $request->file('image');
					if(!empty($image))
					{		  
				// 		if (File::exists($user_details->image)) 
				// 		{	
				// 			File::delete($user_details->image);
				// 		}
						$headerImageName	= $image->getClientOriginalName();
						$ext1				= $image->getClientOriginalExtension();				
						$temp1				= explode(".",$headerImageName);				 
						$newHeaderLogo		= 'image'.round(microtime(true)).".".end($temp1);				 
						$headerTarget		= $targetUsers.$newHeaderLogo;
						$image->move($targetUsers,$newHeaderLogo);
						$user_details->image 		=$headerTarget;
					}	
					
					$user_details->name  				= $request->name;
					$user_details->mobile 	    	    = $request->mobile;
					$user_details->email    			= $request['email'];
                    $user_details->state_id    			= (int)$request->state_id;
					$user_details->address    			= $request['address'];
					$user_details->save();
					$jsonArray['status'] 		= true;
					$jsonArray['message'] 		= "Profile Updated Successfully";
					$jsonArray['result']['user'] = $user_details;
					return response()->json($jsonArray);
				// }
            }
            catch (\Throwable $th)
            {	
                $jsonArray['success'] 	= false;
                $jsonArray['message'] 	= 'Internal Server Problems';
				return response()->json($jsonArray);
            }
        }
    }

    public function forgetPassword(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'employee_id' => 'required',
                                            ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
        {
            try 
            {
                $employee                 	  = new \App\Models\ForgetPassword();
                $employee->employee_id 		  = $request['employee_id'];
                $employee->save();

                // Try to send email
                $configArr = [
                    'employee_id' => $request->employee_id
                ];
                Mail::to('kuldeep@manticoresoft.com')->send(new ForgetPasswordMailable($configArr));
                
                $jsonArray['status'] = true;
                $jsonArray['message'] = "Forget Password request has been sent Successfully. !";
                $jsonArray['result']['Forget Password'] = $employee;
                return response()->json($jsonArray);
            } 
            catch (\Exception $e) 
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }

        }
                    
    }
    
    public function getStates(Request $request)
    {
        $state = \App\Models\State::select(['id','name'])->get();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray['data']['state_list'] = $state;
        return response()->json($jsonArray);
    }




}
