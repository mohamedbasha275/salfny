<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // posts
    public function posts()
    {
        return $this->hasMany('App\Post','user_id','id');
    }
    // comments
    public function comments()
    {
        return $this->hasMany('App\Comment','user_id','id');
    }
    // likes
    public function likes()
    {
        return $this->hasMany('App\Like','user_id','id');
    }
    // offers
    public function offers()
    {
        return $this->hasMany('App\Offer','user_id','id');
    }
    // needs
    public function needs()
    {
        return $this->hasMany('App\Need','user_id','id');
    }
    // reviews
    public function reviews()
    {
        return $this->hasMany('App\Review','user_id','id');
    }
    // notifications
    public function notifications()
    {
        return $this->hasMany('App\Notification','user_id','id');
    }
    // empty img
    public function image()
    {
        if($this->image != null)
        {
            return $this->image;
        }
        else
            return 'avatar.png';
    }
    // last seen
    public function getSeeningAttribute()
    {
        if($this->last_seen != null)
        {
            return \Carbon\Carbon::parse($this->last_seen)->diffForHumans();
        }
        else
            return 'un known';
    }
     // conversations by sender id
     public function chats()
     {
         return $this->hasMany('App\Chat','sender_id','id');
     }
    // un read messages
    public function allUnreadMessages()
    {
        $senderIds = Chat::where('receiver_id' ,Auth::user()->id)->where('seen',1)
                    ->distinct()->get(['sender_id']);
        $users = User::whereIn('id',$senderIds)->with('chats');
        return $users;
    }
    /*******************/
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
