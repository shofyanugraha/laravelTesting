<?php

namespace App\Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Theme;

class AuthenticationController extends Controller
{
    public function index(Request $request) {
    	if(session('user')) 
    		return redirect('/dashboard');
		return Theme::view('site.login');
	}
	
	public function logout(Request $request) {
		$request->session()->pull('user');
		return redirect('/');
	}

	public function dashboard(Request $request) {
		return Theme::view('site.login');
	}

	public function session(Request $request) {
		$request->session()->push('user', $request->all());
		return json_encode(['status'=>true]);
	}
}
