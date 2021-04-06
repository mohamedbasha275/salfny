<?php

namespace App\Http\Controllers;

use App\category;
use App\ChatNotification;
use App\Http\Requests\OfferRequest;
use App\Offer;
use App\notification;
use App\Review;
use App\slug;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class offerController extends Controller
{
    // offers
    public function index()
    {
        $offers=Offer::latest('created_at')->paginate(15);
        return view('salfny.offers.index', compact('offers'));
    }
    // show
    public function show($slug)
    {
        $offer=Offer::where('slug', $slug)->firstOrFail();
        return view('salfny.offers.show', compact('offer'));
    }
    // new
    public function new()
    {
        $categories=Category::all();
        return view('salfny.offers.new', compact('categories'));
    }
    // store
    public function store(OfferRequest $request)
    {
        $offer=new Offer();
        $offer->user_id=auth::user()->id;
        $offer->category_id=$request->category_id;
        $offer->name=$request->name;
        // img
        $file = $request->file('image');
        $destinationPath = 'images';
        $file->move($destinationPath,$file->getClientOriginalName());
        $offer->image=$file->getClientOriginalName();
        // slug
        $offer_id=1;
        if(Offer::all()->last())
        {
            $offer_id=Offer::all()->last()->id +1;
        }
        $offer->slug= Slug::make_slug($offer->name.'&'.$offer_id, '-');
        //
        $offer->description=$request->description;
        $offer->place=$request->place;
        $offer->lng=$request->lng;
        $offer->lat=$request->lat;
        $offer->save();
        $usrev=Review::where('user_id',Auth::user()->id)->count();
        if($usrev == 1)
        {
            return back()->withFlashMessage('تم إضافة عرضك بنجاح');
        }
        else
        {
            return back()->withFlashReview('تم إضافة عرضك بنجاح, هل يمكنك ترك رأيك ف الموقع الآن ؟!');
        }

    }
    // edit
    public function edit(Offer $offer)
    {
        if ($offer->user_id == Auth::user()->id)
        {
            $categories=Category::all();
            return view('salfny.offers.edit', compact('offer','categories'));
        }
        else
            return back();
    }
    // update
    public function update(OfferRequest $request,Offer $offer)
    {
        $offer->category_id=$request->category_id;
        $offer->name=$request->name;
        // img
        if ($request->file('image') != \null)
        {
            $file = $request->file('image');
            $destinationPath = 'images';
            $file->move($destinationPath,$file->getClientOriginalName());
            $offer->image=$file->getClientOriginalName();
        }
        // slug
        $offer->slug= Slug::make_slug($offer->name.'&'.$offer->id, '-');
        //
        $offer->description=$request->description;
        $offer->place=$request->place;
        $offer->lng=$request->lng;
        $offer->lat=$request->lat;
        $offer->save();
        return back()->withFlashMessage('تم تعديل عرضك بنجاح');
    }
    // Delete offer
    public function delete(Offer $offer)
    {
        $offer->delete();
        return back()->withFlashMessage('تم حذف العرض بنجاح.');
    }
    //serarch
    public function offerssearch(Request $request)
    {
        $offers=Offer::select('*');
        if(!empty($request['name']))
        {
            $offers->where('name','like','%'.$request->name.'%');
        }
        if(!empty($request['place']))
        {
            $offers->where('place','like','%'.$request->place.'%');
        }
        if(!empty($request['category']))
        {
            $offers->where('category_id',$request->category);
        }
        $offers=$offers->paginate(24);
        if(Auth::check())
        {
            return view('salfny.offers.index', compact('offers'));
        }
        else
        {
            return view('salfny.welcome',compact('offers'));
        }
    }
}
