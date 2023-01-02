<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::guard()->user() !== null) {
                return redirect()->route('admin.dashboard');
            }
            return $next($request);
        });
    }

    public function getLogin()
    {	
        return view('admin.auth.login');
    }


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) 
        {   
            return redirect()->intended('admin/dashboard')->withSuccess('You have Successfully loggedin');
            
        }
        else
        {  
            return redirect('admin/')->withInput($request->input())->withErrors(array('message' => 'Oppes! You have entered invalid credentials'));
            //Session::flash('error_message', 'Entered password and Confirm password does not match.');
            //return redirect('admin/');
            //return redirect("admin")->withSuccess('Oppes! You have entered invalid credentials');
        }
    }

    // public function logout()
    // {	
    //     Session::flush();
    //     Auth::logout();
    //     return Redirect('login');
    // }

    // public function logout()
    // {
    //     \Auth::guard()->logout();
    //     return redirect()->route('login.admin')->with(['success' => ('user logged out')]);
    // }

    // public function logout(Request $request) 
	// {
	// 	$user = User::where('id',Auth::user()->id)->first();
	// 	$user->last_logout=date('Y-m-d h:i:s');		
	// 	$user->save();
    //     Session::flush();	
	// 	Auth::logout();
	// 	return redirect('/login');
	// }


}
