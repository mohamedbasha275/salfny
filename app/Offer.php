<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    // Fill
    protected $fillable =
        ['name','description','image','place'];
    // user
    public function owner()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    // category
    public function category()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
    // needs
    public function needs()
    {
        return $this->hasMany('App\Need','offer_id','id');
    }
}
