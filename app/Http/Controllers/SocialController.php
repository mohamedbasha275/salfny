<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response,File;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    /**************************************************/
    // facebook
    public function facebookredirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookcallback()
    {
        try
        {
            $facebookUser = Socialite::driver('facebook')->user();
            $existUser = User::where([['provider','facebook'],['provider_id',$facebookUser->id]])->first();
            if($existUser)
            {
                Auth::loginUsingId($existUser->id);
            }
            else
            {
                $user = new User;
                $user->name = $facebookUser->name ? $facebookUser->name : ( $facebookUser->nickname ? $facebookUser->nickname  : $facebookUser->email);
                /*$user->email = $facebookUser->email;*/
                $user->password  = bcrypt(md5(rand(1,10000)));
                $user->provider='facebook';
                $user->provider_id= $facebookUser->id;
                 /****/
                 $id=1;
                 if(User::all()->last())
                 {
                     $i=User::all()->last()->id;
                     $id=$i+1;
                 }
                 $user->slug= Str::slug($user->name.' '.$id,'.');
                 /*****/
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/profile/completeprofile');
        }
        catch (Exception $e)
        {
        }
        return redirect('login');
    }
    /**************************************************/
    // google
    public function googleredirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googlecallback()
    {
        try
        {
            $googleUser = Socialite::driver('google')->user();
            $existUser = User::where([['provider','google'],['provider_id',$googleUser->id]])->first();
            if($existUser)
            {
                Auth::loginUsingId($existUser->id);
            }
            else
            {
                //dd($googleUser);
                $user = new User;
                $user->name = $googleUser->name ? $googleUser->name : ( $googleUser->nickname ? $googleUser->nickname  : $googleUser->email);
                $user->email = $googleUser->email;
                $user->password  = bcrypt(md5(rand(1,10000)));
                $user->provider='google';
                $user->provider_id= $googleUser->id;
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->to(route('me'));
        }
        catch (Exception $e)
        {
        }
        return redirect('login');
    }
    /**************************************************/
    // twitter
    public function twitterredirect()
    {
        return Socialite::driver('twitter')->redirect();
    }
    public function twittercallback()
    {
        try
        {
            $twitterUser = Socialite::driver('twitter')->user();
            $existUser = User::where([['provider','twitter'],['provider_id',$twitterUser->getId()]])->first();
            if($existUser)
            {
                Auth::loginUsingId($existUser->id);
            }
            else
            {
                $user = new User;
                $user->name = $twitterUser->name ? $twitterUser->name : ( $twitterUser->nickname ? $twitterUser->nickname  : $twitterUser->email);
                $user->email = $twitterUser->email;
                $user->password  = bcrypt(md5(rand(1,10000)));
                $user->provider='twitter';
                $user->provider_id= $twitterUser->id;
                 /****/
                 $id=1;
                 if(User::all()->last())
                 {
                     $i=User::all()->last()->id;
                     $id=$i+1;
                 }
                 $user->slug= Str::slug($user->name.' '.$id,'.');
                 /*****/
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/profile/completeprofile');
        }
        catch (Exception $e)
        {
        }
        return redirect('login');
    }
}
