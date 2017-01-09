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
    	$param['sort'] = $request->input('sort', 'latest');
    	$param['offset'] = $request->input('offset', 10);
		$param['result_type'] = $request->input('result_type');
		$param['q'] = $request->input('q');

    	$post = \Curl::to(env('API_URL').'post')
			->withData($param)
			->asJson()
	        ->get();
    	return \Theme::view('post.index', compact('post', 'param'));
    }

    public function create(Request $request) {
    	$post = null;
    	$category = \Curl::to(env('API_URL').'category')
			->asJson()
	        ->get();
	    
    	return \Theme::view('post.create', compact('post', 'category'));
    }

    public function store(Request $request) {
    	$param = [];
    	$param = $request->all();
        $param['title'] = htmlspecialchars($param['title']);
    	$param['writer_id'] = session('user.0.id');
    	
    	if($param['type'] == 'video') {
    		$post = \Curl::to(env('API_URL').'post')
	    		->withData($param)
				->asJson()
		        ->post();	
    	} else {
    		// $param['image'] = file_get_contents($_FILES['image']);
    		$request->file('image')->move(public_path().  '/uploads', 'image.png');
			// Assemble Login Credentials
			$path = public_path().'/uploads/'. 'image.png';
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$image = 'data:image/' . $type . ';base64,' . base64_encode($data);
			$param['image'] = $image;
    		$post = \Curl::to(env('API_URL').'post')
				->withData($param)
				->asJson()
		        ->post();	
    	}
    	
	    if($post->meta->status == true) {
	    	return redirect('/post');
	    } else {

	    }
	    
    	return \Theme::view('post.create', compact('post', 'category'));
    }

    public function edit(Request $request, $id) {
    	$param = [];
    	$param['id'] = $id;
    	$post = \Curl::to(env('API_URL').'post/show')
    		->withData($param)
			->asJson()
	        ->get();
	    $category = \Curl::to(env('API_URL').'category')
			->asJson()
	        ->get();
	    
    	return \Theme::view('post.update', compact('post', 'category'));
    }

    public function update(Request $request, $id) {
    	$param = [];
    	$param = $request->all();
    	$param['writer_id'] = session('user.0.id');
    	$param['_method'] = 'patch';
    	$param['id'] = $id;
    	
    	if($param['type'] == 'video') {
    		$post = \Curl::to(env('API_URL').'post')
	    		->withData($param)
				->asJson()
		        ->post();	
    	} else {
    		// $param['image'] = $_FILES['image'];
    		$post = \Curl::to(env('API_URL').'post')
				->withContentType('multipart/form-data')
	    		->withData($param)
	    		->containsFile(true)
		        ->post();	
		    dd($post);
    	}
    	
	    if($post->meta->status == true) {
	    	return redirect('/post');
	    }
	    
    	return \Theme::view('post.create', compact('post', 'category'));
    }

    

    public function status(Request $request, $id, $status) {
    	$param = [];
    	$param['editor_id'] = session('user.0.id');
    	$param['admin_id'] = session('user.0.id');
    	$param['id'] = $id;
    	$param['status'] = $status;
    	$param['_method'] = 'patch';
    	// dd($param);
		$post = \Curl::to(env('API_URL').'post/status')
    		->withData($param)
			->asJson()
	        ->post();	
    	
	    if($post->meta->status == true) {
	    	return redirect('/post');
	    }
	    
    	return \Theme::view('post.create', compact('post', 'category'));
    }


}
