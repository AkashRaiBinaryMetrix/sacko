<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $datacountlists     = \App\Models\Department::where('status','1')->get();
        $department         = \App\Models\Department::select(['*'])
		->where('status', '1')
		->paginate(10);
        return view('admin.department.index', compact(['department', 'datacountlists']));
    }

    public function create(Request $request)
    {
        return view('admin.department.create');
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
                $department                 		  = new \App\Models\Department();
				$department->name 		  		      = $request['name'];
				$department->status 	      		  = $request['status'];		
				$department->save();
				Session::flash('message', 'Department Created Successfully  !');
				return redirect('admin/department');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/department/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

	public function edit(Request $request, $id='')
    {
        $department = \App\Models\Department::find($id); 
        return view('admin.department.edit', compact(['department']));
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
				$department	            = \App\Models\Department::where('id',$id)->first();
				$department->name 		= $request['name'];
                $department->status 	= $request['status'];
				$department->save();	
				Session::flash('message', 'Department Updated Successfully!');

				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/department/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}

		}
		
	}

    public function view(Request $request, $id='')
    {
        $department = \App\Models\Department::find($id);
        return view('admin.department.view', compact(['department']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\Department::whereIn('id',$ids)->delete();
        Session::flash('message', 'Department Deleted Successfully! ');
        return redirect('admin/department');
    }
}
