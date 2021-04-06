<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // type
    static function type()
    {
        $array=
            [
                1 => 'تعليق منشور',
                2 => 'اعجاب منشور',
                3 => 'رسالة',
                4 => 'طلب عرض',
                5 => 'التراجع عن عرض',
            ];
        return $array;
    }
    // notification icon
   /* static function notfIcon()
    {
        $array=
            [
                1 => 'fa-comment',
                2 => 'fa-heart',
                3 => 'fa-comments',
                4 => 'fa-cart-plus',
                5 => 'fa-cart-arrow-down',
            ];
        return $array;
    }*/
    public function notfIcon()
    {
        $array=[
                1 => 'fa-comment',
                2 => 'fa-heart',
                3 => 'fa-comments',
                4 => 'fa-cart-plus',
                5 => 'fa-cart-arrow-down',
            ];
        return $array[$this->type];
    }
    // notification url
    public function notfUrl()
    {
        $array=[
                1 => 'showpost',
                2 => 'showpost',
                3 => 'showchat',
                4 => 'showoffer',
                5 => 'showoffer',
            ];
        return $array[$this->type];
    }
    // store notification
    static function storenotification($user,$reactor,$content,$type,$relation_id)
    {
        $notf=new Notification();
        $notf->user_id=$user;
        $notf->reactor_id=$reactor;
        $notf->content=$content;
        $notf->type=$type;
        $notf->relation_id=$relation_id;
        $notf->save();
    }
    // user
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    // reactor
    public function reactor()
    {
        return $this->belongsTo('App\User','reactor_id','id');
    }
}
