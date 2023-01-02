<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Validator;

class RsoSalesController extends Controller
{
    public function rsoSales(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'       => 'required',
                                            'brand_id'      => 'required',
                                            'category_id'   => 'required',
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
                $rsoSales                      = new \App\Models\RsoSale();
                $rsoSales->user_id             = $request['user_id'];
                $rsoSales->dealer_id           = $request['dealer_id'];
                $rsoSales->product_id          = $request['product_id'];
                $rsoSales->distributor_id 	   = $request['distributor_id'];
                $rsoSales->brand_id            = $request['brand_id'];
                $rsoSales->category_id 	       = $request['category_id'];
                $rsoSales->sub_category 	   = $request['sub_category'];
                $rsoSales->state_id 	       = $request['state_id'];
                $rsoSales->model	           = $request['model'];
                $rsoSales->quantity	           = $request['quantity'];
                $rsoSales->save();

                $jsonArray['status'] = true;
                $jsonArray['message'] = "RSO Sales created Successfully";
                $jsonArray['data']['rso_sales'] = $rsoSales;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function getRsoSales(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $rsoSales = DB::select("SELECT a.*, b.name AS brand_name ,c.name AS category_name,d.name AS dealer_name, e.name AS distributor_name,f.name AS state_name,g.name AS product_name,g.price AS product_price,
            (SELECT name FROM categories where id=a.sub_category)AS subcategory
            FROM rso_sales a left join brands b ON a.brand_id=b.id left join categories c ON a.category_id=c.id
            left join dealers d ON a.dealer_id=d.id left join distributors e ON a.distributor_id=e.id left join states f ON a.state_id=f.id left join products g ON a.product_id=g.id
            WHERE a.user_id='{$request->user_id}'and a.created_at between '{$request->from_date}' and DATE_ADD('{$request->to_date}', INTERVAL 1 DAY)");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['rso_sales_list'] = $rsoSales;
        return response()->json($jsonArray);
    }
    
    public function getDealer(Request $request)
    {
        if(isset($request['state_id']) && !empty($request['state_id']))
        {
            $dealer = DB::select("SELECT a.id,a.name,a.state_id, b.name AS state_name 
            FROM dealers a left join states b ON a.state_id=b.id WHERE a.state_id='{$request->state_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['dealer_list'] = $dealer;
        return response()->json($jsonArray);
    }
    
    public function getProduct(Request $request)
    {
        $product = \App\Models\Product::select('id','name')->get();
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['product_list'] = $product;
        return response()->json($jsonArray);
    }

    public function getDistributor(Request $request)
    {
        if(isset($request['state_id']) && !empty($request['state_id']))
        {
            $distributor = DB::select("SELECT a.id,a.name,a.state_id, b.name AS state_name 
            FROM distributors a left join states b ON a.state_id=b.id WHERE a.state_id='{$request->state_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['distributor_list'] = $distributor;
        return response()->json($jsonArray);
    }


}
