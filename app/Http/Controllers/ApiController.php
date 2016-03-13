<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Request;
use App\Post;
use HelperEnums\PostLiked;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Increase or Decrease page rank field in a post by user
     *
     * @return void
     **/
    public function manageVote($postId, $postVoteType)
    {
        //TODO add aborts in the json resposne
    	if(!Request::ajax()) {
            abort(422, "this is an api");
        }

        //TODO add check for user loggedUserIdd
        //if user is not logged, show him the login form with js popup

        $loggedUserId = Auth::user()->getId();
        $response = array();
        $response['success'] = '';
        $response['message'] = '';

		$post = Post::with('user')->find($postId);

		if(!$post)
			abort(422, "Not valid post id");

		if ($loggedUserId == $post->user_id) {
			abort(422, "You cant vote for your own post");
		}

        //check if this user is voted
        $voteResult = DB::select('select * from postvotes where user_id = ? and post_id = ?', [$loggedUserId, $postId]);

        // not voted user, insert the vote and correct vote counter
        if(empty($voteResult)) {
            //TODO validate the insert
            $insertedWasOK = DB::insert('insert into postvotes (user_id, post_id, liked) values (?, ?, ?)',
                [$loggedUserId, $postId, $postVoteType]);

            $this->manipulatePostCounter($post, $postVoteType);

            /** Saving first or otherwhise query error because of the "liked" property **/
            //@o.POST SAVE
            $post->save();

            $response['success'] = true;
            $response['message'] = 'vote inserted';

            //adding liked property
            if($postVoteType < 0) {
                $liked = PostLiked::disliked;
                $likeUpClass = "vote_up_normal";
                $likeDownClass = "vote_down_special";
            } else {
                $liked = PostLiked::liked; 
                $likeUpClass = "vote_up_special";
                $likeDownClass = "vote_down_normal";
            }

            $this->updateVoteProperties($response, $post->page_rank, $liked, $likeUpClass, $likeDownClass);

            //returning here because we dont need to check the code below just to get to the return statement (errors. the array with the select is empty)
            return response($response, 200);
        }

        //Update the vote and correct vote counter
        $postVote = $voteResult[0];

        //already voted with the same option, delete the vote (reddit)
        if($postVote->liked == $postVoteType) {
            DB::delete('delete from postvotes where user_id = ? and post_id = ?', [$loggedUserId, $postId]);

            $this->manipulatePostCounter($post, $postVoteType, true);

            /** Saving first or otherwhise query error, because the "liked" property is not a table column **/

            //@o.POST SAVE
            $post->save();

            $response['success'] = true;
            $response['message'] = 'vote toggled (removed)';

            $liked = 0;
            $likeUpClass = "vote_up_normal";
            $likeDownClass = 'vote_down_normal';

            $this->updateVoteProperties($response, $post->page_rank, $liked, $likeUpClass, $likeDownClass);

        } else {

            //@t.POSTVOTE UPDATE
            $affected = DB::update('update postvotes set user_id = ?, liked = ? where post_id = ?',
                [$loggedUserId, $postVoteType, $postId]);

            $this->manipulatePostCounter($post, $postVoteType, false);     

            /** Saving first or otherwhise query error, because the "liked" property is not a table column **/ 

            //@o.POST SAVE
            $post->save();

            if($postVoteType < 0) {
                $liked = PostLiked::disliked;
                $likeUpClass = "vote_up_normal";
                $likeDownClass = "vote_down_special";
            } else {
                $liked = PostLiked::liked; 
                $likeUpClass = "vote_up_special";
                $likeDownClass = "vote_down_normal";
            }  

            $response['success'] = true;
            $response['message'] = 'vote toggled (updated)';
            $this->updateVoteProperties($response, $post->page_rank, $liked, $likeUpClass, $likeDownClass);

        }
       
		return response($response, 200);
    }

    private function manipulatePostCounter($post, $liked, $modeEqual = '') {
        //normal
        if($modeEqual === '') {
            if($liked > 0) {
                $post->page_rank++;
            } else {
                $post->page_rank--;
            }
            return;
        }
        
        //the toggle vote
        if($modeEqual) {

            if($liked > 0) {
                $post->page_rank--;
            } else {
                $post->page_rank++;
            }
        } else {

            if($liked > 0) {
                $post->page_rank+=2;
            } else {
                $post->page_rank-=2;
            }
        }
    }

    private function updateVoteProperties(&$response, $page_rank, $liked, $likeUpClass, $likeDownClass) {
        $response['postUpdate']['liked'] = $liked;
        $response['postUpdate']['likeUpClass'] = $likeUpClass;
        $response['postUpdate']['likeDownClass'] = $likeDownClass;
        $response['postUpdate']['page_rank'] = $page_rank;
    }
}
