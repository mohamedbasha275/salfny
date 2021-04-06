<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // user
    public function owner()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
