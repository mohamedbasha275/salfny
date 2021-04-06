<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Fill
    protected $fillable =
        ['content'];
    // user
    public function owner()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    // post
    public function post()
    {
        return $this->belongsTo('App\Post','post_id','id');
    }
}
