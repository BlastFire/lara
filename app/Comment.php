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


    // public function children()
    // {
    // 	$this->hasMany('Comment', 'parent_id', 'id');
    // }
}
