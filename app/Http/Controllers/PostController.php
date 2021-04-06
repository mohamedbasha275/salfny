<?php

namespace App\Http\Controllers;

use App\Like;
use App\news;
use App\Post;
use App\User;
use App\Comment;
use App\Notification;
use App\ChatNotification;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class postController extends Controller
{
    /************** POST **************/
     // sow post
     public function show(Post $post)
     {
        return view('salfny.posts.show', compact('post'));
     }
    // Store post
    public function store(Request $request)
    {
        //Validate
        $request->validate([
            'image' => 'image',
        ]);
        $post=new Post();
        $post->user_id=Auth::user()->id;
        $post->content = $request->content2;
        if($request->file('image') != null)
        {
            // img
            $file = $request->file('image');
            $destinationPath = 'images';
            $file->move($destinationPath,$file->getClientOriginalName());
            $post->image=$file->getClientOriginalName();
        }
        $post->save();
        return back();
    }
    // Edit post
    public function edit(Post $post)
    {
        if ($post->user_id == Auth::user()->id)
        {
            return view('salfny.posts.edit', compact('post'));
        }
        else
            return back();
    }
    // Update post
    public function update(Request $request, Post $post)
    {
        //Validate
        $request->validate([
            'image' => 'image',
        ]);
        $post->user_id=Auth::user()->id;
        $post->content = $request->content2;
        if($request->file('image') != null)
        {
            // img
            $file = $request->file('image');
            $destinationPath = 'images';
            $file->move($destinationPath,$file->getClientOriginalName());
            $post->image=$file->getClientOriginalName();
        }
        $post->save();
        return redirect(route('profile'))->withFlashMessage('تم تعديل المنشور بنجاح.');
    }
    // Delete post
    public function delete(Post $post)
    {
        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();
        return back();
    }
    //************** COMMENT **************//
    // Store comment
    public function storecomment(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->content = $request->comcontent;
        $comment->post_id=$post->id;
        $comment->user_id=Auth::user()->id;
        $comment->save();
        // notification
        if (Auth::user()->id != $post->user_id)
        {
            $content='قام بالتعليق علي منشورك';
            Notification::storenotification($post->user_id,Auth::user()->id,$content,1,$post->id);
            /***********************************/
                // add event
                $data=[
                    'sender_id'=>Auth::user()->id,
                    'receiver_id'=>$post->user_id,
                    'content'=>$content,
                    'sender_img'=>asset('images/'.Auth::user()->image),
                    'sender_name'=>Auth::user()->name,
                    'notf_id'=>Notification::all()->last()->id,
                    'notf_url'=>route('showpost',$post->id),
                    'time'=>Notification::all()->last()->created_at->diffForHumans()
                ];
                event(new NewNotification($data));
                /***********************************/
        }
        return [
            'content' => $comment->content,
            'created_at' => $comment->created_at->diffForHumans(),
            'name'=>Auth::user()->name,
            'img'=>asset('images/'.Auth()->user()->image()),
        ];
    }
    // Edit comment
    public function editcomment(Comment $comment)
    {
        if ($comment->user_id == Auth::user()->id)
        {
            return view('salfny.user.editcomment', compact('comment'));
        }
        else
            return back()->withFlashMessage('You cannot edit comments of others');;
    }
    // Delete comment
    public function destroycomment(Comment $comment)
    {
        $comment->delete();
        // notification
        return back()->withFlashMessage('The comment deleted successfully');
    }
    //************** LIKE **************//
    // like
    public function storelike(Post $post)
    {
        $count=Like::where([['user_id',Auth::user()->id],['post_id',$post->id]])->count();
        if($count==0)
        {
            $like=new Like();
            $like->user_id=Auth::user()->id;
            $like->post_id=$post->id;
            $like->save();
            // notification
            if (Auth::user()->id != $post->user_id)
            {
                $content='قام بالإعجاب بمنشورك';
                Notification::storenotification($post->user_id,Auth::user()->id,$content,2,$post->id);
                /***********************************/
                // add event
                $data=[
                    'sender_id'=>Auth::user()->id,
                    'receiver_id'=>$post->user_id,
                    'content'=>$content,
                    'sender_img'=>asset('images/'.Auth::user()->image),
                    'sender_name'=>Auth::user()->name,
                    'notf_id'=>Notification::all()->last()->id,
                    'notf_url'=>route('showpost',$post->id),
                    'time'=>Notification::all()->last()->created_at->diffForHumans()
                ];
                event(new NewNotification($data));
                /***********************************/
            }
            return [
                'status' =>'liked',
            ];
        }
        else
        {
            Like::where([['user_id',Auth::user()->id],['post_id',$post->id]])->delete();
            return [
                'status' =>'disliked',
            ];
        }
    }
}
