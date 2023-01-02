<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Validator;

class SalesController extends Controller
{
    public function updateSales(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
                                            'target_id'         => 'required',
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
                $updateSales                          = \App\Models\AssignTarget::where('user_id',$request['user_id'])->where('id',$request['target_id'])->first();
                $updateSales->achievment              = $request['achievment'];
                $updateSales->save();
                $jsonArray['status']  = true;
                $jsonArray['message'] = "Sales Achievment Updated";
                $jsonArray['data']['sales'] = $updateSales;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }
    
    public function getSales(Request $request)
    {
        // if($request->fromdate =="" && $request->todate == "")
        // {
        //     $getSales = \App\Models\AssignTarget::select(['assign_targets.*', 'users.name AS username', 'products.name AS product_name','products.price','categories.name AS category_name','brands.name AS brand_name'])
        //                                     ->leftJoin('users','users.id','=','assign_targets.user_id')
        //                                     ->leftJoin('products','products.id','=','assign_targets.product_id')
        //                                     ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        //                                     ->leftJoin('brands','brands.id','=','products.brand_id')
        //                                     ->whereNull('categories.parent_id')
        //                                     ->getAllSaleByUserId($request->user_id );
        // }
        // else
        // {
        //     $getSales = \App\Models\AssignTarget::select(['assign_targets.*', 'users.name AS username', 'products.name AS product_name','products.price','categories.name AS category_name','brands.name AS brand_name'])
        //                                         ->leftJoin('users','users.id','=','assign_targets.user_id')
        //                                         ->leftJoin('products','products.id','=','assign_targets.product_id')
        //                                         ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        //                                         ->leftJoin('brands','brands.id','=','products.brand_id')
        //                                         ->whereNull('categories.parent_id')
        //                                          ->whereBetween('assign_targets.created_at', [$request->fromdate,$request->todate])
        //                                          ->getAllSaleByUserId($request->user_id );
        // }
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $getSales = DB::select("SELECT a.*, b.name AS username,c.name AS product_name,c.price,d.name AS brand_name ,e.name AS category_name
            FROM assign_targets a left join users b ON a.user_id=b.id left join products c ON a.product_id=c.id left join brands d ON c.brand_id=d.id left join categories e ON c.category_id=e.id
            
            WHERE a.user_id='{$request->user_id}'and a.created_at between '{$request->fromdate}' and DATE_ADD('{$request->todate}', INTERVAL 1 DAY)");
        }
        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray["data"]['sale_list'] = $getSales;
        return response()->json($jsonArray);
    }
    
    public function salesReason(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
                                            'target_id'        => 'required',
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
                $salesReason                      = \App\Models\AssignTarget::where('user_id',$request['user_id'])->where('id',$request['target_id'])->first();
                $salesReason->reason              = $request['reason'];
                $salesReason->save();
                $jsonArray['status']  = true;
                $jsonArray['message'] = "Sales Reason Updated Successfully";
                $jsonArray['data']['sales'] = $salesReason;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }
    
    public function getTlEmployeeSalesList(Request $request)
    {
        
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $tlEmployeeSalesList = DB::select("SELECT a.id,a.user_id, b.employee_id,b.name AS username,b.mobile,a.achievment
            FROM assign_targets a LEFT join  users b ON a.user_id=b.id WHERE b.assign_tl ='{$request->user_id}'and a.created_at between '{$request->from_date}' and DATE_ADD('{$request->to_date}', INTERVAL 1 DAY)");  
        }

        $jsonArray['status'] = true;
        $jsonArray['message'] = "success";
        $jsonArray["data"]['tl_employee_sale_list'] = $tlEmployeeSalesList;
        return response()->json($jsonArray);
    }
    
    
    
    
    
}
