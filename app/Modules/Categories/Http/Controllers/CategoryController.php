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

    public function create(Request $request) {
    	return \Theme::view('category.create');
    }

    public function store(Request $request) {
    	$param = [];
    	$param = $request->all();
    	$param['admin_id'] = session('user.0.id');
    	
		$post = \Curl::to(env('API_URL').'category')
    		->withData($param)
			->asJson()
	        ->post();	

    	
	    if($post->meta->status == true) {
	    	return redirect('/category');
	    }
	    
    	return \Theme::view('category.create', compact('post', 'category'));
    }

    public function edit(Request $request, $id) {
    	$param = [];
    	$param['id'] = $id;
    	$param['admin_id'] = session('user.0.id');
    	$category = \Curl::to(env('API_URL').'category/show')
    		->withData($param)
			->asJson()
	        ->get();
	    
	    
    	return \Theme::view('category.update', compact('category'));
    }

    public function update(Request $request, $id) {
    	$param = [];
    	$param = $request->all();
    	$param['admin_id'] = session('user.0.id');
    	$param['_method'] = 'patch';
    	$param['id'] = $id;
    	
    		$post = \Curl::to(env('API_URL').'category')
	    		->withData($param)
				->asJson()
		        ->post();	
    	
	    if($post->meta->status == true) {
	    	return redirect('/category');
	    }
	    
    	return \Theme::view('category.update', compact('post', 'category'));
    }
}
