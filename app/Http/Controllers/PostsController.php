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
    	$posts = Post::with('user')->paginate();
    	return view('grizmin.index', compact('posts'));
    }
}
