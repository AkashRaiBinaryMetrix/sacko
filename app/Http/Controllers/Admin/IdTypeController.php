<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

class IdTypeController extends Controller
{
    public function index()
    {
        $datacountlists     = \App\Models\IdType::where('status','1')->get();
        $id_type            = \App\Models\IdType::select(['*'])
                            ->where('status', '1')
                            ->paginate(10);
        return view('admin.id_type.index', compact(['id_type', 'datacountlists']));
    }

    public function create(Request $request)
    {
        return view('admin.id_type.create');
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
                $id_type                 		  = new \App\Models\IdType();
				$id_type->name 		  		      = $request['name'];
				$id_type->status 	      		  = $request['status'];		
				$id_type->save();
				Session::flash('message', 'id_type Created Successfully  !');
				return redirect('admin/id_type');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/id_type/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

	public function edit(Request $request, $id='')
    {
        $id_type = \App\Models\IdType::find($id); 
        return view('admin.id_type.edit', compact(['id_type']));
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
				$id_type	        = \App\Models\IdType::where('id',$id)->first();
				$id_type->name 		= $request['name'];
                $id_type->status 	= $request['status'];
				$id_type->save();	
				Session::flash('message', 'IdType Updated Successfully!');

				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/id_type/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}

		}
		
	}

    public function view(Request $request, $id='')
    {
        $id_type = \App\Models\IdType::find($id);
        return view('admin.id_type.view', compact(['id_type']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\IdType::whereIn('id',$ids)->delete();
        Session::flash('message', 'IdType Deleted Successfully! ');
        return redirect('admin/id_type');
    }
}
