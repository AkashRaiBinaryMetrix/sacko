<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Timesheet;
use App\HolidayCalendar;
use App\User;
use App\AssignGroup;
use App\GroupRequest;
use DB;
use Auth;
use Session;
use Validator;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function event_index(Request $request)
    {	
		$data 			= DB::table('timesheets')
						  ->leftjoin('timesheet_attendances','timesheet_attendances.id','=','timesheets.status')
						  ->get(['timesheets.id','timesheet_attendances.attndance_name as title','attndance_date as start','attndance_date_end as end']);
		return response()->json($data);
    }
	
		
		
    public function index(Request $request)
    {   
		try 
		{	
			$assign = array();
			if(Auth::user()->role_id=='35')
			{
				$assign_group		=	AssignGroup::where('user_id',Auth::user()->id)->select('group_id')->get();
				foreach($assign_group as $val)
				{
					$assign[] = $val['group_id'];
				}
			}
			
			$data = DB::table('users as us')
					->leftJoin('countries as co','co.id','=','us.country_id')
					->leftJoin('groups as gr','gr.id','=','us.group_id')
					->where('role_name','!=','super-admin')
					->where('role_name','!=','candidate')
					->where('role_name','!=','onboarding-candidate')
					->where('role_name','=','employee')
					->where('is_active','!=','2')
					->select('us.*','co.name as country_name','gr.name as group_name');
					if(Auth::user()->role_id!='1')
					{
						$data = $data->whereIn('us.group_id',$assign); 
					}
					if (isset($request->name) && !empty($request->name)) 
					{
						$data = $data->where('us.name','like',$request->name.'%'); 
					} 
					if (isset($request->email) && !empty($request->email)) 
					{
						$data = $data->where('us.email','like',$request->email.'%'); 
					} 
					if (isset($request->mobile) && !empty($request->mobile)) 
					{
						$data = $data->where('us.mobile','like',$request->mobile.'%'); 
					} 
					if (isset($request->role_name) && !empty($request->role_name)) 
					{
						$data = $data->where('us.role_name','like',$request->role_name.'%'); 
					} 
			$users = $data->paginate(25);
			return view('timesheet.index',compact('users'));
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
	 
    public function create(Request $request)
    {	
		try 
		{
			$lists 	   = DB::table('users')
						->leftjoin('groups','groups.id','=','users.group_id')
						->where('users.id','=',Auth::user()->id)
						->select('users.*','groups.name as group_name')
						->first();
			$date  = $request->input('date');
			if(empty($date))
			{
				$date  =  date('Y-m-01');
			}
			$last_day_month    = date('Y-m-t',strtotime($date));
			$month_array 	   = Monthly_Details($date,$last_day_month,Auth::user()->group_id,Auth::user()->id);	
			$holiday 		   = DB::table('holiday_permissions')
								->leftjoin('holiday_sessions','holiday_sessions.id','=','holiday_permissions.session_id')
								->leftjoin('holiday_calendars','holiday_calendars.id','=','holiday_permissions.holiday_id')
								->where('holiday_permissions.can_manage','=',1)
								->where('holiday_sessions.group_id','=',Auth::user()->group_id)
								->where('holiday_calendars.holiday_start','>=',$date)
								->where('holiday_calendars.holiday_start','<=',$last_day_month)
								->get(['holiday_calendars.id','holiday_calendars.holiday_name as title','holiday_calendars.holiday_start as start','holiday_calendars.holiday_end as end']);
			$groupreqtest		= GroupRequest::where('user_id',Auth::user()->id)->where('status','0')->first();
			return view('timesheet.create',compact('lists','date','holiday','month_array','groupreqtest'));
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect()->back()->withErrors(array('message' => $message));
		}
	}
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
	public function store(Request $request,$id='')
    {      
        $x = Validator::make($request->all(), [
												//'name' => 'required|max:50',
												]);
        if ($x->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($x->errors());
        }
        else
        {   
			
			try 
			{	
				$groupreqtest		= GroupRequest::where('user_id',Auth::user()->id)->where('status','0')->first();
				if(is_object($groupreqtest) && !empty($groupreqtest))
				{
					$status 	= false;
					$message 	= 'Your Group Request is Pedning, You will be able to fill the timesheet only after HR approval !';
					return redirect()->back()->withErrors(array('message' => $message));
				}
				else
				{
					$attndance = $request->input('attndance_date');
					for($i=0; $i<count($attndance); $i++)
					{
						$status 								= $request->input('status')[$i];
						$working_house 							= $request->input('working_house')[$i];
						if($status=='2')
						{
							$working_house 	=  '0';
						}
						else if($status=='0' && $working_house>0)
						{	
							$working_house	=	$working_house;
							$status			= 	'1';
						}
						else if($status=='1' && $working_house>0)
						{	
							$working_house	=	$working_house;
							$status			= 	'1';
						}
						else if($status=='1' && $working_house<=0)
						{	
							$working_house	=	$working_house;
							$status			= 	'0';
						}
						else if($status=='0' && $working_house<=0)
						{	
							$working_house	=	$working_house;
							$status			= 	'0';
						}
						else
						{
							$working_house	=	$working_house;
						}
						
						$timesheet_update 						= Timesheet::where('user_id',Auth::user()->id)->where('attndance_date',$request->input('attndance_date')[$i])->first();
						
						if(is_object($timesheet_update) && !empty($timesheet_update))
						{
							if($timesheet_update->status!='6')
							{
								$timesheet_update->user_id				=Auth::user()->id;
								$timesheet_update->attndance_date		=$request->input('attndance_date')[$i];
								$timesheet_update->attndance_day		=$request->input('attndance_day')[$i];
								$timesheet_update->working_house		=$working_house;
								$timesheet_update->status				=$status;
								$timesheet_update->save();
							}
						}
						else
						{	
							$timesheet_add						=new Timesheet;
							$timesheet_add->user_id				=Auth::user()->id;
							$timesheet_add->attndance_date		=$request->input('attndance_date')[$i];
							$timesheet_add->attndance_day		=$request->input('attndance_day')[$i];
							$timesheet_add->working_house		=$working_house;
							$timesheet_add->status				=$status;
							$timesheet_add->save();
						}
					}
					Session::flash('message','Record Saved Successfully !');
					return redirect()->back();
				}
			}
			catch (\Exception $ex) 
			{	
				$status 	= false;
				$message 	= $ex->getMessage();
				return redirect()->back()->withErrors(array('message' => $message));
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
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
	 
	public function edit(Request $request,$id='')
    {
		try 
		{	
			$lists 	   = DB::table('users')
						->leftjoin('groups','groups.id','=','users.group_id')
						->where('users.id','=',$id)
						->select('users.*','groups.name as group_name')
						->first();
			if(is_object($lists)&& !empty($lists))
			{
				$date  = $request->input('date');
				if(empty($date))
				{
					$date  =  date('Y-m-01');
				}
				
				$last_day_month    = date('Y-m-t',strtotime($date));
				$month_array 	   = Monthly_Details($date,$last_day_month,$lists->group_id,$lists->id);
				$holiday   		   = DB::table('holiday_permissions')
									->leftjoin('holiday_sessions','holiday_sessions.id','=','holiday_permissions.session_id')
									->leftjoin('holiday_calendars','holiday_calendars.id','=','holiday_permissions.holiday_id')
									->where('holiday_permissions.can_manage','=',1)
									->where('holiday_sessions.group_id','=',$lists->group_id)
									->where('holiday_calendars.holiday_start','>=',$date)
									->where('holiday_calendars.holiday_start','<=',$last_day_month)
									->get(['holiday_calendars.id','holiday_calendars.holiday_name as title','holiday_calendars.holiday_start as start','holiday_calendars.holiday_end as end']);
					
				return view('timesheet.edit',compact('lists','date','last_day_month','holiday','month_array'));
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
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
	 
	public function update(Request $request,$id='')
    {
		$x = Validator::make($request->all(), [
												'attndance_date' => 'required|max:50',
												]);
        if ($x->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($x->errors());
        }
        else
        { 
			try 
			{
				$user 		= User::find($id);
				if(is_object($user)&& !empty($user))
				{			
					$attndance = $request->input('attndance_date');
					for($i=0; $i<count($attndance); $i++)
					{
						$timesheet_update 						= Timesheet::where('user_id',$user->id)->where('attndance_date',$request->input('attndance_date')[$i])->first();
						if(is_object($timesheet_update) && !empty($timesheet_update))
						{
							$timesheet_update->user_id				=$user->id;
							$timesheet_update->attndance_date		=$request->input('attndance_date')[$i];
							$timesheet_update->attndance_day		=$request->input('attndance_day')[$i];
							$timesheet_update->working_house		=$request->input('working_house')[$i];
							$timesheet_update->status				=$request->input('status')[$i];
							$timesheet_update->save();
						}
						else
						{	
							$timesheet_add						=new Timesheet;
							$timesheet_add->user_id				=$user->id;
							$timesheet_add->attndance_date		=$request->input('attndance_date')[$i];
							$timesheet_add->attndance_day		=$request->input('attndance_day')[$i];
							$timesheet_add->working_house		=$request->input('working_house')[$i];
							$timesheet_add->status				=$request->input('status')[$i];
							$timesheet_add->save();
						}
					}
					Session::flash('message', 'Record Updated Successfully !');
					return redirect('timesheet/edit/'.$id.'');
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
				return redirect('timesheet/edit/'.$id.'')->withErrors(array('message' => $message));
			}
		}
    }
	
	public function comment_update(Request $request)
    {	
		try 
		{	
			$user 		= User::find($request->input('user_id'));
			if(is_object($user)&& !empty($user))
			{			
				$attndance 								= $request->input('attndance_date');
				$timesheet_update 						= Timesheet::where('user_id',$user->id)->where('attndance_date',$request->input('attndance_date'))->first();
				if(is_object($timesheet_update) && !empty($timesheet_update))
				{
					$timesheet_update->user_id				=$user->id;
					$timesheet_update->attndance_date		=$request->input('attndance_date');
					$timesheet_update->attndance_day		=$request->input('attndance_day');
					$timesheet_update->status				=$request->input('status');
					$timesheet_update->comment				=$request->input('comment');
					$timesheet_update->save();
					echo '1';
				}
				else
				{	
					$timesheet_add						=new Timesheet;
					$timesheet_add->user_id				=$user->id;
					$timesheet_add->attndance_date		=$request->input('attndance_date');
					$timesheet_add->attndance_day		=$request->input('attndance_day');
					$timesheet_add->working_house		='0';
					$timesheet_add->status				=$request->input('status');
					$timesheet_add->comment				=$request->input('comment');
					$timesheet_add->save();
					echo '1';
				}
			}
			else
			{
				echo '0';
			}
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			echo '0';
		}
    }
	
	public function group_accept(Request $request)
    {
		try 
		{	
			$user 		= User::find(Auth::user()->id);
			if(is_object($user)&& !empty($user))
			{			
				$user->group_accept			='1';
				$user->updated_by			= Auth::user()->id;
				$user->save();
				Session::flash('message', 'Group Accepted Successfully !');
				return redirect('timesheet/create/');
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
			return redirect('timesheet/create/')->withErrors(array('message' => $message));
		}
		
    }
	
	/**
     * Change Staus the specified resource from storage.
     *
     * @param  \App\Group  $model
     * @return \Illuminate\Http\Response
     */
	 
	public static function status()
	{
		try 
		{
			$id			=$_GET['id'];
			$status		=$_GET['value'];
			$model 		=Timesheet::find($id);
			if($model) 
			{
				$model->status = $status;
				$model->save();
			}
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect('timesheet/')->withErrors(array('message' => $message));
		}
	}
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
	 
	public function destroy(Request $request,$id='')
    {	
		try 
		{
			$ids = $request->mul_del;
			Timesheet::whereIn('id',$ids)->delete();
			Session::flash('message', 'Record Deleted Successfully !');
			return redirect('timesheet');
		}
		catch (\Exception $ex) 
		{	
			$status 	= false;
			$message 	= $ex->getMessage();
			return redirect('timesheet/')->withErrors(array('message' => $message));
		}
    }
}
