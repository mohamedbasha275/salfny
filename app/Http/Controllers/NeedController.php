<?php

namespace App\Http\Controllers;

use App\Need;
use App\Offer;
use App\Notification;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use Illuminate\Support\Facades\Auth;

class NeedController extends Controller
{
    // take offer
    public function takeoffer(Offer $offer)
    {
        $count = Need::where([['user_id', Auth::user()->id], ['offer_id', $offer->id]])->count();
        if ($count == 0)
        {

            $need=new Need();
            $need->user_id=Auth::user()->id;
            $need->offer_id=$offer->id;
            $need->save();
            // notification
            if (Auth::user()->id != $offer->user_id)
            {
                $content='قام بطلب عرض لك';
                Notification::storenotification($offer->user_id,Auth::user()->id,$content,4,$offer->id);
                /***********************************/
                // add event
                $data=[
                    'sender_id'=>Auth::user()->id,
                    'receiver_id'=>$offer->user_id,
                    'content'=>$content,
                    'sender_img'=>asset('images/'.Auth::user()->image),
                    'sender_name'=>Auth::user()->name,
                    'notf_id'=>Notification::all()->last()->id,
                    'notf_url'=>route('showoffer',$offer->id),
                    'time'=>Notification::all()->last()->created_at->diffForHumans()
                ];
                event(new NewNotification($data));
                /***********************************/
            }
            return [
                'status' =>'done',
            ];
        }
        else
        {
            return [
                'status' =>'undone',
            ];
        }
    }
    // remove need
    public function removeneed(Need $need)
    {
        $need->delete();
        // notification
        if (Auth::user()->id != $need->offer->user_id)
        {
            $content='قام بالتراجع عن طلب عرض لك';
            Notification::storenotification($need->offer->user_id,Auth::user()->id,$content,5,$need->offer->id);
            /***********************************/
            // add event
            $data=[
                'sender_id'=>Auth::user()->id,
                'receiver_id'=>$need->offer->user_id,
                'content'=>$content,
                'sender_img'=>asset('images/'.Auth::user()->image),
                'sender_name'=>Auth::user()->name,
                'notf_id'=>Notification::all()->last()->id,
                'notf_url'=>route('showoffer',$need->offer->id),
                'time'=>Notification::all()->last()->created_at->diffForHumans()
            ];
            event(new NewNotification($data));
            /***********************************/
        }
        return [
            'status' =>'done',
        ];
    }
}
