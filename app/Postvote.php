<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postvote extends Model
{
	protected $fillable = [
    	'user_id',
    	'post_id'
    ];

    //protected $primaryKey = [ ];

}
