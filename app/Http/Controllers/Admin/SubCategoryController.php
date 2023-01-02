<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;

class SubCategoryController extends Controller
{
    public function index()
    {
        $datacountlists = \App\Models\SubCategory::get();
	    $sub_category 	= \App\Models\SubCategory::select(['sub_categories.*','categories.name AS category_name'])
						->leftJoin('categories','categories.id','sub_categories.category_id')
						->paginate(10);
        return view('admin.sub_category.index', compact(['sub_category', 'datacountlists']));
    }

    public function create(Request $request)
    {
		$categories = \App\Models\Category::select(\DB::raw("id, name AS name"))
		->where('status', 1)
		->get();
        return view('admin.sub_category.create', compact(['categories']));
    }

	public function store(Request $request)
    {	
        $v = Validator::make($request->all(), [
											'name' 			 	=> 'required',
											'category_id' 		=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
        {	
			try 
			{   
                $sub_category                 		  = new \App\Models\SubCategory();
				$sub_category->category_id 		  	  = $request['category_id'];
				$sub_category->name 		  		  = $request['name'];
				$sub_category->status 	      		  = $request['status'];		
				$sub_category->save();
				Session::flash('message', 'Sub Category Created Successfully  !');
				return redirect('admin/sub_category');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/sub_category/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

	public function edit(Request $request, $id='')
    {
        $sub_category 	= \App\Models\SubCategory::find($id);
		$categories 	= \App\Models\Category::select(\DB::raw("id, name AS name"))
						->where('status', 1)
						->get(); 
        return view('admin.sub_category.edit', compact(['sub_category', 'categories']));
    }

	public function update(Request $request,$id)
	{	
		$v = Validator::make($request->all(), [
											'name' 			 	=> 'required',
											'category_id' 		=> 'required',
										]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
		{	
			try 
			{
				$sub_category				= \App\Models\SubCategory::where('id',$id)->first();
				$sub_category->category_id 	= $request['category_id'];
				$sub_category->name 		= $request['name'];
				$sub_category->status 	    = $request['status'];		
				$sub_category->save();	
				Session::flash('message', 'Sub Category Updated Successfully!');

				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/sub_category/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}

		}
		
	}

    public function view(Request $request, $id='')
    {
		$sub_category = \App\Models\SubCategory::select(\DB::raw("sub_categories.*, categories.name AS category_name"))
						->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id')
						->find($id);
        return view('admin.sub_category.view', compact(['sub_category']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\SubCategory::whereIn('id',$ids)->delete();
        Session::flash('message', 'Sub category Deleted Successfully! ');
        return redirect('admin/sub_category');
    }
}
