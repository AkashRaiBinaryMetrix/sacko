<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

class TestController extends Controller
{
    // public function viewAssignedTest(Request $request, $id='')
    // {
    //     if(isset($request['user_id']) && !empty($request['user_id']))
    //     {
    //         $assignTest = \App\Models\AssignTest::select('assign_tests.*', 'users.name AS username', 'tests.name AS test_name')
    //                     ->leftJoin('users', 'users.id', '=', 'assign_tests.user_id')
    //                     ->leftJoin('tests', 'tests.id', '=', 'assign_tests.test_id')
    //                     ->viewAssignByUserId($request->user_id);
    //     }
    //     else
    //     {
    //         $assignTest = \App\Models\AssignTest::select('assign_tests.*', 'users.name AS username','tests.name AS test_name')
    //                     ->leftJoin('users', 'users.id', '=', 'assign_tests.user_id')
    //                     ->leftJoin('tests', 'tests.id', '=', 'assign_tests.test_id')
    //                     ->get();
    //     }
        
    //     if(isset($request['user_id']) && !empty($request['user_id']))
    //     {
    //         $saveResult = \App\Models\SaveResult::select('save_results.*', 'users.name AS username', 'tests.name AS test_name')
    //                     ->leftJoin('users', 'users.id', '=', 'save_results.user_id')
    //                     ->leftJoin('tests', 'tests.id', '=', 'save_results.test_id')
    //                     ->viewSaveResultByUserId($request->user_id);
    //     }
    //     $jsonArray['status'] = true;
    //     $jsonArray['message'] = "Success";
    //     $jsonArray['data']['assigned_test'] = $assignTest;
    //     $jsonArray['data']['result'] = $saveResult;
    //     return response()->json($jsonArray);
    // }
    
    // public function viewAssignedTest(Request $request, $id='')
    // {
    //     if(isset($request['user_id']) && !empty($request['user_id']))
    //     {
    //         $assignTest = \App\Models\AssignTest::select('assign_tests.*', 'users.name AS username', 'tests.name AS test_name')
    //                     ->leftJoin('users', 'users.id', '=', 'assign_tests.user_id')
    //                     ->leftJoin('tests', 'tests.id', '=', 'assign_tests.test_id')
    //                     ->viewAssignByUserId($request->user_id);
    //     }
    //     if(isset($request['user_id']) && !empty($request['user_id']))
    //     {
    //         $saveResult = \App\Models\SaveResult::select('save_results.*', 'users.name AS username', 'tests.name AS test_name')
    //                     ->leftJoin('users', 'users.id', '=', 'save_results.user_id')
    //                     ->leftJoin('tests', 'tests.id', '=', 'save_results.test_id')
    //                     ->viewSaveResultByUserId($request->user_id);
    //     }
    //     $jsonArray['status'] = true;
    //     $jsonArray['message'] = "Success";
    //     $i=0;
    //     foreach($assignTest as $tet){
    //       if($tet['test_id'] == $saveResult[0]['test_id'])
    //             $assignTest[$i]['result'] = $saveResult[0];
    //         else
    //         $assignTest[$i]['result'] = NULL;
    //     $i++;}

    //     $jsonArray['data']['assigned_test'] = $assignTest;
    //     return response()->json($jsonArray);
    // }
    
    public function viewAssignedTest(Request $request, $id='')
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $resultArray=array();
            $assignTest = \App\Models\AssignTest::where("user_id",$request->user_id)->get();
            foreach ($assignTest as $key => $value)
            {
                $arr["id"]=$value->id;
                $arr["user_id"]=$value->user_id;
                $arr["status"]=$value->status;
                $arr["created_by"]=$value->created_by;
                $arr["updated_by"]=$value->updated_by;
                $arr["created_at"]=$value->created_at;
                $arr["updated_at"]=$value->updated_at;
                $arr["username"]=\App\Models\User::where("id",$value->user_id)->value("name");
                $arr["test_name"]=\App\Models\Test::where("id",$value->test_id)->value("name");
                $arr["test_id"]=$value->test_id;
                $arr['result']= \App\Models\SaveResult::where("test_id",$value->test_id)->where("user_id",$value->user_id)->first();
                array_push($resultArray,$arr);
            }
        }
        $jsonArray['status'] = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['assigned_test'] = $resultArray;
        return response()->json($jsonArray);
    }
    
    public function saveResult(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'               => 'required',
                                            'test_id'               => 'required',
                                            'total_no_of_question'  => 'required',
                                            'correct_answer'       => 'required',
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
                $saveResult                         = new \App\Models\SaveResult();
                $saveResult->user_id                = $request['user_id'];
                $saveResult->test_id 	            = $request['test_id'];
                $saveResult->total_no_of_question 	= $request['total_no_of_question'];
                $saveResult->correct_answer 	    = $request['correct_answer'];
                $saveResult->percentage 	        = $request['percentage'];
                $saveResult->time_consuming 	    = $request['time_consuming'];
                $saveResult->save();
                $jsonArray['status'] = true;
                $jsonArray['message'] = "Result saved Successfully";
                $jsonArray['result']['save_result'] = $saveResult;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function viewCertificate(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $certificate = \App\Models\Certificate::select('certificates.*','users.name AS username')
                                                    ->leftJoin('users', 'users.id', '=', 'certificates.user_id')
                                                    ->where("user_id",$request['user_id'])->get();
        }
        $jsonArray['status'] = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['certificate'] = $certificate;
        return response()->json($jsonArray);
    }


}
