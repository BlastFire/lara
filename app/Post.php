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

	/**
	 * Post is owned by a user.
	 */
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
