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

	public function store($id, MyCommentRequest $request)
	{
		//the post_id from URI
		return $id;
		//store in db
		$comment = new Comment($request->all());
		Auth::user()->posts()->save($comment);
		return $comment->post_id;
		//redirect to the post
		return redirect()->route('postEdit', $comment->post_id);
	}
}
