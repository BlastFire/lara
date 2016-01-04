<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Comment extends Model
{
    protected $fillable = [
    	'body',
    	'user_id',
    	'post_id',
    	'parent_id'
    ];

    protected $dates = ['published_at'];

    protected $casts = [
    'post_id' => 'integer',
    ];


    /**
     * Comment is owned by a user
     *
     **/
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
