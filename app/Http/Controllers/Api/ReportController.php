<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Validator;

class ReportController extends Controller
{
    public function addDisplayTracker(Request $request)
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
                $displayTracker                     = new \App\Models\DisplayTracker();
                $displayTracker->user_id            = $request['user_id'];
                $displayTracker->brand_id           = $request['brand_id'];
                $displayTracker->category_id 	    = $request['category_id'];
                $displayTracker->sub_category 	    = $request['sub_category'];
                $displayTracker->model 	            = $request['model'];
                $displayTracker->quantity	        = $request['quantity'];
                $displayTracker->save();

                $jsonArray['status'] = true;
                $jsonArray['message'] = "DisplayTracker created Successfully";
                $jsonArray['data']['display_tracker'] = $displayTracker;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function updateDisplayTracker(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'           => 'required',
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
                $displayTracker                     = \App\Models\DisplayTracker::where('user_id',$request['user_id'])->where('id',$request['display_tracker_id'])->first();
                $displayTracker->quantity	        = $request['quantity'];
                $displayTracker->save();
                $jsonArray['status']  = true;
                $jsonArray['message'] = "Update Stock Successfully";
                $jsonArray['data']['display_tracker'] = $displayTracker;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    
    public function getDisplayTracker(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $displayTracker = DB::select("SELECT a.*, b.name AS brand_name ,c.name AS category_name,
            (SELECT name FROM categories where id=a.sub_category)AS subcategory
            FROM display_trackers a left join brands b ON a.brand_id=b.id left join categories c ON a.category_id=c.id  WHERE a.user_id='{$request->user_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['display_tracker'] = $displayTracker;
        return response()->json($jsonArray);
    }
    
    public function displayTrackerStorePic(Request $request)
    {
        $v = Validator::make($request->all(), [
                                            'user_id'               => 'required',
                                            'display_tracker_id'    => 'required',
                                            'image'                 => 'required',
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
                $storePicDisplayTracker  = new \App\Models\DisplayTrackerStorePic();
                $storePic		         = 'storage/uploads/store_pic/';
				$image			         = $request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	 = $image->getClientOriginalName();
					$ext1				 = $image->getClientOriginalExtension();				
					$temp1				 = explode(".",$headerImageName);				 
					$newHeaderLogo		 = 'image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		 = $storePic.$newHeaderLogo;
					$image->move($storePic,$newHeaderLogo);
					$storePicDisplayTracker->image = $headerTarget;
				}
                $storePicDisplayTracker->user_id	            = $request['user_id'];
                $storePicDisplayTracker->display_tracker_id	    = $request['display_tracker_id'];
                $storePicDisplayTracker->save();
                $jsonArray['status']  = true;
                $jsonArray['message'] = "Store Pic added Successfully";
                $jsonArray['data']['store_pic_display_tracker'] = $storePicDisplayTracker;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }
    
    public function getDisplayTrackerStorePic(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $displayTracker = DB::select("SELECT a.*, b.name AS username
            FROM display_tracker_store_pics a left join users b ON a.user_id=b.id  WHERE a.user_id='{$request->user_id}' and  a.display_tracker_id= '{$request->display_tracker_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['display_tracker_store_pic'] = $displayTracker;
        return response()->json($jsonArray);
    }
    
    public function competitionDisplayTracker(Request $request)
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
                $competitionDisplayTracker                      = new \App\Models\CompetitionDisplayTracker();
                $competitionDisplayTracker->user_id             = $request['user_id'];
                $competitionDisplayTracker->display_tracker_id  = $request['display_tracker_id'];
                $competitionDisplayTracker->brand_id            = $request['brand_id'];
                $competitionDisplayTracker->category_id 	    = $request['category_id'];
                $competitionDisplayTracker->sub_category 	    = $request['sub_category'];
                $competitionDisplayTracker->quantity	        = $request['quantity'];
                $competitionDisplayTracker->save();

                $jsonArray['status'] = true;
                $jsonArray['message'] = "Competition Display Tracker created Successfully";
                $jsonArray['data']['competition_display_tracker'] = $competitionDisplayTracker;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function getCompetitionDisplayTracker(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $displayTracker = DB::select("SELECT a.*, b.name AS brand_name ,c.name AS category_name,
            (SELECT name FROM categories where id=a.sub_category)AS subcategory
            FROM competition_display_trackers a left join brands b ON a.brand_id=b.id left join categories c ON a.category_id=c.id  WHERE a.user_id='{$request->user_id}' and  a.display_tracker_id= '{$request->display_tracker_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['competition_display_tracker'] = $displayTracker;
        return response()->json($jsonArray);
    }
    
    public function competitionSales(Request $request)
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
                $competitionSales                      = new \App\Models\CompetitionSale();
                $competitionSales->user_id             = $request['user_id'];
                $competitionSales->brand_id            = $request['brand_id'];
                $competitionSales->category_id 	       = $request['category_id'];
                $competitionSales->sub_category 	   = $request['sub_category'];
                $competitionSales->quantity	           = $request['quantity'];
                $competitionSales->save();

                $jsonArray['status'] = true;
                $jsonArray['message'] = "Competition Sales created Successfully";
                $jsonArray['data']['competition_sales'] = $competitionSales;
                return response()->json($jsonArray);
            }
            catch (\Throwable $th)
            {
                $jsonArray['status'] = false;
                $jsonArray['message'] = 'Internal Problems';
            }
        }
    }

    public function getCompetitionSales(Request $request)
    {
        if(isset($request['user_id']) && !empty($request['user_id']))
        {
            $competitionSales = DB::select("SELECT a.*, b.name AS brand_name ,c.name AS category_name,
            (SELECT name FROM categories where id=a.sub_category)AS subcategory
            FROM competition_sales a left join brands b ON a.brand_id=b.id left join categories c ON a.category_id=c.id  WHERE a.user_id='{$request->user_id}'");
        }
        $jsonArray['status']  = true;
        $jsonArray['message'] = "Success";
        $jsonArray['data']['competition_sales'] = $competitionSales;
        return response()->json($jsonArray);
    }

    
}
