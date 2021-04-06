<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Review;
use App\Contact;
use App\Question;
use App\Notification;
use App\Mail\ContactForm;
use mysql_xdevapi\Session;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SalfnyController extends Controller
{
    // Index
    public function index()
    {
        if(Auth::check())
        {
            return redirect(route('me'));
        }
        $offers=Offer::latest('created_at')->paginate(6);
        return view('salfny.welcome',compact('offers'));
    }
    // Contact
    public function contactus()
    {
        return view('salfny.contactus');
    }
    // Contact =>send message
    public function sendmessage(ContactRequest $request)
    {
        $cont = new contact();
        $cont->name = $request->contactuser;
        $cont->email = $request->contactmail;
        $cont->phone = $request->contactphone;
        $cont->message = $request->contactmessage;
        $cont->save();
        return back()->withFlashMessage('تم إرسال رسالتك بنجاح');
    }
    // Question
    public function questions()
    {
        $questions=Question::where('status',1)->get();
        return view('salfny.questions',compact('questions'));
    }
    // Question =>send question
    public function sendquestion(Request $request)
    {
        $quest = new Question();
        $quest->question = $request->question;
        $quest->save();
        return back()->withFlashMessage('تم إرسال سؤالك بنجاح');
    }
    // Review
    public function review()
    {
        $reviews=Review::where('publish',1)->latest('created_at')->get();
        return view('salfny.reviews',compact('reviews'));
    }
    // About us
    public function aboutus()
    {
        return view('salfny.aboutus');
    }
}
