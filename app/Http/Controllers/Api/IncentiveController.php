<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncentiveController extends Controller
{
    public function getIncentive(Request $request)
    {
        $incentive = \App\Models\Incentive::select(['incentives.*', 'users.name AS user_name','products.name AS product_name'])
                                    ->leftJoin('users', 'users.id', '=', 'incentives.user_id')
                                    ->leftJoin('products', 'products.id', '=', 'incentives.product_id')
                                    ->getAllIncentiveByUserId($request->user_id );
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray["data"]['incentive'] = $incentive;
        return response()->json($jsonArray);
    }
}
