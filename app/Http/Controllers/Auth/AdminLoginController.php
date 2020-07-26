<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
 class AdminLoginController extends Controller
 {   
	public function __construct()
	{
		$this->middleware('guest:admin' ,['except'=>['logout']]);
	}
    public function showLoginForm()
    {
    	return view('auth.Admin-login');
    }

    public function login(Request $request)
    {
    	//validate the form
    	$this->validate($request,[
    		'email'=>'required|email',
    		'password'=>'required|min:6'
    	]);

    	//attemp to login
    	
    	if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password'=> $request->password ],$request->remember))
    	{
    		return redirect()->intended(route('admin.dashboard'));
    	}
    	return redirect()->back()->withInput($request->only('email','remember'));
    	//if login successful then redirect to page
    	//if unscceeful then redirect back
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
