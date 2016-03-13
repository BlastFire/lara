<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Post;
use App\User;
use App\Comment;
use HelperEnums\PostLiked;
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
    	$posts = Post::with('user')->get(); //->paginate(20)

        //not auth user in the page
        if(!Auth::user()) {
            return view('wadapp.index', compact('posts'));
        }

        //for the auth users, return vote likes in posts
        $posts = $this->appendUserLikesPerPost($posts);

        //return $posts;
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

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    private function changeAndSavePageRank($pageRankValue)
    {
       if(empty($pageRankValue)) {
            //decrease page rank
            $pagerank = $post->page_rank;
            $pagerank++;
        }
        else {
            //$post->page_rank;
            //increase page rank
            $post->page_rank;
        }
    }

    private function appendUserLikesPerPost($posts)
    {
        $filteredVotedPostsId = array();
        $postVotesForLoggedUser = DB::table('postvotes')->where('user_id', Auth::user()->getId())->get();

        foreach ($postVotesForLoggedUser as $k => $v) {
            $filteredVotedPostsId[$v->post_id] = $v;
        }

        foreach ($posts as $post) {
            if(array_key_exists($post->id, $filteredVotedPostsId)) {
                $postLike = $filteredVotedPostsId[$post->id]->liked;
                $post->liked = $postLike;

                //set the vote image class
                if($postLike > 0 ) {
                    $post->likeUpClass = "vote_up_special";
                    $post->likeDownClass = "vote_down_normal";
                } else {
                    $post->likeUpClass = "vote_up_normal";
                    $post->likeDownClass = "vote_down_special";
                }
            }
            else {
                $post->liked = PostLiked::notvoted;
                $post->likeUpClass = "vote_up_normal";
                $post->likeDownClass = "vote_down_normal";
            }
        }

        return $posts;
    }

         
}
