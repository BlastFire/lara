<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

	public function store(MyCommentRequest $request)
	{
		//store in db
		$comment = new Comment($request->all());

		//redirect to the post
		return $comment;
	}
}
