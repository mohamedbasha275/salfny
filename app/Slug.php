<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    /*******************/
    // arabic slug
    public static function make_slug($string, $separator = "-")
     {
        if (is_null($string))
         {
            return "";
        }
        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }
}
