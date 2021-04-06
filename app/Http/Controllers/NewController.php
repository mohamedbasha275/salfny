<?php

namespace App\Http\Controllers;

use App\news;
use Illuminate\Http\Request;

class NewController extends Controller
{
    //
    //************** AJAX **************//
    public $num=1;
    public function ajax()
    {
        $lim=$this->num;
        return view('ajax',compact('lim'));
    }
    public function readMore(Request $request)
    {
        $bb=$request->limit;
        $this->num=$bb+1;
        $news=news::orderBy('created_at', 'desc')->limit($bb)->get();
        return view('ajax2',compact('news'));
    }
    public function storejax(Request $request)
    {
        if($request->ajax())
        {
            $news = new news();
            $news->id = $request->id;
            $news->content = $request->content2;
            $news->owner = $request->owner;
            $news->date = date("Y-m-d");
            $h=(date("H"));
            $m=date("i");
            $y=(date("Y"));
            $mo=date("M");
            $d=date("d");
            $news->shift="AM";
            if($h>12)
            {
                $h=$h-12;
                if($h < 10)
                {
                    $h="0".$h;
                }
                $news->shift="PM";
            }
            $news->date=($d." ".$mo);
            $news->time=($h.":".$m);
            $news->save();
            /*$html = view('ajax2',compact('news'))->render();
            return response(['staus'=>true,'result'=>$html]);*/
            return response($news);
        }
    }
    public function deleteajax(Request $request)
    {
        if ($request->ajax())
        {
            news::destroy($request->id);
            return response(['message'=>'News deleted successfully']);
        }

    }
    public function editeajax(Request $request)
    {
        if ($request->ajax())
        {
            $new=news::find($request->id);
            return response($new);
        }
    }
    public function updateajax(Request $request)
    {
        if ($request->ajax())
        {
            $new=news::find($request->id);
            $new->id = $request->id;
            $new->content = $request->content2;
            $new->owner = $request->owner;
            $new->save();

            //return response($this->find($request->id));
            return response($request->all());
        }

    }
    public function findPage()
    {
        return news::paginate(3);
    }
    public function pagination()
    {
        $news=$this->findPage();
        return view('ajax3',compact('news'));
    }
    public function pageajax()
    {
        $news=$this->findPage();
        return view('ajax4',compact('news'))->render();
    }
}
