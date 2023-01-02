<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

class BrandController extends Controller
{
    public function index()
    {
        $datacountlists = \App\Models\Brand::get();
        $brand         = \App\Models\Brand::select('*')->paginate(10);
        return view('admin.brand.index', compact(['brand', 'datacountlists']));
    }

    public function create(Request $request)
    {
        return view('admin.brand.create');
    }

	public function store(Request $request)
    {	
        $v = Validator::make($request->all(), [
											'name' 			 	=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
        {	
			try 
			{
                $target            		= 'storage/uploads/brand/';
				$brandImage     		= $request->file('logo');                
				if(!empty($brandImage))
				{
					$headerImageName	= $brandImage->getClientOriginalName();
					$ext1				= $brandImage->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'logo'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/brand/'.$newHeaderLogo;
					$brandImage->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}
                $target            		= 'storage/uploads/brand/';
				$brandImage     		= $request->file('banner');                
				if(!empty($brandImage))
				{
					$headerImageName	= $brandImage->getClientOriginalName();
					$ext1				= $brandImage->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'banner'.round(microtime(true)).".".end($temp1);				
					$headerTargets		= 'storage/uploads/brand/'.$newHeaderLogo;
					$brandImage->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTargets				  = '';
				}
                $brand                 		  = new \App\Models\Brand();
				$brand->name 		  		  = $request['name'];
                $brand->meta_title 		  	  = $request['meta_title'];
				$brand->meta_description 	  = $request['meta_description'];
				$brand->status 	      		  = $request['status'];		
                $brand->logo	      		  = $headerTarget;
                $brand->banner	      		  = $headerTargets;
				$brand->save();
				Session::flash('message', 'Brand Created Successfully  !');
				return redirect('admin/brand');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/brand/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

	public function edit(Request $request, $id='')
    {
        $brand = \App\Models\Brand::find($id); 
        return view('admin.brand.edit', compact(['brand']));
    }

	public function update(Request $request,$id)
	{	
		$v = Validator::make($request->all(), [
											'name' 				=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
		{	
			try 
			{
				$brand	= \App\Models\Brand::where('id',$id)->first();
				$targetUser	= 'storage/uploads/brand/';
				$image		= $request->file('logo');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='logo'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
					$brand->logo =$headerTarget;
				}
                $targetUser	= 'storage/uploads/brand/';
				$banner		= $request->file('banner');    
				if(!empty($banner))
				{				  
					$headerbannerName	= $banner->getClientOriginalName();
					$ext1				= $banner->getClientOriginalExtension();				
					$temp1				= explode(".",$headerbannerName);				 
					$newHeaderLogo		= 'banner'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		= $targetUser.$newHeaderLogo;
					$banner->move($targetUser,$newHeaderLogo);
					$brand->banner      = $headerTarget;
				}
				$brand->name 		  		  = $request['name'];
				$brand->meta_title 	      	  = $request['meta_title'];
				$brand->meta_description 	  = $request['meta_description'];
                $brand->status 	      		  = $request['status'];
				$brand->save();	
				Session::flash('message', 'Brand Updated Successfully!');

				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/brand/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}

		}
		
	}

    public function view(Request $request, $id='')
    {
        $brand = \App\Models\Brand::find($id);
        return view('admin.brand.view', compact(['brand']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\Brand::whereIn('id',$ids)->delete();
        Session::flash('message', 'brand Deleted Successfully! ');
        return redirect('admin/brand');
    }
}
