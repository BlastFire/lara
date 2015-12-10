<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'title',
    	'body',
    	'user_id'
    ];

    protected $dates = ['published_at'];

	/**
	 * Post is owned by a user.
	 */
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
