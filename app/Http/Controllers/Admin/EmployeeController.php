<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Carbon\Carbon;
use App\Models\Attendance;
use App\Exports\ExportEmployee;
use Session;
use Validator;
use DB;
use DateTimeZone;
use DateTime;
class EmployeeController extends Controller
{
    public function index()
    {
        $datacountlists   = \App\Models\User::where('role_id', '3')->get();
		$employee         = \App\Models\User::select('*')->where('status','1')->where('role_id', '3')->get();
        if(is_object($employee) && !empty($employee))
		{
			if(!empty( $_GET['txt_search']))
			{
				$employee = DB::table('users as ch')
						  ->where('ch.first_name', 'LIKE', "%{$_GET['txt_search']}%") 
						  ->orWhere('ch.employee_id', 'LIKE', "%{$_GET['txt_search']}%") 
						  ->where('ch.role_id', '!=', '1')
						  ->select('ch.*')
						  ->orderBy('ch.id','Desc')->paginate(10);
			}
			else
			{
				$employee = DB::table('users as ch')
						->where('ch.role_id','!=','1')
                        ->select('ch.*')
                        ->orderBy('ch.id','Desc')->paginate(10);
			}
			return view('admin.employee.index', compact(['employee', 'datacountlists']));
		}
		else
		{
			return redirect('/');
		}
    }

    public function create(Request $request)
    {
        $countries 		= \App\Models\Country::get(["name", "id"]);
        $states 		= \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        $cities 		= \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);
		$department	 	= \App\Models\Department::select('*')->where('status', '1')->get();
		$idType		 	= \App\Models\IdType::select('*')->where('status', '1')->get();
		$category 	 	= \App\Models\Category::select('id','name')->where('status','1')->get();
        $subCategory 	= \App\Models\SubCategory::where("category_id",$request->category_id)->get(["name", "id"]);
		$hierarchy 		= \App\Models\User::select('id','hierarchy_id')->where('department_id', $request->department_id)->get();

		$project_details = DB::table('projects')->get();
		$usershifts = DB::table('usershifts')->get();

		return view('admin.employee.create', compact(['project_details','usershifts','countries', 'states', 'cities', 'department', 'idType', 'category', 'subCategory']));
    }

    public function createNew(Request $request)
    {
        $countries 		= \App\Models\Country::get(["name", "id"]);
        $states 		= \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        $cities 		= \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);
		$department	 	= \App\Models\Department::select('*')->where('status', '1')->get();
		$idType		 	= \App\Models\IdType::select('*')->where('status', '1')->get();
		$category 	 	= \App\Models\Category::select('id','name')->where('status','1')->get();
        $subCategory 	= \App\Models\SubCategory::where("category_id",$request->category_id)->get(["name", "id"]);
		$hierarchy 		= \App\Models\User::select('id','hierarchy_id')->where('department_id', $request->department_id)->get();

		$project_details = DB::table('projects')->get();
		$usershifts = DB::table('usershifts')->get();

		return view('admin.employee.createNew', compact(['project_details','usershifts','countries', 'states', 'cities', 'department', 'idType', 'category', 'subCategory']));
    }

	public function store(Request $request)
    {	
        $v = Validator::make($request->all(), [
											'first_name' 		=> 'required',
											'employee_type'		=> 'required',
											'email' 		 	=> 'required|unique:users|max:191',
											'mobile' 		 	=> 'required',
											'department_id' 	=> 'required',
											'id_type_id' 		=> 'required',
											'gender' 		 	=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
        {	
			try 
			{
				$targetUser	= 'storage/uploads/employee/';
				$image		= $request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
				}
				else
				{
					$headerTarget				  = '';
				}
				$target            		= 'storage/uploads/employee/';
				$employeeId     		= $request->file('id_upload');                
				if(!empty($employeeId))
				{
					$headerImageName	= $employeeId->getClientOriginalName();
					$ext1				= $employeeId->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'employee'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/employee/'.$newHeaderLogo;
					$employeeId->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}
				$target            		= 'storage/uploads/employee/';
				$employeeId     		= $request->file('certificate');                
				if(!empty($employeeId))
				{
					$headerImageName	= $employeeId->getClientOriginalName();
					$ext1				= $employeeId->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'employee'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/employee/'.$newHeaderLogo;
					$employeeId->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}
                $employee                 		  = new \App\Models\User();
				$employee->role_id 	      		  = '3';
				$employee->employee_id    	  	  = generateEmployeeId();
				$employee->department_id    	  = $request['department_id'];
				$employee->id_type_id    	  	  = $request['id_type_id'];
                $employee->category_id    	  	  = $request['category_id'];
				$employee->sub_category_id    	  = $request['sub_category_id'];
				$employee->hierarchy_id    	  	  = $request['hierarchy_id'];
				$employee->hierarchy_name    	  = $request['hierarchy_name'];
				$employee->employee_type 		  = $request['employee_type']; 
				$employee->first_name 		  	  = $request['first_name'];
				$employee->middle_name 		  	  = $request['middle_name'];
				$employee->last_name 		  	  = $request['last_name'];
				$employee->email 	      		  = $request['email'];
				$employee->mobile 	      		  = $request['mobile'];
				$employee->password	      		  = bcrypt($request['password']);
				$employee->nationality    		  = $request['nationality'];
				$employee->resident 		  	  = $request['resident'];
				$employee->department_id     	  = $request['department_id'];
                $employee->professional_type      = $request['professional_type'];
                $employee->gender     	  		  = $request['gender'];
				$employee->date_of_hiring     	  = $request['date_of_hiring'];
				$employee->contract      		  = $request['contract'];
				$employee->home_address 		  = $request['home_address'];
                $employee->id_reference     	  = $request['id_reference'];
                $employee->country_id     		  = $request['country_id'];
                $employee->state_id       		  = $request['state_id'];
                $employee->city_id        		  = $request['city_id'];	
				$employee->status 	      		  = $request['status'];		
                $employee->image	      		  = $headerTarget;
				$employee->id_upload	      	  = $headerTarget;
				$employee->certificate	      	  = $headerTarget;
				$employee->created_by   		  = Auth::user()->id;	
			    $employee->project_id             = $request["project_id"];
			    $employee->shift_id               = $request["shift_id"];
			    
			    $employee->contract 			  = $request["contract"];
			    $employee->group_type 			  = $request["group_type"];
			    $employee->work_schedule		  = $request["work_schedule"];

				$employee->save();
				Session::flash('message', 'Employee created Successfully  !');
				return redirect('admin/employee');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/employee/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

    public function storenew(Request $request)
    {	
			try 
			{
                $employee                 		  = new \App\Models\User();

                $targetUser	= 'storage/uploads/employee/';
				$image		= $request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
				}
				else
				{
					$headerTarget				  = '';
				}

				$target            		= 'storage/uploads/employee/';
				$employeeId     		= $request->file('id_upload');                
				if(!empty($employeeId))
				{
					$headerImageName	= $employeeId->getClientOriginalName();
					$ext1				= $employeeId->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'employee'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/employee/'.$newHeaderLogo;
					$employeeId->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}

                //personal information
                $employee->first_name 		  	  = $request['first_name'];
				$employee->middle_name 		  	  = $request['middle_name'];
				$employee->last_name 		  	  = $request['last_name'];
				$employee->date_of_birth		  = $request['date_of_birth'];
				$employee->place_of_birth 		  = $request['place_of_birth'];
				$employee->nationality    		  = $request['nationality'];
				$employee->current_address        = $request['current_address'];
				$employee->country_id     		  = $request['country_id'];
                $employee->state_id       		  = $request['state_id'];
                $employee->city_id        		  = $request['city_id'];
                $employee->id_type_id    	  	  = $request['id_type_id'];
                $employee->id_reference     	  = $request['id_reference'];
                $employee->id_upload	      	  = $headerTarget;
                $employee->image	      		  = $headerTarget;
                $employee->mobile 	      		  = $request['mobile'];
                $employee->email 	      		  = $request['email'];
                $employee->marital_status 		  = $request['marital_status'];
                $employee->king_name 		      = $request['king_name'];
                $employee->king_address 		  = $request['king_address'];
                $employee->king_number 		      = $request['king_number'];
                $employee->number_of_dependent 	  = $request['number_of_dependent'];
                $employee->role_id 	      		  = '3';
                $employee->status 	      		  = '1';
                //personal information

                $employee->save();

				Session::flash('message', 'Employee created Successfully  !');
				return redirect('admin/employee/editnew/'.$employee->id);
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/employee/createnew')->withInput($request->input())->withErrors(array('message' => $message));
			}
    }

	public function edit(Request $request, $id='')
    {
        $employee 	        = \App\Models\User::find($id); 
        $countries         	= \App\Models\Country::get(["name", "id"]);
        $state_name         = \App\Models\State::get(["name", "id"]);
        $city_name         	= \App\Models\City::get(["name", "id"]);
        $states          	= \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        $cities          	= \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);
        $department			= \App\Models\Department::select('*')->where('status', '1')->get();
		$idType				= \App\Models\IdType::select('*')->where('status', '1')->get();
		$category 	 		= \App\Models\Category::select('id','name')->where('status','1')->get();
        $sub_category_name	= \App\Models\SubCategory::where("category_id",$employee->category_id)->get(["name", "id"]);
		$hierarchy_name		= \App\Models\User::get(["first_name","last_name", "id"]);

		$project_details = DB::table('projects')->get();
		$usershifts = DB::table('usershifts')->get();

		return view('admin.employee.edit', compact(['project_details','usershifts','employee', 'countries', 'state_name', 'city_name', 'states', 'cities', 'department', 'idType', 'category', 'sub_category_name','hierarchy_name']));
    }

    public function editnew(Request $request, $id='')
    {
        $employee 	        = \App\Models\User::find($id); 
        $countries         	= \App\Models\Country::get(["name", "id"]);
        $state_name         = \App\Models\State::get(["name", "id"]);
        $city_name         	= \App\Models\City::get(["name", "id"]);
        $states          	= \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        $cities          	= \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);
        $department			= \App\Models\Department::select('*')->where('status', '1')->get();
		$idType				= \App\Models\IdType::select('*')->where('status', '1')->get();
		$category 	 		= \App\Models\Category::select('id','name')->where('status','1')->get();
        $sub_category_name	= \App\Models\SubCategory::where("category_id",$employee->category_id)->get(["name", "id"]);
		$hierarchy_name		= \App\Models\User::get(["first_name","last_name", "id"]);

		$project_details = DB::table('projects')->get();
		$usershifts = DB::table('usershifts')->get();

		$certifcatesData = DB::table('certifcates')->where('user_id','=',$id)->get();
		$expData = DB::table('exp')->where('user_id','=',$id)->get();

		return view('admin.employee.editnew', compact(['project_details','usershifts','employee', 'countries', 'state_name', 'city_name', 'states', 'cities', 'department', 'idType', 'category', 'sub_category_name','hierarchy_name','certifcatesData','expData']));
    }

	public function update(Request $request,$id)
	{	
		$v = Validator::make($request->all(), [
											'first_name' 		=> 'required',
											'email' 			=> 'unique:users,email,'.$id,
											'mobile' 		 	=> 'required',
											'department_id' 		=> 'required',
											'id_type_id' 		=> 'required',
											'gender' 		 	=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
		{	
			try 
			{
				$employee	= \App\Models\User::where('id',$id)->first();
				$targetUser	= 'storage/uploads/employee/';
				$image		= $request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
					$employee->image =$headerTarget;
				}
				$targetUser	= 'storage/uploads/employee/';
				$image		= $request->file('id_upload');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
					$employee->id_upload =$headerTarget;
				}
				$targetUser	= 'storage/uploads/employee/';
				$image		= $request->file('certificate');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
					$employee->certificate =$headerTarget;
				}
				if(!empty($request['password']))
				{
					$employee->password = bcrypt($request['password']);
				}
				$employee->role_id 	  			  = '3';
				$employee->department_id    	  = $request['department_id'];
				$employee->id_type_id    	  	  = $request['id_type_id'];
                $employee->category_id    	  	  = $request['category_id'];
				$employee->sub_category_id    	  = $request['sub_category_id'];
				$employee->hierarchy_id    	  	  = $request['hierarchy_id'];
				$employee->hierarchy_name    	  = $request['hierarchy_name'];
				$employee->employee_type 		  = $request['employee_type']; 
				$employee->first_name 		  	  = $request['first_name'];
				$employee->middle_name 		  	  = $request['middle_name'];
				$employee->last_name 		  	  = $request['last_name'];
				$employee->email 	      		  = $request['email'];
				$employee->mobile 	      		  = $request['mobile'];
				$employee->nationality    		  = $request['nationality'];
				$employee->resident 		  	  = $request['resident'];
				$employee->department_id     	  = $request['department_id'];
                $employee->professional_type      = $request['professional_type'];
                $employee->gender     	  		  = $request['gender'];
				$employee->date_of_hiring     	  = $request['date_of_hiring'];
				$employee->contract      		  = $request['contract'];
				$employee->home_address 		  = $request['home_address'];
                $employee->id_reference     	  = $request['id_reference'];
                $employee->country_id     		  = $request['country_id'];
                $employee->state_id       		  = $request['state_id'];
                $employee->city_id        		  = $request['city_id'];	
				$employee->status 	      		  = $request['status'];		
				$employee->updated_by     		  = Auth::user()->id;

				$employee->project_id             = $request["project_id"];
			    $employee->shift_id               = $request["shift_id"];
			    
			    $employee->contract 			  = $request["contract"];
			    $employee->group_type 			  = $request["group_type"];
			    $employee->work_schedule		  = $request["work_schedule"];

				$employee->save();	
				Session::flash('message', 'Employee updated Successfully!');

				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/employee/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}

		}
		
	}

	public function updatenew(Request $request,$id)
	{
			try 
			{   
				$employee	= \App\Models\User::where('id',$id)->first();

                $targetUser	= 'storage/uploads/employee/';
				$image		= $request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
				}
				else
				{
					$headerTarget				  = '';
				}

				$target            		= 'storage/uploads/employee/';
				$employeeId     		= $request->file('id_upload');                
				if(!empty($employeeId))
				{
					$headerImageName	= $employeeId->getClientOriginalName();
					$ext1				= $employeeId->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'employee'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/employee/'.$newHeaderLogo;
					$employeeId->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}

				$target            		= 'storage/uploads/work_cv/';
				$work_cv     		= $request->file('work_cv');                
				if(!empty($work_cv))
				{
					$headerImageName	= $work_cv->getClientOriginalName();
					$ext1				= $work_cv->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'work_cv'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/work_cv/'.$newHeaderLogo;
					$work_cv->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}

                //personal information
                $employee->first_name 		  	  = $request['first_name'];
				$employee->middle_name 		  	  = $request['middle_name'];
				$employee->last_name 		  	  = $request['last_name'];
				$employee->date_of_birth		  = $request['date_of_birth'];
				$employee->place_of_birth 		  = $request['place_of_birth'];
				$employee->nationality    		  = $request['nationality'];
				$employee->current_address        = $request['current_address'];
				$employee->country_id     		  = $request['country_id'];
                $employee->state_id       		  = $request['state_id'];
                $employee->city_id        		  = $request['city_id'];
                $employee->id_type_id    	  	  = $request['id_type_id'];
                $employee->id_reference     	  = $request['id_reference'];
                $employee->id_upload	      	  = $headerTarget;
                $employee->image	      		  = $headerTarget;
                $employee->mobile 	      		  = $request['mobile'];
                $employee->email 	      		  = $request['email'];
                $employee->marital_status 		  = $request['marital_status'];
                $employee->king_name 		      = $request['king_name'];
                $employee->king_address 		  = $request['king_address'];
                $employee->king_number 		      = $request['king_number'];
                $employee->number_of_dependent 	  = $request['number_of_dependent'];
                $employee->role_id 	      		  = '3';
                //personal information

                //educational information
                $employee->professional_type 	  = $request['professional_type'];
                $employee->work_cv	      		  = $headerTarget;
                //educational information

                //assignment
                $employee->project_id             = $request["project_id"];
                $employee->department_id    	  = $request['department_id'];
                $employee->category_id    	  	  = $request['category_id'];
				$employee->sub_category_id    	  = $request['sub_category_id'];
			    $employee->group_type 			  = $request["group_type"];
			    $employee->work_schedule		  = $request["work_schedule"];
			    $employee->date_of_hiring     	  = $request['date_of_hiring'];
			    $employee->employment_date 		  = $request['employment_date'];
			    $employee->contract      		  = $request['contract'];
			    $employee->contract_start_date 	  = $request['contract_start_date'];
			    $employee->contract_end_date 	  = $request['contract_end_date'];
			    $employee->assigned_role 		  = $request['assigned_role'];
			    $employee->hierarchy_name    	  = $request['hierarchy_name'];
			    $employee->ASSIGNED_ENRROLMENT_MARTICULE	= $request['ASSIGNED_ENRROLMENT_MARTICULE'];
                //assignment

                //activation
                $employee->login_required    	  = $request['login_required'];
                $employee->password	      		  = bcrypt($request['login_password']);
                $employee->login_username	      = $request['login_username'];
                $employee->role_id                = $request['login_role'];
                $employee->user_type 			  = $request['user_type'];
                //activation

                $employee->save();

                //document and certificates
                $document_type = $request['document_type'];
                $atttain_from = $request['atttain_from'];
                $atttain_from_file = $request['atttain_from_file'];

                if(!empty($document_type)){
	                foreach ($document_type as $key => $val) {
	                 	$fdocument_type = $document_type[$key];
	                	$fatttain_from = $atttain_from[$key];
	                	$fatttain_from_file = $atttain_from_file[$key];

	                	$target            		= 'storage/uploads/certificates/';
						if(!empty($fatttain_from_file))
						{
							$headerImageName	= $fatttain_from_file->getClientOriginalName();
							$ext1				= $fatttain_from_file->getClientOriginalExtension();
							$temp1				= explode(".",$headerImageName);					
							$newHeaderLogo		= 'fatttain_from_file'.round(microtime(true)).".".end($temp1);				
							$headerTarget		= 'storage/uploads/work_cv/'.$newHeaderLogo;
							$fatttain_from_file->move($target,$newHeaderLogo);	
						} 
						else
						{
							$headerTarget				  = '';
						}

	                	DB::table('certifcates')->insert([
						   'user_id' => $id,
						   'certi_name' => $fdocument_type,
						   'org_name'=> $fatttain_from,
						   'docu_name'=>$headerTarget
						]);
	                 }
             	}

             	//roles and experience
             	$r_role_name = $request['r_role_name'];
                $r_role_function = $request['r_role_function'];
                $r_role_company = $request['r_role_company'];
                $r_role_startdate = $request['r_role_startdate'];
                $r_role_enddate = $request['r_role_enddate'];

                if(!empty($r_role_name)){
	                foreach ($r_role_name as $key => $val) {
	                 	$fr_role_name = $r_role_name[$key];
		                $fr_role_function = $r_role_function[$key];
		                $fr_role_company = $r_role_company[$key];
		                $fr_role_startdate = $r_role_startdate[$key];
		                $fr_role_enddate = $r_role_enddate[$key];

	                	DB::table('exp')->insert([
						   'user_id' 	  	   => $id,
						   'fr_role_name' 	   => $fr_role_name, 
						   'fr_role_function'  => $fr_role_function,
						   'fr_role_company'   => $fr_role_company,
						   'fr_role_startdate' => $fr_role_startdate, 
						   'fr_role_enddate'   => $fr_role_enddate
						]);
	                 }
             	}

				Session::flash('message', 'Employee updated Successfully!');
				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/employee/editnew/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}
	}

    public function view(Request $request, $id='')
    {
        $employee             = \App\Models\User::select("users.*", DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))->find($id);
        $hierarchy_name       = \App\Models\User::all();
		$employee->country    = \App\Models\Country::select('name')->find($employee->country_id);
        $employee->state      = \App\Models\State::select('name')->find($employee->state_id);
        $employee->city       = \App\Models\City::select('name')->find($employee->city_id);
        $employee->department = \App\Models\Department::select('name')->find($employee->department_id);
		$employee->id_type	  = \App\Models\IdType::select('name')->find($employee->id_type_id);
        return view('admin.employee.view', compact(['employee','hierarchy_name']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\User::whereIn('id',$ids)->delete();
        Session::flash('message', 'employee Deleted Successfully! ');
        return redirect('admin/employee');
    }

    public function fetchState(Request $request)
    {
        $data['states'] = \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

	public function getSubCategory(Request $request)
    {
        $data['subCategory'] = \App\Models\SubCategory::where("category_id",$request->category_id)
                                ->get(["name","id"]);
        return response()->json($data);
    }

    public function getGroupSubCategory(Request $request)
    {
        // $data['subCategory'] = DB::table('users')
        // 						->where('category_id', '=', $request->category_id)
        // 						->where('sub_category_id', '=', $request->subcategory_id)
        // 						->where('employee_type', '!=', '1')
        // 						->get();

   //      $data['subCategory'] =  DB::table('users')
			// ->select('users.shift_id','usershifts.id','usershifts.shift_title')
			// ->join('usershifts','usershifts.id','=','users.shift_id')
			// ->where('users.category_id', '=', $request->category_id)
   //      	->where('users.sub_category_id', '=', $request->subcategory_id)
   //      	//->where('users.group_type', '=', $request->group_id)
   //      	->where('users.employee_type', '!=', '1')
   //      	->groupBy('usershifts.id')
   //      	->groupBy('users.shift_id')
   //      	->groupBy('usershifts.shift_title')
   //      	->get(['usershifts.id','usershifts.shift_title']);

    	$category_id    = $request->category_id;
    	$subcategory_id = $request->subcategory_id;
    	$project_id     = $request->project_id;

    	$data['subCategory'] =  DB::table('users')
			->select('users.*')
			->where('users.category_id', '=', $category_id)
        	->where('users.sub_category_id', '=', $subcategory_id)
        	->where('users.project_id', '=', $project_id)
        	->get();

        return response()->json($data);
    }

    public function shiftGetGroupSubCategory(Request $request)
    {	
        $data['subCategory'] =  DB::table('users')
			->select('users.shift_id','usershifts.id','usershifts.shift_title')
			->join('usershifts','usershifts.id','=','users.shift_id')
			->where('users.category_id', '=', $request->category_id)
        	->where('users.sub_category_id', '=', $request->sub_category_id)
        	->where('users.group_type', '=', $request->group_id)
        	->where('users.employee_type', '!=', '1')
        	->groupBy('usershifts.id')
        	->groupBy('users.shift_id')
        	->groupBy('usershifts.shift_title')
        	->get(['usershifts.id','usershifts.shift_title']);

        return response()->json($data);
    }

	public function getHierarchy(Request $request)
    {
        $data['hierarchy'] = \App\Models\User::where("department_id",$request->department_id)
								//->where("role_id", "!=", "1")
                                ->get(["id","first_name","last_name","employee_id","department_id"]);
								//echo "<pre>"; print_r($data['hierarchy']); die;
        return response()->json($data);
    }

    
    public function exportEmployee(Request $request)
	{
        return Excel::download(new ExportEmployee, 'employee.xlsx');
    }

    public function adminEmployeeProjectList(){
    	$datacountlists   = \App\Models\User::where('role_id', '3')->get();
		$employee         = \App\Models\User::select('*')->where('status','1')->where('role_id', '3')->get();
        if(is_object($employee) && !empty($employee))
		{
			if(!empty( $_GET['txt_search']))
			{
				$employee = DB::table('users as ch')
						  ->where('ch.first_name', 'LIKE', "%{$_GET['txt_search']}%") 
						  ->orWhere('ch.employee_id', 'LIKE', "%{$_GET['txt_search']}%") 
						  ->where('ch.role_id', '!=', '1')
						  ->select('ch.*')
						  ->orderBy('ch.id','Desc')->paginate(10);
			}
			else
			{
				$employee = DB::table('users as ch')
						->where('ch.role_id','!=','1')
                        ->select('ch.*')
                        ->orderBy('ch.id','Desc')->paginate(10);
			}

			$projectlist = DB::table('projects')->get();

			return view('admin.employee.assignedprojectlist', compact(['projectlist','employee', 'datacountlists']));
		}
		else
		{
			return redirect('/');
		}
    }

    public function adminEmployeeLeaveList(){
    	$datacountlists   = \App\Models\User::where('role_id', '3')->get();
		$employee         = \App\Models\User::select('*')->where('status','1')->where('role_id', '3')->get();
        if(is_object($employee) && !empty($employee))
		{
			if(!empty( $_GET['txt_search']))
			{
				$employee = DB::table('users as ch')
						  ->where('ch.first_name', 'LIKE', "%{$_GET['txt_search']}%") 
						  ->orWhere('ch.employee_id', 'LIKE', "%{$_GET['txt_search']}%") 
						  ->where('ch.role_id', '!=', '1')
						  ->select('ch.*')
						  ->orderBy('ch.id','Desc')->paginate(10);
			}
			else
			{
				$employee = DB::table('users as ch')
						->where('ch.role_id','!=','1')
                        ->select('ch.*')
                        ->orderBy('ch.id','Desc')->paginate(10);
			}

			$projectlist = DB::table('leaves')->get();

			return view('admin.employee.leavelist', compact(['projectlist','employee', 'datacountlists']));
		}
		else
		{
			return redirect('/');
		}
    }

    public function employeeApplyLeave(){
		return view('admin.employee.applyleave', compact([]));
    }

    public function managerBulkPunchin(){
    	$category 	 	= \App\Models\Category::select('id','name')->where('status','1')->get();
		return view('admin.employee.managerBulkPunchin', compact(['category']));
    }

    public function presentEmployee(){
    	$category 	 	= \App\Models\Category::select('id','name')->where('status','1')->get();

		return view('admin.employee.presentEmployee', compact(['category']));
    }

    public function absentEmployee(){
    	$category 	 	= \App\Models\Category::select('id','name')->where('status','1')->get();

		return view('admin.employee.absentEmployee', compact(['category']));
    }


    public function managerAttendanceList (){
    	return view('admin.employee.managerBulkPunchin', compact([]));
    }

	public function searchEmployees(Request $request)
	{
		$v = Validator::make($request->all(), [
											'category_id' 			  => 'required',
											'sub_category_id' 		  => 'required',
											//'group_category_id' 	  => 'required',
											'shift_group_category_id' => 'required',
											]);
		if ($v->fails())
		{
		return redirect()->back()->withInput($request->input())->withErrors($v->errors());
		}


		$category 	   = \App\Models\Category::select('id','name')->where('status','1')->get();
		$employeesData = \App\Models\User::where('category_id',$request->category_id ?? '')
		                  ->where('sub_category_id',$request->sub_category_id ?? '')
		                  //->where('group_type',$request->group_category_id ?? '')
		                  ->where('shift_id',$request->shift_group_category_id ?? '')
						 
						  ->get();
						//   dd($request->all(),$employeesData);
					Session::flash('message', 'Featch Employees Successfully !');
		    return view('admin.employee.managerBulkPunchin')->with([
																	'employeesData'           => $employeesData,
																	'category'                => $category,
																	'category_id'             => $request->category_id,
																	'sub_category_id'         => $request->sub_category_id,
																	'group_category_id'       => $request->group_category_id,
																	'shift_group_category_id' => $request->shift_group_category_id,
																]);
	}

	public function searchPresentEmployees(Request $request)
	{
		// $v = Validator::make($request->all(), [
		// 									'category_id' 			  => 'required',
		// 									'sub_category_id' 		  => 'required',
		// 									'group_category_id' 	  => 'required',
		// 									'shift_group_category_id' => 'required',
		// 									]);
		// if ($v->fails())
		// {
		// return redirect()->back()->withInput($request->input())->withErrors($v->errors());
		// }


		$category 	   = \App\Models\Category::select('id','name')->where('status','1')->get();

		// $employeesData = \App\Models\User::where('category_id',$request->category_id ?? '')
		//                   ->where('sub_category_id',$request->sub_category_id ?? '')
		//                   ->where('group_type',$request->group_category_id ?? '')
		//                   ->where('shift_id',$request->shift_group_category_id ?? '')
						 
		// 				  ->get();
						//   dd($request->all(),$employeesData);



					Session::flash('message', 'Featch Employees Successfully !');
		    // return view('admin.employee.presentEmployee')->with([
						// 											'employeesData'           => $employeesData,
						// 											'category'                => $category,
						// 											'category_id'             => $request->category_id,
						// 											'sub_category_id'         => $request->sub_category_id,
						// 											'group_category_id'       => $request->group_category_id,
						// 											'shift_group_category_id' => $request->shift_group_category_id,
						// 										]);

					$getDate = $request->filter_date;
					$orderdate = explode('-', $getDate);
					$year = $orderdate[0];
					$month   = $orderdate[1];
					$date  = $orderdate[2];
					$final_date = $date."-".$month."-".$year;

					$employeesData = DB::table('attendances')->where('punch_in','=',$final_date)->get();


					return view('admin.employee.presentEmployee')->with([
																	'employeesData'           => $employeesData,
																	'category'                => $category,
																	'category_id'             => "",
																	'sub_category_id'         => "",
																	'group_category_id'       => "",
																	'shift_group_category_id' => "",
																]);
	}

	public function searchAbsentEmployees(Request $request)
	{
		// $v = Validator::make($request->all(), [
		// 									'category_id' 			  => 'required',
		// 									'sub_category_id' 		  => 'required',
		// 									'group_category_id' 	  => 'required',
		// 									'shift_group_category_id' => 'required',
		// 									]);
		// if ($v->fails())
		// {
		// return redirect()->back()->withInput($request->input())->withErrors($v->errors());
		// }


		$category 	   = \App\Models\Category::select('id','name')->where('status','1')->get();

		// $employeesData = \App\Models\User::where('category_id',$request->category_id ?? '')
		//                   ->where('sub_category_id',$request->sub_category_id ?? '')
		//                   ->where('group_type',$request->group_category_id ?? '')
		//                   ->where('shift_id',$request->shift_group_category_id ?? '')
						 
		// 				  ->get();

		$getDate = $request->filter_date;
					$orderdate = explode('-', $getDate);
					$year = $orderdate[0];
					$month   = $orderdate[1];
					$date  = $orderdate[2];
					
					$final_date = $date."-".$month."-".$year;

					$employeesData = DB::table('attendances')
										->where('punch_in','=',$final_date)
										->where('status','=',0)
										->get();

					Session::flash('message', 'Featch Employees Successfully !');

					return view('admin.employee.absentEmployee')->with([
																	'employeesData'           => $employeesData,
																	'category'                => $category,
																	'category_id'             => "",
																	'sub_category_id'         => "",
																	'group_category_id'       => "",
																	'shift_group_category_id' => "",
																]);


		    // return view('admin.employee.absentEmployee')->with([
						// 											'employeesData'           => $employeesData,
						// 											'category'                => $category,
						// 											'category_id'             => $request->category_id,
						// 											'sub_category_id'         => $request->sub_category_id,
						// 											'group_category_id'       => $request->group_category_id,
						// 											'shift_group_category_id' => $request->shift_group_category_id,
						// 										]);
	}

	


	public function present($id)
	{
		

		$employeesData = \App\Models\User::where('id',$id)->first();
		try 
		{ 
			$timestamp = time();

			$offset      = 19800; //converting 5 hours to seconds.
			$dateFormat  = "d-m-Y H:i";
			$timeNdate   = gmdate($dateFormat, time()+$offset);

			$utcDate     = date('H:i', strtotime(gmdate('r', $timestamp)));
			$newDateTime = date('A', strtotime(gmdate('r', $timestamp)));
			
				$attendance                     = new \App\Models\Attendance();
				$attendance->user_id 		  	= $employeesData->id ?? '';
				$attendance->punchin_time 		= $utcDate ?? '';
				$attendance->punch_in 	        = date('d-m-Y', strtotime($timeNdate)) ?? '';		
				$attendance->punchin_time_ampm 	= $newDateTime ?? '';		
				$attendance->status 	        = 1;		
				$attendance->save();
				
			
				Session::flash('message', 'User attendees add Successfully !');
				return redirect('admin/admin-employee-managerbulkpunchin');
		} 
		catch (\Exception $e) 
		{
			$status 	= false;
			$message 	= $e->getMessage();
			return redirect('admin/sub_category/create')->withInput($request->input())->withErrors(array('message' => $message));
		}
	}

	public function presentpunchout($id)
	{	
		//get user id from record
		$projectlist = DB::table('attendances')
											->where('id','=',$id)
											->get();

		$employeesData = \App\Models\User::where('id',$projectlist[0]->user_id)->first();
		try 
		{ 
			$timestamp = time();

			$offset      = 19800; //converting 5 hours to seconds.
			$dateFormat  = "d-m-Y H:i";
			$timeNdate   = gmdate($dateFormat, time()+$offset);

			$utcDate     = date('H:i', strtotime(gmdate('r', $timestamp)));
			$newDateTime = date('A', strtotime(gmdate('r', $timestamp)));

			DB::table('attendances')
				        ->where('id', $id)  // find your user by their email
				        ->update(array(
				        	'punchout_time' => $utcDate ?? '',
				        	'punchout_time_ampm' => $newDateTime ?? ''
				        ));  // update the record in the DB. 
			
			Session::flash('message', 'User attendees updated Successfully !');
			return redirect('admin/admin-employee-presentemployee');
		} 
		catch (\Exception $e) 
		{
			$status 	= false;
			$message 	= $e->getMessage();
			return redirect('admin/sub_category/create')->withInput($request->input())->withErrors(array('message' => $message));
		}
	}

	public function absent($id)
	{
		

		$employeesData = \App\Models\User::where('id',$id)->first();
		try 
		{ 
			$timestamp = time();

			$offset      = 19800; //converting 5 hours to seconds.
			$dateFormat  = "d-m-Y H:i";
			$timeNdate   = gmdate($dateFormat, time()+$offset);
			
			$utcDate     = date('H:i', strtotime(gmdate('r', $timestamp)));
			$newDateTime = date('A', strtotime(gmdate('r', $timestamp)));
			
				$attendance                     = new \App\Models\Attendance();
				$attendance->user_id 		  	= $employeesData->id ?? '';
				$attendance->punchin_time 		= '';
				$attendance->punch_in 	        = date('d-m-Y', strtotime($timeNdate)) ?? '';		
				$attendance->punchin_time_ampm 	= '';		
				$attendance->status 	        = 0;		
				$attendance->save();
				
			
				Session::flash('message', 'User attendees add Successfully !');
				return redirect('admin/admin-employee-managerbulkpunchin');
		} 
		catch (\Exception $e) 
		{
			$status 	= false;
			$message 	= $e->getMessage();
			return redirect('admin/sub_category/create')->withInput($request->input())->withErrors(array('message' => $message));
		}
	}

    public function updateHolidayStatus(Request $request)
	{
    	$id     = $request->id;
    	$status = $request->status;

    	DB::table('holiday_list')
        ->where('id', $id)  // find your user by their email
        ->update(array('status' => $status));  // update the record in the DB. 
    }

    public function updateSecondStatus(Request $request){
    	$id     = $request->id;
    	$status = $request->status;

    	DB::table('secondry_bonus')
        ->where('id', $id)  // find your user by their email
        ->update(array('status' => $status));  // update the record in the DB. 
    }

    public function deleteCertificate(Request $request){
    	$id = $request->id;

    	DB::table('certifcates')->delete($id);
    }

    public function deleteExperience(Request $request){
    	$id = $request->id;

    	DB::table('exp')->delete($id);
    }
}