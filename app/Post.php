<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // like & dislike
    static function checkLikee(Post $post)
    {
        $count=Like::where([['post_id',$post->id],['user_id',Auth::user()->id]])->count();
        if($count==0)
        {
            return 'postlike';
        }
        else
        {
            return 'postdislike';
        }
    }
    // check like
    public function checkLike()
    {
        $count=Like::where([['post_id',$this->id],['user_id',Auth::user()->id]])->count();
        if($count==0)
        {
            return 'postlike';
        }
        else
        {
            return 'postdislike';
        }
    }
    // user
    public function owner()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    // comments
    public function comments()
    {
        return $this->hasMany('App\Comment','post_id','id');
    }
    // likes
    public function likes()
    {
        return $this->hasMany('App\Like','post_id','id');
    }
}
