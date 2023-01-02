<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory(Request $request)
    {
        $category = \App\Models\Category::select(['*'])->whereNull('parent_id')->where('status','1')->get();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray['data']['category_list'] = $category;
        return response()->json($jsonArray);
    }
    
   public function getSubCategory(Request $request)
   {
        if(isset($request['category_id']) && !empty($request['category_id']))
        {
            $subCategory = \App\Models\Category::where("parent_id",$request['category_id'])->get(['id','name']);
        }
            $jsonArray['status'] = true;
            $jsonArray['message'] = "success";
            $jsonArray['data']['sub_category_list'] = $subCategory;
            return response()->json($jsonArray);    
    }
}
