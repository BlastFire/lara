<?php

namespace App\Http\Controllers;

use Auth;
use Request;
use App\Post;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Increase or Decrease page rank field in a post by user
     *
     * @return void
     **/
    public function manipulatePostCounter($post_id, $pageRankValue)
    {
    	if(Request::ajax()) {
    		$post = Post::with('user')->find($post_id);

    		if(!$post)
				abort(422, "Not valid post id");

			if (Auth::user()->getId() == $post->user_id) {
				abort(422, "You cant vote for your own post");
			}

			if(empty($pageRankValue)) {
				$post->page_rank--;
			} else {
				$post->page_rank++;
			}
			
			$post->save();
			 return response([
                'success' => true,
                'message' => $post->page_rank
            ], 200);
    	} else {
    		abort(422, "this is an api");
    	}
    }
}
