<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Hash;
use Auth;
use Helper;

class DashboardController extends Controller
{
    public function getIndex()
    {   
        $user 	=   \App\Models\User::where('id',Auth::user()->id)->first();
        $role	=	AdminMenuController::userMenus($user->role_id);
		//echo "<pre>"; print_r($user->role_id); die;
        Session::put('role',$user->role_id);
        return view('admin.dashboard.index', compact(['user']));
    }

   
    
}
