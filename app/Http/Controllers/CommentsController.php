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
	public function index($post_id, $comment_parent_id = 0)
	{
		return view('wadapp.create_comments', compact('post_id', 'comment_parent_id'));
	}

	public function store($post_id, MyCommentRequest $request)
	{
		$this->saveComment($request, $post_id);

		return redirect()->route('postEdit', $post_id); //keep only for redirect way
	}

	/**
	 * Store child comment
	 *
	 * @return view
	 **/
	public function childStore($post_id, $comment_parent_id, MyCommentRequest $request)
	{
		$this->saveComment($request, $post_id, $comment_parent_id);

		return redirect()->route('postEdit', $post_id); //keep only for redirect way
	}

	/**
	 * Helper for saving the comment
	 *
	 * @return void
	 **/
	private function saveComment(MyCommentRequest $request, $post_id, $comment_parent_id = -1)
	{
		//store in db
		$comment = new Comment($request->all());

		//auto cast to int from the model (see 'casts' array)
		$comment->post_id = $post_id;
		$comment->user_id = Auth::user()->id;
		//save the child comment
		if ($comment_parent_id >= 0)
		{
			$comment->parent_id = $comment_parent_id;
		}
		$comment->save();
	}
}
