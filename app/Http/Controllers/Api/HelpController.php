<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function getHelp(Request $request)
    {
        $help = \App\Models\Helping::select('*')->get();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['get_help'] = $help;
        return response()->json($jsonArray);
    }
}
