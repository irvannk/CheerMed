<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function posting()
    {
    	return $this->belongsTo('App\Posting');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
