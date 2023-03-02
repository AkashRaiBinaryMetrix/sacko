<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use DB;
use Auth;
use Session;
use Validator;

class LeaveTypeController extends Controller
{
    public function index()
    {   
		try 
		{
			$lists          =LeaveType::orderBy('id','DESC')->paginate(10); 
			$datacountlists =LeaveType::get();
			return view('admin.leavetype.index',compact('lists','datacountlists'));
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect()->back()->withErrors(array('message' => $message));
		}
	}

    public function create()
    {	
		try 
		{
			return view('admin.leavetype.create');
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect()->back()->withErrors(array('message' => $message));
		}
	}

	public function store(Request $request,$id='')
    {       
        $x = Validator::make($request->all(), [
											'name' => 'required|max:50',
											]);
        if ($x->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($x->errors());
        }
        else
        {   
			try 
			{
				$leavetype						=new LeaveType;
				$leavetype->name				=$request->input('name');
				$leavetype->created_by			=Auth::user()->id;
				$leavetype->status				=$request->input('status');
				$leavetype->save();
				Session::flash('message', 'Leave Type Created Successfully !');
				return redirect('leavetype');
			}
			catch (\Exception $ex) 
			{	
				$status 	= false;
				$message 	= $ex->getMessage();
				return redirect('leavetype/create')->withErrors(array('message' => $message));
			}
        }
	}
	 
	public function edit($id='')
    {
		try 
		{
			$leavetype = LeaveType::find($id);
			if(is_object($leavetype)&& !empty($leavetype))
			{
				return view('admin.leavetype.edit',compact('leavetype'));
			}
			else
			{
				//return redirect()->back();
			}
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect()->back()->withErrors(array('message' => $message));
		}
    }
	 
	public function update(Request $request,$id='')
    {
		$x = Validator::make($request->all(), [
												'name' => 'required|max:50',
												'total_in_year' => 'required|max:50',
												'total_in_month' => 'required|max:50',
												]);
        if ($x->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($x->errors());
        }
        else
        { 
			try 
			{
				$leavetype 						=LeaveType::find($id);
				$leavetype->name				=$request->input('name');
				$leavetype->total_in_year		=$request->input('total_in_year');
				$leavetype->total_in_month		=$request->input('total_in_month');
				$leavetype->status				=$request->input('status');
				$leavetype->updated_by			=Auth::user()->id;
				$leavetype->save();				 						 	
				Session::flash('message', 'Leave Type Updated Successfully !');
				return redirect('leavetype');
			}
			catch (\Exception $ex) 
			{	
				$status 	= false;
				$message 	= $ex->getMessage();
				return redirect('leavetype/edit/'.$id.'')->withErrors(array('message' => $message));
			}
		}
    }
	
	public function destroy(Request $request,$id='')
    {	
		try 
		{
			$ids = $request->mul_del;
			LeaveType::whereIn('id',$ids)->delete();
			Session::flash('message', 'Leave Type Deleted Successfully !');
			return redirect('leavetype');
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect('leavetype/')->withErrors(array('message' => $message));
		}
    }
}
