@extends('salfny.layouts.layout2')
@section('title')
    تعديل منشور
@endsection
@section('content')
    <section id="Me">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" id="posts">
                    <!-- post -->
                    <div id="post1" class="postContainer">
                        <div class="col-12">
                            <div class="card card-white post">
                                <div>
                                    <div>
                                        <div class="modal-content">
                                            <form action="{{route('updatepost',$post->id)}}" method="post" id="Postr" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل منشور</h5>
                                                    <div class="col-6">
                                                        <div style="float: left;">
                                                            <a href="#" id="iconImg">
                                                                <img src="{{asset('images/img.png')}}">
                                                            </a>
                                                        </div>
                                                        <div class="dropdown meImage"  style="margin-left: 10%;">
                                                            <a class="dropdown-toggle" href="#" id="dropdownMenuLink"
                                                                data-toggle="dropdown" aria-haspopup="true" 
                                                                aria-expanded="false">
                                                                <img src="{{asset('images/emoj.png')}}">
                                                            </a>
                                                            <div class="dropdown-menu emjContainer col-sm-8"
                                                                aria-labelledby="dropdownMenuLink" style="min-width: 20rem">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <img src="{{asset('images/'.Auth::user()->image())}}" style=" width: 70px;
                                                            height: 70px;border-radius: 50%;float: right;">
                                                        </div>
                                                        <input type="file" name="image" id="postImg" class="d-none">
                                                        <div class="col-9">
                                                            <textarea name="content2" class="form-control" required id="postContent" rows="4" cols="30" style="border:1px solid #d8e5f2;resize: none;" placeholder="ماذا تريد أن تنشر ..">{{ $post->content}}</textarea><br />
                                                            @error('image')
                                                                <h6 class="alert alert-danger text-center">
                                                                    <i class="fa fa-exclamation-triangle"></i>
                                                                    يجب اختيار صورة صالحة 
                                                                </h6>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="{{($post->image==null)? 'd-none':''}}" id="imgContainer">
                                                    <hr>
                                                    <img src="{{asset('images/'.$post->image)}}" 
                                                        style="max-width: 80%;height: 120px;margin-left: 30%;margin-bottom: 10px;"
                                                        id="imgContainerimg">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary col-4">تعديل</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- -->
                                <div class="post-description col-sm-10 text-right"> 
                                    <hr>
                                    <a href="{{route('storelike',$post->id)}}" data-like="{{$post->id}}" class="float-right">
                                        <i class="fa fa-heart {{ $post->checkLike() }}" id="postLikeIcon{{$post->id}}"></i>
                                    </a>
                                    <span class="text-secondary mr-1 likesCount{{$post->id}}">
                                        ( {{ $post->likes->count() }} )
                                    </span>
                                    <input type="number" class="likesNewCount{{$post->id}}" value="{{ $post->likes->count() }}" hidden>
                                    <a href="#" class="float-left mr-4">
                                        <i class="fa fa-share-alt text-secondary"></i>
                                    </a>
                                    <span class="text-secondary float-left mr-1 commentsCount{{$post->id}}">
                                        ( {{ $post->comments->count() }} )
                                    </span>
                                    <input type="number" class="commentsNewCount{{$post->id}}" value="{{ $post->comments->count() }}" hidden>
                                    <a href="#" class="float-left" data-comment="{{$post->id}}">
                                        <i class="fa fa-comment text-secondary"></i>
                                    </a>
                                    <hr>
                                    <!-- comments -->
                                    <div class="commentsContainer{{$post->id}}" style="display: none">
                                        <div class="comos{{$post->id}}">
                                            @foreach ($post->comments as $comment )
                                                <div class="post-heading" style="height: 60px;padding: 2px;">
                                                    <div class="float-right image">
                                                        <img src="{{asset('images/'.$comment->owner->image())}}" 
                                                            class="img-circle avatar" alt="user profile image" style="width: 30px; height: 30px;">
                                                    </div>
                                                    <div class="float-right meta">
                                                        <div class="title h5" style="margin: 10px;font-size: 12px;">
                                                            <a href="#"><b>{{ $comment->owner->name }}</b></a>
                                                        </div>
                                                        <h6 class="text-muted time" style="font-size: 10px;">{{ $comment->created_at->diffForHumans() }}</h6>
                                                    </div>
                                                    <div class="float-left meta">
                                                        @if ($comment->user_id == Auth::user()->id)
                                                            <a href="#">
                                                                <i class="fa fa-trash-alt text-danger"></i>
                                                            </a>
                                                        @else
                                                            <button class="dropdown-item p-2 sendCommentReport text-right text-warning"
                                                                type="button" data-toggle="modal" style="outline: none;background-color: #fff;"
                                                                data-target=".examplePostModal{{$comment->id}}"
                                                                data-id="{{$comment->id}}" data-commentNotice="#">
                                                                <h6><i class="fa fa-exclamation-triangle"></i></h6>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div> 
                                                <div class="post-description col-sm-10 text-right" style="padding-top: 0;padding-bottom: 1px;"> 
                                                    <p>
                                                        {{ $comment->content }}
                                                    </p>
                                                </div>
                                                <hr style="border-top: 1px solid #ddcd80;">
                                            @endforeach
                                        </div>
                                        <div>
                                            <form action="{{ route('storecomment',$post->id)}}" method="POST" class="sendPostComment"
                                                enctype="multipart/form-data" data-info="{{$post->id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}
                                                <input type="text" class="form-control col-10" placeholder="اكتب تعليقك هنا ..." 
                                                    required style="float: right" name="comcontent" id="commentContent{{$post->id}}">
                                                <div style="float: right;margin: 5px" class="dropdown meImage col-1">
                                                    <a class="dropdown-toggle dropdownMenuLinkComm" href="#"
                                                        data-toggle="dropdown" aria-haspopup="true" data-posting="{{$post->id}}"
                                                        aria-expanded="false">
                                                        <img src="{{asset('images/emoj.png')}}">
                                                    </a>
                                                    <div class="dropdown-menu emojis emjContainerComm{{$post->id}} col-sm-8"
                                                        aria-labelledby="dropdownMenuLink" data-postin="{{$post->id}}" style="min-width: 20rem">
                                                    </div>
                                                </div>
                                                <button type="submit" hidden></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection