<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HolidayCalendar;
use App\Models\Group;
use App\Models\Event;
use DB;
use Auth;
use Session;
use Validator;

class HolidayCalendarController extends Controller
{
    public function index()
    {   
		try 
		{
			$lists 			= DB::table('holiday_calendars')
							  ->select('holiday_calendars.*')
							  ->orderBy('holiday_calendars.id','Desc')->paginate(10);
			return view('admin.holiday_calendar.index',compact('lists'));
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect()->back()->withErrors(array('message' => $message));
		}
	}
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function create()
    {	
		try 
		{
			return view('admin.holiday_calendar.create');
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
											'holiday_name' 	=> 'required|max:50',
											'holiday_start' => 'required|max:50',
											]);
        if ($x->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($x->errors());
        }
        else
        {   
			try 
			{	
				$holiday_start = date('Y-m-d', strtotime($request->input('holiday_start')));
				$holiday_end   = date('Y-m-d', strtotime(' +1 day',strtotime($holiday_start)));
				
				$holiday						=new HolidayCalendar;
				$holiday->holiday_name			=$request->input('holiday_name');
				$holiday->holiday_start			=$holiday_start;
				$holiday->holiday_end			=$holiday_end;
				$holiday->created_by			=Auth::user()->id;
				$holiday->status				=$request->input('status');
				$holiday->save();
				Session::flash('message', 'Record Saved Successfully !');
				return back();
			}
			catch (\Exception $ex) 
			{	
				$status 	= false;
				$message 	= $ex->getMessage();
				return redirect('admin/holiday_calendar/create')->withErrors(array('message' => $message));
			}
        }
	}

	
	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	public function show($id='')
    {
		
		//$ctclists=Group::where('id',$id)->first();
    	//return view('group.view',compact('ctclists'));
	}
	
	public function edit($id='')
    {
		try 
		{
			$lists =HolidayCalendar::find($id);
			if(is_object($lists) && !empty($lists))
			{
				return view('admin.holiday_calendar.edit',compact('lists'));
			}
			else
			{
				return redirect()->back();
			}
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect('admin/holiday_calendar/create')->withErrors(array('message' => $message));
		}
    }
	 
	public function update(Request $request,$id='')
    {
		
		$x = Validator::make($request->all(), [
												'holiday_name' 	=> 'required|max:50',
												'holiday_start' => 'required|max:50',
												//'holiday_end' 	=> 'required|max:50',
												]);
		if ($x->fails())
		{
			return redirect()->back()->withInput($request->input())->withErrors($x->errors());
		}
		else
		{ 
			try 
			{
				$holiday_start = date('Y-m-d', strtotime($request->input('holiday_start')));
				$holiday_end   = date('Y-m-d', strtotime(' +1 day',strtotime($holiday_start)));
				
				$holiday 						=HolidayCalendar::find($id);
				$holiday->holiday_name			=$request->input('holiday_name');
				$holiday->holiday_start			=$holiday_start;
				$holiday->holiday_end			=$holiday_end;
				$holiday->created_by			=Auth::user()->id;
				$holiday->status				=$request->input('status');
				$holiday->save();				 						 	
				Session::flash('message', 'Record Updated Successfully !');
				return redirect('admin/holiday_calendar');
			}
			catch (\Exception $ex) 
			{	
				$status 	= false;
				$message 	= $ex->getMessage();
				return redirect('admin/holiday_calendar/edit/'.$id.'')->withErrors(array('message' => $message));
			}
		}
    }
	  
	public function delete(Request $request,$id='')
    {	
		try 
		{
			$ids = $request->mul_del;
			HolidayCalendar::whereIn('id',$ids)->delete();
			Session::flash('message', 'Record Deleted Successfully !');
			return redirect('admin/holiday_calendar');
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect('admin/holiday_calendar/')->withErrors(array('message' => $message));
		}
    }

}
