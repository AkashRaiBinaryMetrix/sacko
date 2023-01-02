<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function getBrand(Request $request)
    {
        $brand = \App\Models\Brand::select(['*'])->where('status','1')->get();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray['data']['brand_list'] = $brand;
        return response()->json($jsonArray);
    }
}
