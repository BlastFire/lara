<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Requests\MyCommentRequest;
use App\Http\Controllers\Controller;
use App\Comment;


class CommentsController extends Controller
{
	public function index($post_id)
	{
		return view('wadapp.create_comments', compact('post_id'));
	}

	public function store($post_id, MyCommentRequest $request)
	{
		//store in db
		$comment = new Comment($request->all());
		//auto cast to int from the model (see 'casts' array)
		$comment->post_id = $post_id;
		$comment->user_id = Auth::user()->id;
		$comment->save();

		//return $comment;
		//redirect to the post !!
		return redirect('posts');
	}
}
