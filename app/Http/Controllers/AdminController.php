<?php

namespace App\Http\Controllers;
use App\adminnotif;
use App\Category;
use App\Chat;
use App\ChatNotification;
use App\Comment;
use App\Contact;
use App\Like;
use App\Notification;
use App\Offer;
use App\Post;
use App\Question;
use App\Review;
use App\SiteSetting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    // Index
    public function index()
    {
        $users=User::where('id','!=','4')->orderBy('created_at', 'desc')->limit(8)->get();
        $offers=Offer::orderBy('created_at', 'desc')->limit(8)->get();
        $contacts=Contact::orderBy('created_at', 'desc')->limit(8)->get();
        return view('salfny.admin.index',compact('users','offers','contacts'));
    }
    /******************************************//* Users *//******************************************/
    // Users
    public function users()
    {
        $users=User::where('id','!=','4')->orderBy('created_at', 'desc')->paginate(3);
        return view('salfny.admin.users',compact('users'));
    }
    // Profile
    public function profile(User $user)
    {
        $userposts = Post::where('user_id',$user->id)->orderBy('created_at', 'desc')->get();
        $useroffers= Offer::where('user_id',$user->id)->orderBy('created_at', 'desc')->paginate(3);
        $userreviews= Review::where('user_id',$user->id)->orderBy('created_at', 'desc')->get();
        return view('salfny.admin.profile',compact('user','userposts','useroffers','userreviews'));
    }
    // Delete user
    public function destroyuser(User $user)
    {
        // notification comments owner
        foreach ($user->posts as $post)
        {
            foreach ($post->comments as $comment)
            {
                $notifaction = new Notification();
                $notifaction->user_id = $comment->owner->id;
                $notifaction->content = " Your Comment : " . $comment->content . " deleted as the admin deleted the post ";
                $notifaction->asread = 1;
                $notifaction->person = "Salfny";
                $notifaction->person_img = "icon.png";
                // Time
                $h = (date("H"));
                $i = date("i");
                $m = date("M");
                $d = date("d");
                $notifaction->shift = "AM";
                if ($h > 12)
                {
                    $h = $h - 12;
                    if ($h < 10) {
                        $h = "0" . $h;
                    }
                    $notifaction->shift = "PM";
                }
                $notifaction->date = ($d . " " . $m);
                $notifaction->time = ($h . ":" . $i);
                $notifaction->save();
            }
            $post->comments()->delete();
            $post->likes()->delete();
        }
        $user->posts()->delete();
        $user->comments()->delete();
        $user->likes()->delete();
        $user->offers()->delete();
        $user->reviews()->delete();
        $user->notifications()->delete();
        $user->chatnotifications()->delete();
        $user->delete();
        return back()->withFlashMessage('The user deleted successfully');
    }
    /******************************************//* / Users *//******************************************/
    /******************************************//* Offers *//******************************************/
    // Offers
    public function offers()
    {
        $offers=Offer::orderBy('created_at', 'desc')->paginate(3);
        return view('salfny.admin.offers',compact('offers'));
    }
    // Delete offer
    public function destroyoffer(Offer $offer)
    {
        $notifaction =new Notification();
        $notifaction->user_id = $offer->owner->id;
        $notifaction->content = " Your Offer : ".$offer->name." deleted by admin";
        $notifaction->asread = 1;
        $notifaction->person = "Salfny";
        $notifaction->person_img = "icon.png";
        // Time
        $h=(date("H"));
        $i=date("i");
        $m=date("M");
        $d=date("d");
        $notifaction->shift="AM";
        if($h>12)
        {
            $h=$h-12;
            if($h < 10)
            {
                $h="0".$h;
            }
            $notifaction->shift="PM";
        }
        $notifaction->date=($d." ".$m);
        $notifaction->time=($h.":".$i);
        $notifaction->save();
        $offer->delete();
        return back()->withFlashMessage('The offer deleted successfully');
    }
    /******************************************//* /Offers *//******************************************/
    /******************************************//* Posts *//******************************************/
    // Posts
    public function posts()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('salfny.admin.posts',compact('posts'));
    }
    public function destroypost(Post $post)
    {
        // notification post owner
        $notifaction =new Notification();
        $notifaction->user_id = $post->owner->id;
        $notifaction->content = " Your Post : ".$post->content." deleted by admin";
        $notifaction->asread = 1;
        $notifaction->person = "Salfny";
        $notifaction->person_img = "icon.png";
        // Time
        $h=(date("H"));
        $i=date("i");
        $m=date("M");
        $d=date("d");
        $notifaction->shift="AM";
        if($h>12)
        {
            $h=$h-12;
            if($h < 10)
            {
                $h="0".$h;
            }
            $notifaction->shift="PM";
        }
        $notifaction->date=($d." ".$m);
        $notifaction->time=($h.":".$i);
        $notifaction->save();
        // notification to comments owner
        foreach ($post->comments as $comment)
        {
            $notifaction =new Notification();
            $notifaction->user_id = $comment->owner->id;
            $notifaction->content = " Your Comment : ".$comment->content." deleted as the admin deleted the post ";
            $notifaction->asread = 1;
            $notifaction->person = "Salfny";
            $notifaction->person_img = "icon.png";
            // Time
            $h=(date("H"));
            $i=date("i");
            $m=date("M");
            $d=date("d");
            $notifaction->shift="AM";
            if($h>12)
            {
                $h=$h-12;
                if($h < 10)
                {
                    $h="0".$h;
                }
                $notifaction->shift="PM";
            }
            $notifaction->date=($d." ".$m);
            $notifaction->time=($h.":".$i);
            $notifaction->save();
        }
        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();
        return back()->withFlashMessage('The post deleted successfully');
    }
    /* Delete comment  */
    public function destroycomment(Comment $comment)
    {
        $notifaction =new Notification();
        $notifaction->user_id = $comment->owner->id;
        $notifaction->content = " Your Comment : ".$comment->content." deleted by admin";
        $notifaction->asread = 1;
        $notifaction->person = "Salfny";
        $notifaction->person_img = "icon.png";
        // Time
        $h=(date("H"));
        $i=date("i");
        $m=date("M");
        $d=date("d");
        $notifaction->shift="AM";
        if($h>12)
        {
            $h=$h-12;
            if($h < 10)
            {
                $h="0".$h;
            }
            $notifaction->shift="PM";
        }
        $notifaction->date=($d." ".$m);
        $notifaction->time=($h.":".$i);
        $notifaction->save();
        $comment->delete();
        return back()->withFlashMessage('The comment deleted successfully');
    }
    /******************************************//* /Posts *//******************************************/
    /******************************************//* Contacts *//******************************************/
    // Contacts
    public function contacts()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(6);
        return view('salfny.admin.contacts',compact('contacts'));
    }
    // Delete contact
    public function destroycontact(Contact $contact)
    {
        $contact->delete();
        return back()->withFlashMessage('The contact deleted successfully');
    }
    /******************************************//* /Contacts *//******************************************/
    /******************************************//* Reviews *//******************************************/
    // Reviews
    public function reviews()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('salfny.admin.reviews',compact('reviews'));
    }
    // Delete review
    public function destroyreview(Review $review)
    {
        $notifaction =new Notification();
        $notifaction->user_id = $review->owner->id;
        $notifaction->content = " Your Review : ".$review->content." deleted by admin";
        $notifaction->asread = 1;
        $notifaction->person = "Salfny";
        $notifaction->person_img = "icon.png";
        // Time
        $h=(date("H"));
        $i=date("i");
        $m=date("M");
        $d=date("d");
        $notifaction->shift="AM";
        if($h>12)
        {
            $h=$h-12;
            if($h < 10)
            {
                $h="0".$h;
            }
            $notifaction->shift="PM";
        }
        $notifaction->date=($d." ".$m);
        $notifaction->time=($h.":".$i);
        $notifaction->save();
        $review->delete();
        return back()->withFlashMessage('The review deleted successfully');
    }
    /******************************************//* /Reviews *//******************************************/
    /******************************************//* Questions *//******************************************/
    // Questions
    public function questions()
    {
        $questions = Question::orderBy('created_at', 'desc')->get();
        return view('salfny.admin.questions',compact('questions'));
    }
    // Edit question
    public function editquestion(Question $question)
    {
        return view('salfny.admin.editquestion',compact('question'));
    }
    // Update question
    public function updatequestion(Request $request,Question $question)
    {

        $question->question=$request->question;
        $question->answer=$request->answer;
        $question->save();
        return redirect('salfny2020/salfnyadmin/questions')->withFlashMessage('The question edited successfully');
    }
    // Publish question
    public function publishquestion(Question $question)
    {
        $question->status=1;
        $question->save();
        return back()->withFlashMessage('The question is available now');
    }
    // Hide question
    public function hidequestion(Question $question)
    {
        $question->status=0;
        $question->save();
        return back()->withFlashMessage('The question removed now');
    }
    // Delete question
    public function destroyquestion(Question $question)
    {
        $question->delete();
        return back()->withFlashMessage('The question deleted successfully');
    }
    /******************************************//* /Reviews *//******************************************/
    /******************************************//* Categories *//******************************************/
    // Categories
    public function categories()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('salfny.admin.categories',compact('categories'));
    }
    // Store Category
    public function storecategory(Request $request)
    {
        $category=new category();
        $category->name=$request->categoryname;
        // Time
        $h=(date("H"));
        $i=date("i");
        $m=date("M");
        $d=date("d");
        $category->shift="AM";
        if($h>12)
        {
            $h=$h-12;
            if($h < 10)
            {
                $h="0".$h;
            }
            $category->shift="PM";
        }
        $category->date=($d." ".$m);
        $category->time=($h.":".$i);
        $category->save();
        return back()->withFlashMessage('The category added successfully');
    }
    // Edit Category
    public function editcategory(Category $category)
    {
        return view('salfny.admin.editcategory',compact('category'));
    }
    // Update category
    public function updatecategory(Request $request,Category $category)
    {
        $category->name = $request->categoryname;
        $category->save();
        return redirect('salfny2020/salfnyadmin/categories')->withFlashMessage('The category edited successfully');
    }
    // Delete category
    public function destroycategory(Category $category)
    {
        foreach ($category->offers as $offer)
        {
            $notifaction =new Notification();
            $notifaction->user_id = $offer->owner->id;
            $notifaction->content = " Your Offer : ".$offer->name." deleted as the admin deleted the category ";
            $notifaction->asread = 1;
            $notifaction->person = "Salfny";
            $notifaction->person_img = "icon.png";
            // Time
            $h=(date("H"));
            $i=date("i");
            $m=date("M");
            $d=date("d");
            $notifaction->shift="AM";
            if($h>12)
            {
                $h=$h-12;
                if($h < 10)
                {
                    $h="0".$h;
                }
                $notifaction->shift="PM";
            }
            $notifaction->date=($d." ".$m);
            $notifaction->time=($h.":".$i);
            $notifaction->save();
        }
        $category->offers()->delete();
        $category->delete();
        return back()->withFlashMessage('The category deleted successfully');
    }
    /******************************************//* /Categories *//******************************************/
    /******************************************//* Notification *//******************************************/
    // As read notification
    public function asread(Notification $notf)
    {
        $notf->asread = 0;
        $notf->save();
        return back();
    }
    // All as read notification
    public function allasread()
    {
        $notfs=Notification::where([['user_id', Auth::user()->id],['asread',1]])->get();
        $count = Notification::where([['user_id', Auth::user()->id],['asread',1]])->count();
        for ($i=0;$i<$count;$i++)
        {
            foreach ($notfs as $not)
            {
                $not->asread = 0;
                $not->save();
            }
        }
        return back();
    }
    /******************************************//* /Notification *//******************************************/
    /******************************************//* Chat *//******************************************/
    public function chats()
    {
        $allusers = User::where("id","!=",Auth::user()->id)->get();
        return view('salfny.admin.chats',compact('allusers'));
    }
    // Show chat
    public function showchat(User $user)
    {
        $ntfchtcount=ChatNotification::where([['persson_id', $user->id],['asread',1]])->count();
        $ntfcht=ChatNotification::where([['persson_id', $user->id],['asread',1]])->get();
        if($ntfchtcount == 1)
        {
            foreach ($ntfcht as $ntf)
            {
                $ntf->asread = 0;
                $ntf->save();
            }
        }
        $allusers = User::where("id","!=",Auth::user()->id)->get();
        $chats=Chat::where([['sender_id','=',Auth::user()->id],['receiver_id','=',$user->id],
            ['send_archv','!=',Auth::user()->id.'Archived'],['recv_archv','!=',Auth::user()->id.'Archived']])->orWhere
        ([['receiver_id','=',Auth::user()->id],['sender_id','=',$user->id],
            ['send_archv','!=',Auth::user()->id.'Archived'], ['recv_archv','!=',Auth::user()->id.'Archived']])
            ->orderBy('created_at')->get();
        return view('salfny.admin.showchat',compact('user','allusers','chats'));
    }
    // Store chat
    public function storechat(User $user,Request $request)
    {
        $chat = new Chat();
        $chat->sender_id = Auth::user()->id;
        $chat->receiver_id = $user->id;
        $chat->content = $request->message;
        $chat->send_archv = "";
        $chat->recv_archv = "";
        $chat->chatimage = "";
        // Time
        $h=(date("H"));
        $i=date("i");
        $m=date("M");
        $d=date("d");
        $chat->shift="AM";
        if($h>12)
        {
            $h=$h-12;
            if($h < 10)
            {
                $h="0".$h;
            }
            $chat->shift="PM";
        }
        $chat->date=($d." ".$m);
        $chat->time=($h.":".$i);
        $chat->save();
        // Notification
        if($chat->sender_id==Auth::user()->id and $chat->receiver_id==$user->id)
        {
            $notfchatcount=ChatNotification::where([['user_id','=',$user->id],['person','=',Auth::user()->name],
                ['asread','=','1']])->count();
            if($notfchatcount == 0)
            {
                $notifchat =new ChatNotification();
                $notifchat->user_id = $user->id;
                $notifchat->content = $request->message;
                $notifchat->asread = 1;
                $notifchat->person = Auth::user()->name;
                $notifchat->person_img = Auth::user()->image;
                $notifchat->persson_id = Auth::user()->id;
                // Time
                $h=(date("H"));
                $i=date("i");
                $m=date("M");
                $d=date("d");
                $notifchat->shift="AM";
                if($h>12)
                {
                    $h=$h-12;
                    if($h < 10)
                    {
                        $h="0".$h;
                    }
                    $notifchat->shift="PM";
                }
                $notifchat->date=($d." ".$m);
                $notifchat->time=($h.":".$i);
                $notifchat->save();
            }
            else
            {
                $ntfchat=ChatNotification::where([['user_id','=',$user->id],['person','=',Auth::user()->name],
                    ['asread','=','1']])->orderBy('created_at', 'desc')->limit(1)->get();
                foreach ($ntfchat as $ntf)
                {
                    $ntf->content = $request->message."
                        <span class='col-xs-offset-7 badge badge-pill badge-danger' style='background-color: #f84f1e;' title='more than one message'>+1</span>";
                    // Time
                    $h=(date("H"));
                    $i=date("i");
                    $m=date("M");
                    $d=date("d");
                    $ntf->shift="AM";
                    if($h>12)
                    {
                        $h=$h-12;
                        if($h < 10)
                        {
                            $h="0".$h;
                        }
                        $ntf->shift="PM";
                    }
                    $ntf->date=($d." ".$m);
                    $ntf->time=($h.":".$i);
                    $ntf->save();
                }
            }
        }
        return back();
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
        return back();
    }
    // As read notification
    public function asreadchat(ChatNotification $notfchat)
    {
        $notfchat->asread = 0;
        $notfchat->save();
        return back();
    }
    /******************************************//* /Chat *//******************************************/
    /******************************************//* Setting *//******************************************/
    // Setting
    public function setting()
    {
        $count=SiteSetting::count();
        if($count==0)
        {
            $site=new SiteSetting();
            /* images */
            $site->icon='icon.png';
            $site->slide1='slid1.jpg';
            $site->slide2='slid2.jpg';
            $site->slide3='slid3.jpg';
            $site->slide4='slid4.jpg';
            /* contacts */
            $site->facebook='salfny2020@facebook.com';
            $site->twitter='salfny2020@twitter.com';
            $site->google='salfny2020@google.com';
            $site->youtube='salfny2020@youtube.com';
            $site->instgram='salfny2020@instgram.com';
            $site->skype='salfny2020@skype.com';
            $site->whatsapp='0262895';
            $site->address='dhidwh nduhshnu';
            $site->phone='9635820';
            $site->fax='885222';
            $site->email='salfny2020@rtt.com';
            /* information */
            $site->aboutimg='aboutimg.jpg';
            $site->largedescription='largedescription';
            $site->aboutteam='aboutteam';
            $site->articletime=date('Y-m-d');
            /* team */
            $site->teammember1picture='review1.jpg';
            $site->teammember1name='Mohamed';
            $site->teammember1postion='HR';
            $site->teammember1article='good case to work here';
            $site->teammember1facebook='user1@facebook.com';
            $site->teammember1twitter='user1@twitter.com';
            $site->teammember1google='user1@google.com';
            /**/
            $site->teammember2picture='review4.jpg';
            $site->teammember2name='Ali';
            $site->teammember2postion='Support';
            $site->teammember2article='work here good case to';
            $site->teammember2facebook='user1@facebook.com';
            $site->teammember2twitter='user1@twitter.com';
            $site->teammember2google='user1@google.com';
            /**/
            $site->teammember3picture='review3.jpg';
            $site->teammember3name='Osane';
            $site->teammember3postion='Techn';
            $site->teammember3article='good case to bre refe';
            $site->teammember3facebook='user1@facebook.com';
            $site->teammember3twitter='user1@twitter.com';
            $site->teammember3google='user1@google.com';
            $site->save();
            /**/
            $sites=SiteSetting::all();
            return view('salfny.admin.setting',compact('sites'));
        }
        else
            $sites=SiteSetting::all();
            return view('salfny.admin.setting',compact('sites'));
    }
    // update Setting
    // slides
    public function updatesettingslides(Request $request,SiteSetting $site)
    {
        if($request->file('icon') !=null or $request->file('slide1') !=null
            or $request->file('slide2') !=null or $request->file('slide3') !=null or $request->file('slide4') !=null)
        {
            // icon
            if($request->file('icon') !=null)
            {
                $file = $request->file('icon');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->icon=$file->getClientOriginalName();
            }
            // slide1
            if($request->file('slide1') !=null)
            {
                $file = $request->file('slide1');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->slide1=$file->getClientOriginalName();
            }
            // slide2
            if($request->file('slide2') !=null)
            {
                $file = $request->file('slide2');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->slide2=$file->getClientOriginalName();
            }
            // slide3
            if($request->file('slide3') !=null)
            {
                $file = $request->file('slide3');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->slide3=$file->getClientOriginalName();
            }
            // slide1
            if($request->file('slide4') !=null)
            {
                $file = $request->file('slide4');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->slide4=$file->getClientOriginalName();
            }
            $site->save();
        }
        return redirect('salfny2020/salfnyadmin/setting')->withFlashMessage('The slides edited successfully');
    }
    // social
    public function updatesettingsocial(Request $request,SiteSetting $site)
    {
        $site->facebook=$request->facebook;
        $site->twitter=$request->twitter;
        $site->google=$request->google;
        $site->youtube=$request->youtube;
        $site->instgram=$request->instgram;
        $site->skype=$request->skype;
        $site->whatsapp=$request->whatsapp;
        $site->address=$request->address;
        $site->phone=$request->phone;
        $site->fax=$request->fax;
        $site->email=$request->email;
        $site->save();
        return redirect('salfny2020/salfnyadmin/setting')->withFlashMessage('The social links edited successfully');

    }
    // About us
    public function updatesettinginformation(Request $request,SiteSetting $site)
    {
        if($request->file('aboutimg') !=null or $request->file('teammember1picture') !=null
            or $request->file('teammember2picture') !=null or $request->file('teammember3picture') !=null)
        {
            // icon
            if($request->file('aboutimg') !=null)
            {
                $file = $request->file('aboutimg');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->aboutimg=$file->getClientOriginalName();
            }
            // slide1
            if($request->file('teammember1picture') !=null)
            {
                $file = $request->file('teammember1picture');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->teammember1picture=$file->getClientOriginalName();
            }
            // slide2
            if($request->file('teammember2picture') !=null)
            {
                $file = $request->file('teammember2picture');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->teammember2picture=$file->getClientOriginalName();
            }
            // slide3
            if($request->file('teammember3picture') !=null)
            {
                $file = $request->file('teammember3picture');
                echo 'File Name: '.$file->getClientOriginalName();
                $destinationPath = 'images';
                $file->move($destinationPath,$file->getClientOriginalName());
                $site->teammember3picture=$file->getClientOriginalName();
            }
        }
        $m=date('M');
        $d=date('d');
        $y=date('Y');
        $site->largedescription =$request->largedescription;
        $site->aboutteam =$request->aboutteam;
        $site->articletime =$request->$m.','.$d.' '.$y;
        $site->teammember1name =$request->teammember1name;
        $site->teammember1postion =$request->teammember1postion;
        $site->teammember1article =$request->teammember1article;
        $site->teammember1facebook =$request->teammember1facebook;
        $site->teammember1twitter =$request->teammember1twitter;
        $site->teammember1google =$request->teammember1google;
        $site->teammember2name =$request->teammember2name;
        $site->teammember2postion =$request->teammember2postion;
        $site->teammember2article =$request->teammember2article;
        $site->teammember2facebook =$request->teammember2facebook;
        $site->teammember2twitter =$request->teammember2twitter;
        $site->teammember2google =$request->teammember2google;
        $site->teammember3name =$request->teammember3name;
        $site->teammember3postion =$request->teammember3postion;
        $site->teammember3article =$request->teammember3article;
        $site->teammember3facebook =$request->teammember3facebook;
        $site->teammember3twitter =$request->teammember3twitter;
        $site->teammember3google =$request->teammember3google;
        $site->save();
        return redirect('salfny2020/salfnyadmin/setting')->withFlashMessage('The information edited successfully');
    }
    /******************************************//* /Setting *//******************************************/
}
