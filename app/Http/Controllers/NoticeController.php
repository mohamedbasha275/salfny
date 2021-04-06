<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notice;
use App\Offer;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    // post
    public function postnotice(Request $request,Post $post)
    {
        //Validate
        $request->validate([
            'reason' => 'required',
        ]);
        $notice=new Notice();
        $notice->reporter_id=Auth::user()->id;
        $notice->person_id=$post->user_id;
        $notice->type=3;
        $notice->relation_id=$post->id;
        $notice->reason=$request->reason;
        $notice->save();
        return back()->withFlashMessage('تم إرسال بلاغك بنجاح');
    }
    // comment
    public function commentnotice(Request $request,Comment $comment)
    {
        //Validate
        $request->validate([
            'reason' => 'required',
        ]);
        $notice=new Notice();
        $notice->reporter_id=Auth::user()->id;
        $notice->person_id=$comment->user_id;
        $notice->type=4;
        $notice->relation_id=$comment->id;
        $notice->reason=$request->reason;
        $notice->save();
        return back()->withFlashMessage('تم إرسال بلاغك بنجاح');
    }
    // user
    public function usernotice(Request $request,User $user)
    {
        //Validate
        $request->validate([
            'reason' => 'required',
        ]);
        $notice=new Notice();
        $notice->reporter_id=Auth::user()->id;
        $notice->person_id=$user->id;
        $notice->type=1;
        $notice->relation_id=$user->id;
        $notice->reason=$request->reason;
        $notice->save();
        return back()->withFlashMessage('تم إرسال بلاغك بنجاح');
    }
    // offer
    public function offernotice(Request $request,Offer $offer)
    {
        //Validate
        $request->validate([
            'reason' => 'required',
        ]);
        $notice=new Notice();
        $notice->reporter_id=Auth::user()->id;
        $notice->person_id=$offer->user_id;
        $notice->type=2;
        $notice->relation_id=$offer->id;
        $notice->reason=$request->reason;
        $notice->save();
        return back()->withFlashMessage('تم إرسال بلاغك بنجاح');
    }
}
