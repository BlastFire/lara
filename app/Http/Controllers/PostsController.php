<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Post;
use App\User;
use App\Comment;
use App\Http\Requests;
use App\Http\Requests\MyPostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class PostsController extends Controller
{
	function __construct() {
		//$this->middleware('auth', ['only' => 'create']);
	}

	/**
	 * Index page for all the posts
	 * (by the laravel convention)
	 *
	 * @return view
	 **/
    public function index()
    {
    	$posts = Post::with('user')->paginate(20);

    	return view('wadapp.index', compact('posts'));
    }

    /**
     * View single post
     *
	 * (by the laravel convention)
     * @return view
     **/
    public function show($id)
    {
    	$post = Post::with('user')->find($id);

    	$comments = $this->allComments($id);

    	return view('wadapp.show', compact('post', 'comments'));
    }

    /**
     * Create a post
     *
     * @return view
     * @author 
     **/
    public function create()
    {
    	return view('wadapp.create');
    }

    /**
     * Stores post from user
     *
     * @return void
     * @author 
     **/
    public function store(MyPostRequest $request)
    {
		$post = new Post($request->all());
    	Auth::user()->posts()->save($post);

    	//return redirect()->route('postEdit', [Auth::user()->id]); //keep only for redirect way
    	return redirect('posts'); // redirects to route,calls index method in this controller
    }

    /**
     * Helper method for sorting all the child comments to their parent
     *
     * @return the sorted comments
     **/
    private function allComments($post_id)
    {
        $comments = Comment::with('user')->where('post_id', $post_id)->get();

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
