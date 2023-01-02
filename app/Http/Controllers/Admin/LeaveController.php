<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportLeave;
use App\Models\Leave;
use App\Models\LeaveType;
use DB;
use Auth;
use Session;
use Validator;

class LeaveController extends Controller
{
    public function index()
    {   
		try 
		{
            $lists 	=\App\Models\Leave::select('leaves.*','ch.name', 'ch.employee_id', 'cd.name AS tl_name')
                    ->leftjoin('users AS ch','ch.id','=','leaves.user_id')
					->leftjoin('users AS cd','cd.id','=','leaves.tl_id')
                    ->orderBy('id','DESC');
			$lists = $lists->paginate(10);
			$leaveType = LeaveType::select(['*'])->where('status', 1)->get();
			return view('admin.leave.index',compact('lists','leaveType'));
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect()->back()->withErrors(array('message' => $message));
		}
	}
	
	public function my_leave()
    {   
		try 
		{
			$lists          =Leave::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10); 
			$datacountlists =Leave::where('user_id',Auth::user()->id)->get();
			$leaveType 		=LeaveType::select(['*'])->where('status', 1)->get();
			$user 			= DB::table('users')
							->leftjoin('user_onboardings','users.id','=','user_onboardings.user_id')
							->leftjoin('user_onboarding_personals','users.id','=','user_onboarding_personals.user_id')
							->leftjoin('groups','groups.id','=','users.group_id')
							->where('users.id',Auth::user()->id)
							->select('users.name','users.gender','user_onboardings.date_of_joining','user_onboarding_personals.marital_status','user_onboarding_personals.kids_details','groups.name as group_name')
							->first();
			$user_array = (array) $user;
			if(!empty($user->date_of_joining))
			{
				$date1 = $user->date_of_joining;
			}
			else
			{
				$date1 = date("Y-m-d");
			}
			$date2 	= date("Y-m-d") ;
			$diff 	= abs(strtotime($date2) - strtotime($date1));
			$years 	= floor($diff / (365*60*60*24));
			$new_array 		= array('year_complete'=>$years);
			$user_array		= array_merge($user_array, $new_array);
			
			return view('leave.my_leave',compact('lists','datacountlists','leaveType','user_array'));
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect()->back()->withErrors(array('message' => $message));
		}	
	}

    public function edit(Request $request, $id='')
    {
        $leave = \App\Models\Leave::find($id);
		$employees = \App\Models\User::select(\DB::raw("id,name AS name"))
                    ->where('role_id','3')
                     ->where('status', 1)
                     ->get(); 
        return view('admin.leave.edit', compact(['leave','employees']));
    }

	public function update(Request $request,$id)
	{	
		$v = Validator::make($request->all(), [
											'status' 				=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
		{	
			try 
			{
				$leave					= \App\Models\Leave::where('id',$id)->first();
                $leave->status 	      	= $request['status'];
				$leave->tl_id    		= Auth::user()->id;		
				$leave->save();	
				Session::flash('message', 'Leave Updated Successfully!');
				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/leave/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}
		}
		
	}
	
	public function delete(Request $request,$id='')
    {	
		try 
		{
			$ids = $request->mul_del;
			Leave::whereIn('id',$ids)->delete();
			Session::flash('message', 'Leave Deleted Successfully !');
			return redirect('admin/leave');
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect('admin/leave/')->withErrors(array('message' => $message));
		}
    }

	public function view(Request $request, $id='')
    {
		$leave        = \App\Models\Leave::select('leaves.*', 'ch.name AS user_name', 'ch.employee_id', 'cd.name AS tl_name')
						->leftjoin('users AS ch','ch.id','=','leaves.user_id')
						->leftjoin('users AS cd','cd.id','=','leaves.tl_id')
						->find($id);
		$leave->leave_type = LeaveType::select(['name'])->find($leave->leave_type_id);
        return view('admin.leave.view', compact(['leave']));
    }

	public function exportLeave(Request $request)
	{
        return Excel::download(new ExportLeave, 'leave.xlsx');
    }
}
