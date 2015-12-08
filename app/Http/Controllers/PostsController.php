<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
    	//$posts = Post::latest()->first();
    	//$posts = Post::all();
    	//$user = User::find($posts->user_id);
    	//$posts['user_name'] = $user->name;
    	//return dd($user);

    	$posts = Post::with('user')->paginate();
    	
    	return view('grizmin.index', compact('posts'));
    }
}
