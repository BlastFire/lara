<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::with('user')->paginate();

    	$comments = Comment::where('post_id', 12)->get();
    	$comments_by_id = new Collection;

    	//return dd($comments_by_id);



    	return view('wadapp.index', compact('posts'));
    }

    public function show($id)
    {
    	$post = Post::with('user')->find($id);

    	$comments = $this->allComments($id);

    	return view('wadapp.show', compact('post', 'comments'));
    }

    private function allComments($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->get();

        $comments_by_id = new Collection;

        foreach ($comments as $comment)
        {
            $comments_by_id->put($comment->id, $comment);
        }

        foreach ($comments as $key => $comment)
        {
            $comments_by_id->get($comment->id)->children = new Collection;

            if ($comment->parent_id != 0)
            {
                $comments_by_id->get($comment->parent_id)->children->push($comment);
                unset($comments[$key]);
            }
        }

        return $comments;
    }
}
