<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    // time of message
    public function getTimeAttribute()
    {
        return str_replace( ['AM','PM'],['ص','م'],date('h:i A', strtotime($this->created_at)));
    }
}
