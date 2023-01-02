<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserManualController extends Controller
{
    public function getUserManual(Request $request)
    {
        $userManual = \App\Models\UserManual::all();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray["data"]['user_manual'] = $userManual;
        return response()->json($jsonArray);
    }
    
}
