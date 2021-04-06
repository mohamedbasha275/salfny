<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // offers
    public function offers()
    {
        return $this->hasMany('App\Offer','category_id','id');
    }
}
