<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notification;
use App\Offer;
use App\Post;
use App\review;
use App\User;
use App\ChatNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AfterloginController extends Controller
{
    // Index
    public function index()
    {
        $users=User::withCount('posts')            // Count the posts
        ->orderBy('posts_count', 'desc')          // Order by the posts count
        ->take(5)                                // Take the first 5
        ->get();
        $posts = Post::latest('created_at')->get();
            return view('salfny.afterlogin', compact('users','posts'));
    }
    // My profile
    public function myprofile()
    {
        $posts = Post::where('user_id',Auth::user()->id)->latest('created_at')->get();
        $offers = Auth::user()->offers()->paginate(15);
        $needs = Auth::user()->needs()->latest('created_at')->paginate(15);
        return view('salfny.myprofile', compact('posts','offers','needs'));
    }
    public function userprofile(User $user)
    {
        if($user==Auth::user())
        {
            return redirect(route('profile'));
        }
        else
        {
            $posts = Post::where('user_id',$user->id)->latest('created_at')->get();
            $offers = $user->offers()->paginate(15);
            return view('salfny.userprofile', compact('user','offers','posts'));
        }
    }
    // updateprofile
    public function updateprofile(Request $request)
    {
        //Validate
        $request->validate([
            'image' => 'image',
            'name'=>'required|min:2',
            'phone'=>'required|numeric',
            'email'=>'required|email',
            'address'=>'required',
        ]);
        $user=Auth::user();
        if($request->file('image') != null)
        {
            $file = $request->file('image');
            $destinationPath = 'images';
            $file->move($destinationPath,$file->getClientOriginalName());
            $user->image=$file->getClientOriginalName();
        }
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->address=$request->address;
        $user->save();
        return back()->withFlashMessage('تم تحديث بياناتك بنجاح');
    }
    // Needs
    public function need()
    {
        $categories=Category::all();
        $offers=Offer::where('user_id','!=',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('salfny.user.needs', compact('categories','offers'));
    }
    // Offer search
    public function offersearch(Request $request,Offer $offer)
    {
        // all values null
        if($request->sername == null && $request->serplace == null && $request->sercategory == 0)
        {
            return back();
        }
        // not null
        else
        {
            if($request->sername == null)
            {
                if($request->sercategory == 0)
                {
                    if($request->serplace == null)
                    {
                        return back();
                    }
                    else
                    {
                        $offers=$offer::where([['user_id','!=',Auth::user()->id],
                            ['place','like','%'.$request->serplace.'%']])->paginate(6);
                    }
                }
                else
                {
                    if($request->serplace == null)
                    {
                        $offers=$offer::where([['user_id','!=',Auth::user()->id],
                            ['category_id',$request->sercategory]])->paginate(6);
                    }
                    else
                    {
                        $offers=$offer::where([['user_id','!=',Auth::user()->id],['category_id',$request->sercategory],
                            ['place','like','%'.$request->serplace.'%']])->paginate(6);
                    }
                }
            }
            else
            {
                if ($request->sercategory == 0)
                {
                    if ($request->serplace == null)
                    {
                        $offers = $offer::where([['user_id', '!=', Auth::user()->id],
                            ['name', 'like', '%' . $request->sername . '%']])->paginate(6);
                    }
                    else
                     {
                         $offers = $offer::where([['user_id', '!=', Auth::user()->id],
                             ['name', 'like', '%' . $request->sername . '%'],
                             ['place', 'like', '%' . $request->serplace . '%']])->paginate(6);
                      }
                }
                else
                 {
                     if ($request->serplace == null)
                     {
                         $offers = $offer::where([['user_id', '!=', Auth::user()->id],
                             ['name', 'like', '%' . $request->sername . '%'],
                                ['category_id', $request->sercategory]])->paginate(6);
                     }
                     else
                     {
                         $offers = $offer::where([['user_id', '!=', Auth::user()->id],
                             ['category_id', $request->sercategory],['name', 'like', '%' . $request->sername . '%'],
                                ['place', 'like', '%' . $request->serplace . '%']])->paginate(6);
                     }
                 }
            }
            $categories=Category::all();
            return view('salfny.user.needs', compact('categories','offers'));
        }
    }
    // Profile
    public function profile(User $user)
    {
        $userposts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $useroffers= Offer::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('salfny.user.profile', compact('user','userposts','useroffers'));
    }
    // Store review
    public function storereview(Request $request)
    {
        $usrev=Review::where('user_id',Auth::user()->id)->count();
        if($usrev == 1)
        {
            $review=Review::where('user_id',Auth::user()->id)->first();
            $review->content = $request->review;
            $review->save();
        }
        else
        {
            $review =new Review();
            $review->user_id=Auth::user()->id;
            $review->content = $request->review;
            $review->save();
        }
        return back()->withFlashMessage('تم إرسال رأيك بنجاح');
    }
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
}
