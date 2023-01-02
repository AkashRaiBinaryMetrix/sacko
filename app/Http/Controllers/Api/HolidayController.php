<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function holiday_list(Request $request)
    {
        $holidayList = \App\Models\HolidayCalendar::select(['*'])->get();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "Success !";
        $jsonArray['data']['holiday_list'] = $holidayList;
        return response()->json($jsonArray);
    }
}
