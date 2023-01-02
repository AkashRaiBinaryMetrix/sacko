<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportCategory;
use Session;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $datacountlists = \App\Models\Category::where('status','1')->get();
        $category = \App\Models\Category::select(['*'])
		->where('status', '1')
		->paginate(10);
        return view('admin.category.index', compact(['category', 'datacountlists']));
    }

    public function create(Request $request)
    {
        return view('admin.category.create');
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
                $category                 		  = new \App\Models\Category();
				$category->name 		  		  = $request['name'];
				$category->status 	      		  = $request['status'];		
				$category->save();
				Session::flash('message', 'Category Created Successfully  !');
				return redirect('admin/category');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/category/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

	public function edit(Request $request, $id='')
    {
        $category = \App\Models\Category::find($id); 
        return view('admin.category.edit', compact(['category']));
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
				$category	= \App\Models\Category::where('id',$id)->first();
				$category->name 		  		  = $request['name'];
                $category->status 	      		  = $request['status'];
				$category->save();	
				Session::flash('message', 'Category Updated Successfully!');

				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/category/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}

		}
		
	}

    public function view(Request $request, $id='')
    {
        $category = \App\Models\Category::find($id);
        return view('admin.category.view', compact(['category']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\Category::whereIn('id',$ids)->delete();
        Session::flash('message', 'category Deleted Successfully! ');
        return redirect('admin/category');
    }

	public function exportCategory(Request $request)
	{
        return Excel::download(new ExportCategory, 'category.xlsx');
    }


}
