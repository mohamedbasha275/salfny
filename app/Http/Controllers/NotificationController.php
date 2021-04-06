<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // notifications
    public function index()
    {
        $notifications=Auth::user()->notifications()->where('type','!=',3)->latest('created_at')->get();
        return view('salfny.notifications.index',compact('notifications'));
    }
    // as read notification
    public function asread(Notification $notf)
    {
        $notf->seen=0;
        $notf->save();
    }
    // as read all notification
    public function readallnotfs()
    {
        $notifications=Auth::user()->notifications()->where([['type','!=',3],['seen',0]])->get();
        foreach ($notifications as $notf)
        {
            $notf->seen=1;
            $notf->save();
        }
    }
    // delete notification
    public function deletenotf(Notification $notf)
    {
        $notf->delete();
    }
    // delete all notification
    public function deleteallnotfs()
    {
        $notifications=Auth::user()->notifications()->where('type','!=',5)->delete();
        return redirect(route('notifications'))->withFlashMessage('All notifications deleted successfully');
    }
}
