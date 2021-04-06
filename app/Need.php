<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    // user
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    // offer
    public function offer()
    {
        return $this->belongsTo('App\Offer','offer_id','id');
    }
}
