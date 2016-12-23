<?php

namespace App\Modules\Categories\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Theme;

class CategoryController extends Controller
{
    public function index(Request $request) {
    	$category = \Curl::to(env('API_URL').'category')
			->asJson()
	        ->get();
	    
    	return \Theme::view('category.index', compact('category'));
    }
}
