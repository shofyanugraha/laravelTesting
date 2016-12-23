<?php

namespace App\Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Theme;

class PostController extends Controller
{
    public function index(Request $request) {
    	$param = [];
    	$param['filter'] = $request->input('filter');
    	$param['category'] = $request->input('category');
    	$param['page'] = $request->input('page', 1);
    	$param['offset'] = $request->input('offset', 10);
		$param['result_type'] = $request->input('result_type');
		$param['q'] = $request->input('result_type');

    	$post = \Curl::to(env('API_URL').'post')
			->withData($param)
			->asJson()
	        ->get();
	    
    	return \Theme::view('post.index', compact('post', 'param'));
    }
}
