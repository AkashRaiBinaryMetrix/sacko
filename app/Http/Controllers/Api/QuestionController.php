<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class QuestionController extends Controller
{
    // public function question(Request $request)
    // {
    //     $question = \App\Models\Question::select(['*'])->get();
    //     $jsonArray['status'] = true;
    //     $jsonArray['message'] = "Success !";
    //     $jsonArray['data']['question'] = $question;
    //     return response()->json($jsonArray);
    // }
    
    public function question(Request $request)
    {
        if(isset($request['test_id']) && !empty($request['test_id']))
        {
            $question = DB::select("SELECT a.id,a.test_id,a.question_id,a.created_at,a.updated_at, b.question,b.option_1,b.option_2,b.option_3,b.option_4,
            b.correct_option,b.status FROM assign_questions a left join questions b ON a.question_id=b.id WHERE a.test_id='{$request->test_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['get_question'] = $question;
        return response()->json($jsonArray);
    }
}
