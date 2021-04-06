<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    // type
    static function type()
    {
        $array=
            [
                1 =>'شخص',
                2 =>'عرض',
                3 =>'بوست',
                4 =>'تعليق',
            ];
        return $array;
    }
    // reason
    static function reason()
    {
        $array=
            [
                '1'=>'جنسي',
                '2'=>'عنف',
                '3'=>'كراهية',
                '4'=>'مبيعات',
                '5'=>'إرهاب',
                '6'=>'احتيالى',
                '7'=>'أخري',
            ];
        return $array;
    }
    /***************************/
    // reporter user
    public function reporter()
    {
        return $this->belongsTo('App\User','reporter_id','id');
    }
    // against user
    public function against()
    {
        return $this->belongsTo('App\User','person_id','id');
    }
}
