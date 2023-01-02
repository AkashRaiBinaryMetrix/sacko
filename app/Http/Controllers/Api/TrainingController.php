<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function training(Request $request)
    {
        $training = \App\Models\Training::select(['trainings.*', 'brands.name AS brand_name', 'categories.name AS category_name'])
        ->leftJoin('brands', 'brands.id', '=', 'trainings.brand_id')
        ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
        ->where('trainings.status','1')
        ->get();
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray['data']['training_center'] = $training;
        return response()->json($jsonArray);
    }
}
