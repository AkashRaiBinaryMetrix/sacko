<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUser;
use App\Models\User;
use App\Models\Role;
use Hash;
use Session;
use Validator;

class UserController extends Controller
{
	public function index()
	{
		$user 	= \Auth::guard()->user();	
		$users 	= User::select(['*'])->where('role_id','=','2')->paginate(10);
		$roles 	= \App\Models\Role::select('*')->get();
		return view('admin.user.index', compact(['users', 'roles']));
		
	}
	
	public function create(Request $request)
    {
		$role		= \App\Models\Role::where('status','1')->get();
		return view('admin.user.create',compact(['role']));
    }

	public function store(Request $request)
    {	
        $v = Validator::make($request->all(), [
											'first_name' 		=> 'required',
											'email' 		 	=> 'required|unique:users|max:191',
											'mobile' 		 	=> 'required',
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

				$userprofile 	= new User();
				$targetUser		='storage/uploads/users/';
				$image			= $request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	= $image->getClientOriginalName();
					$ext1				= $image->getClientOriginalExtension();				
					$temp1				= explode(".",$headerImageName);				 
					$newHeaderLogo		= 'image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		= $targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
					$userprofile->image = $headerTarget;
				}
				$userprofile->role_id 	      		  	= '2';
				$userprofile->first_name				= $request['first_name'];
				$userprofile->middle_name				= $request['middle_name'];
				$userprofile->last_name					= $request['last_name'];
				$userprofile->email 	 				= $request['email'];
				$userprofile->mobile 	 				= $request['mobile'];
				$userprofile->password	 				= bcrypt($request['password']);
                $userprofile->gender     	  		  	= $request['gender'];
				$userprofile->status 	      		  	= $request['status'];		
                $userprofile->image	      		  		= $headerTarget;
				$userprofile->created_by 		  		= Auth::user()->id;	
				$userprofile->save();
				Session::flash('message', 'User Successfully created !');
				return redirect('admin/user');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/user/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

	public function edit(Request $request, $id='')
    {
		$user 	   	= \App\Models\User::find($id); 
        $role		= \App\Models\Role::select('*')->where('status', '1')->get();
		return view('admin.user.edit', compact(['user', 'role']));
     }
	
	public function update(Request $request,$id)
	{	
		$v = Validator::make($request->all(), [
											'first_name' 		=> 'required',
											'email' 			=> 'unique:users,email,'.$id,
											'mobile' 		 	=> 'required',
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
				$userprofile	= User::where('id',$id)->first();
				$targetUser		='storage/uploads/users/';
				$image			=$request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
					$userprofile->image =$headerTarget;
				}
				if(!empty($request['password']))
				{
					$userprofile->password				= bcrypt($request['password']);
				}
				$userprofile->role_id 	  			  	= '2';
				$userprofile->first_name		 		= $request['first_name'];
				$userprofile->middle_name				= $request['middle_name'];
				$userprofile->last_name					= $request['last_name'];
				$userprofile->email 	 				= $request['email'];
				$userprofile->mobile	 				= $request['mobile'];
                $userprofile->gender     	  		  	= $request['gender'];
				$userprofile->status 	      		  	= $request['status'];
				$userprofile->updated_by     		  	= Auth::user()->id;
				$userprofile->save();	
				Session::flash('message', 'User updated Successfully!');
				
				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/user/edit/'.$id)->withInput($request->input())->withErrors(array('message' => $message));
			}

		}
		
	}

	public function profile()
    {
        $user 				= \Auth::guard()->user();
        $data['user'] 		= $user;
        $data['profile'] 	= User::all();
        return view('admin.user.profile', $data);
    }

    public function updateprofile(Request $request)
	{	
		
		$v = Validator::make($request->all(), [
											'first_name' 	=> 'required',
											'email' 		=> 'unique:users,email,'.Auth::user()->id,
											'mobile' 		=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
		{	
			try 
			{
				$userprofile	=User::where('id',Auth::user()->id)->first();
				$targetUser		='storage/uploads/users/';
				$image			=$request->file('image');    
				if(!empty($image))
				{				  
					$headerImageName	=$image->getClientOriginalName();
					$ext1				=$image->getClientOriginalExtension();				
					$temp1				=explode(".",$headerImageName);				 
					$newHeaderLogo		='image'.round(microtime(true)).".".end($temp1);				 
					$headerTarget		=$targetUser.$newHeaderLogo;
					$image->move($targetUser,$newHeaderLogo);
					$userprofile->image =$headerTarget;
				}
				if(!empty($request['password']))
				{
					$userprofile->password		=bcrypt($request['password']);
				}
				$userprofile->first_name	= $request['first_name'];
				$userprofile->middle_name 	= $request['middle_name'];
				$userprofile->last_name 	= $request['last_name'];
				$userprofile->email 		= $request['email']; 
				$userprofile->mobile		= $request['mobile'];
				$userprofile->save();	
				Session::flash('message', 'Profile updated Successfully!');
				
				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/user/profile')->withInput($request->input())->withErrors(array('message' => $message));
			}
		}
	}


    public function last_login()
	{
		$lastlogin 			= User::orderBy('last_logout','Desc')->paginate(25);
		return view('user.lastlogin',compact('lastlogin'));
	}

	public function savechangepassword(Request $request)
	{
			$x = Validator::make($request->all(), [
												'password' => 'required',
												'password_confirmation' => 'required'
												]);	
			
			if ($x->fails())
			{
				return redirect()->back()->withInput($request->input())->withErrors($x->errors());
			}
			else
			{
				$userpass=User::where('id',Auth::user()->id)->first();
				if($request['password']!=$request['password_confirmation'])
				{
					Session::flash('error_message', 'Entered password and Confirm password does not match.');
					return redirect('admin/user/profile/');
				}
				else
				{
					$userpass->password = bcrypt($request['password']);
					$userpass->save();
					Session::flash('message', 'Password Changed Successfully!');
				    return redirect('admin/user/profile/');
				}  
			}
		}


	public function logout(Request $request) 
	{
		$user 				= User::where('id',Auth::user()->id)->first();
		$user->last_logout	=date('Y-m-d h:i:s');		
		$user->save();
        Session::flush();	
		Auth::logout();
		return redirect('/admin');
	}
		
	public function delete(Request $request,$id='')
    {	
        $ids 		= $request->mul_del;
        User::whereIn('id',$ids)->delete();
        Session::flash('message', 'User Deleted Successfully !');
        return redirect('admin/user/');
    }

	public function view(Request $request, $id='')
    {
        $user            = \App\Models\User::find($id);
        $user->country   = \App\Models\Country::select('name')->find($user->country_id);
        $user->state     = \App\Models\State::select('name')->find($user->state_id);
        $user->city      = \App\Models\City::select('name')->find($user->city_id);
		$user->branch    = \App\Models\Branch::select('id','name')->find($user->branch_id);
        $user->region	 = \App\Models\Region::select('name')->find($user->region_id);
        return view('admin.user.view', compact(['user']));
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
    
    public function exportUsers(Request $request)
	{
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}