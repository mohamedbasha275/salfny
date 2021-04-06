<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use stdClass;
use App\Notification;
use App\Events\NewChat;
use App\ChatNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class chatController extends Controller
{
    // chat
    public function index()
    {
        $users = User::where("id","!=",Auth::user()->id)->get();
        return view('salfny.chat.index',compact('users'));
    }
    // show chat
    public function show(User $user)
    {
        $chats=Chat::where([['sender_id',Auth::user()->id],['receiver_id',$user->id]])->orWhere
            ([['receiver_id',Auth::user()->id],['sender_id',$user->id]])->get();
        $users = User::where("id","!=",Auth::user()->id)->get();
        // as read mark
        Chat::where([['receiver_id',Auth::user()->id],['sender_id',$user->id],
        ['seen',1]])->update(['seen'=>0]);
        return view('salfny.chat.show',compact('users','user','chats'));
    }
    // retrive chat
    public function chatdata(User $user)
    {
        $chats=Chat::where([['sender_id',Auth::user()->id],['receiver_id',$user->id],
            ['send_archv','!=',Auth::user()->id.'Archived'],['recv_archv','!=',Auth::user()->id.'Archived']])->orWhere
            ([['receiver_id',Auth::user()->id],['sender_id',$user->id],
            ['send_archv','!=',Auth::user()->id.'Archived'], ['recv_archv','!=',Auth::user()->id.'Archived']])
            ->latest('created_at')->get();
        return view('salfny.chat.content', compact( 'chats'));
    }
    // store chat
    public function storechat(User $user,Request $request)
    {

        $chat = new Chat();
        $chat->content = $request->message;
        $chat->sender_id = Auth::user()->id;
        $chat->receiver_id = $user->id;
        $chat->save();
        /***********************************/
        // add event
        $data=[
            'sender_id'=>Auth::user()->id,
            'receiver_id'=>$user->id,
            'message'=>$chat->content,
            'sender_img'=>asset('images/'.Auth::user()->image),
            'sender_name'=>Auth::user()->name,
            'time'=> $chat->time,
        ];
        event(new NewChat($data));
        /***********************************/
        return [
            'content'=>$chat->content,
            'time'=>$chat->time,
        ];
    }
    // searching
    public function searchingusers(Request $request)
    {
        $users=User::where([['type','default'],['name','LIKE', '%'.$request->search.'%'],
            ['id','!=',Auth::user()->id]])->get();
        $retrived=[];
        foreach($users as $user)
        {
            $active_since=$user->seening;
            if(Cache::has('is_online' . $user->id))
            {
                $active_str='online_icon';
            }
            else
            {
                $active_str='online_icon offline';
            }
            $use=new stdClass;
            $use->id=$user->id;
            $use->name=$user->name;
            $use->image=$user->image();
            $use->activenow=$active_str;
            $use->since=$active_since;
            $retrived[]=$use;
        }
        return [
            'users' => $retrived,
        ];
    }
    // Delete chat
    public function destroychat(User $user)
    {
        $allchat=Chat::where([['sender_id','=',Auth::user()->id],['receiver_id','=',$user->id]])->orWhere
        ([['receiver_id','=',Auth::user()->id],['sender_id','=',$user->id]])->get();
        $allchatcount=Chat::where([['sender_id','=',Auth::user()->id],['receiver_id','=',$user->id]])->orWhere
        ([['receiver_id','=',Auth::user()->id],['sender_id','=',$user->id]])->count();
        for ($i=0;$i<=$allchatcount;$i++)
        {
            foreach ($allchat as $chat)
            {
                if($chat->send_archv !=  Auth::user()->id."Archived" and $chat->send_archv != "")
                {
                    $chat->recv_archv = Auth::user()->id."Archived";
                }
                else
                    $chat->send_archv = Auth::user()->id."Archived";
                $chat->save();
            }
        }
        return back()->withFlashMessage('The chat deleted successfully');
    }
    // As read notification
    public function asreadchat(ChatNotification $notfchat)
    {
        $notfchat->asread = 0;
        $notfchat->save();
        return back();
    }
}
