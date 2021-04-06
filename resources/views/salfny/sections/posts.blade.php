@auth
    <input class="input-lg col-md-6"  placeholder="اكتب ما تريد نشره..."
        style="width: 50%;margin-left: 22%;margin-bottom: 20px;outline: none;
        padding: 10px 30px;border: 1px solid #bababa;border-radius: 55px;"
        data-toggle="modal" data-target="#exampleModal">
@endauth
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin: 100px auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('storepost')}}" method="post" id="Postr" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> إضافة منشور</h5>
                    <div class="col-6">
                        <div style="float: left;">
                            <a href="#" id="iconImg">
                                <img src="{{asset('images/img.png')}}">
                            </a>
                        </div>
                        <div class="dropdown meImage"  style="margin-left: 7%;">
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
                            <textarea name="content2" class="form-control" required id="postContent" rows="4" cols="30" style="border:1px solid #d8e5f2;resize: none;" placeholder="ماذا تريد أن تنشر ..">{{ old('content2') }}</textarea><br />
                            @error('image')
                                <h6 class="alert alert-danger text-center">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    يجب اختيار صورة صالحة
                                </h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-none" id="imgContainer">
                    <hr>
                    <img src=""
                        style="max-width: 80%;height: 120px;margin-left: 30%;margin-bottom: 10px;"
                        id="imgContainerimg">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">نشر</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($posts as $post)
    <div id="post1" class="postContainer">
        <div class="col-12">
            <div class="card card-white post">
                <div class="post-heading">
                    <div class="float-right image">
                        <img src="{{asset('images/'.$post->owner->image())}}"
                            class="img-circle avatar" style="border-radius: 50%" alt="user profile image">
                    </div>
                    <div class="float-right meta">
                        <div class="title h5" style="margin: 10px; ">
                            <a href="#"><b>{{ $post->owner->name }}</b></a>
                        </div>
                        <h6 class="text-muted time">{{ $post->created_at->diffForHumans() }}</h6>
                    </div>
                    <div class="dropdown meImage float-left meta" >
                        <a class="dropdown-toggle dropdownOptions" href="#"
                            id="dropdownOptions{{$post->id}}" data-post="{{$post->id}}"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu " id="optionsContainer{{$post->id}}"
                            aria-labelledby="dropdownOptions{{$post->id}}">
                            @if($post->user_id == Auth::user()->id)
                                <a class="dropdown-item p-2 text-right" href="{{route('editpost',$post->id)}}">
                                    <h6> <i class="fa fa-edit"></i> تعديل</h6>
                                </a>
                                <a class="dropdown-item p-2 text-right" href="#"
                                    data-deleteaj="{{route('deleteopost',$post->id)}}">
                                    <h6> <i class="fa fa-trash"></i> حذف</h6>
                                </a>
                            @else
                                <button class="dropdown-item p-2 sendPostReport text-right" type="button"
                                        data-toggle="modal" data-target=".examplePostModal{{$post->id}}"
                                        data-id="{{$post->id}}" data-text="إرسال بلاغ ( منشور )"
                                        data-postNotice="{{route('postnotice',$post->id)}}">
                                    <h6> <i class="fa fa-exclamation-triangle"></i> إبلاغ</h6>
                                </button>
                            @endif
                            <a class="dropdown-item p-2 text-right"
                                href="{{route('showpost',$post->id)}}">
                                <h6> <i class="fa fa-eye"></i> عرض</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="post-description col-sm-10 text-right">
                    <p>
                        {{ $post->content }}
                    </p>
                    @if($post->image)
                        <div class="col-sm-12">
                            <img src="{{ asset('images/'.$post->image) }}"
                            style="border: 6px solid #dbdcdd;width: 100%;
                            max-height: 500px;margin-top: 20px; border-radius: 5px;">
                        </div>
                    @endif
                </div>
                <div class="post-description col-sm-10 text-right">
                    <hr>
                    <a href="{{route('storelike',$post->id)}}" data-like="{{$post->id}}" class="float-right">
                        <i class="fa fa-heart {{ $post->checkLike() }}" id="postLikeIcon{{$post->id}}"></i>
                    </a>
                    <span class="text-secondary mr-1 likesCount{{$post->id}}">
                        ( {{ $post->likes->count() }} )
                    </span>
                    <input type="number" class="likesNewCount{{$post->id}}" value="{{ $post->likes->count() }}" hidden>
                    <div class="dropdown meImage float-left meta" >
                        <a class="dropdown-toggle dropdownShares float-left mr-4" href="#"
                            id="dropdownShare{{$post->id}}" data-post="{{$post->id}}"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-share-alt text-secondary"></i>
                        </a>
                        <div class="dropdown-menu " id="shareContainer{{$post->id}}"
                            aria-labelledby="dropdownShare{{$post->id}}">
                            <a class="dropdown-item p-2 text-right"
                                href="https://www.facebook.com/sharer/sharer.php?u={{route('showpost',$post->id)}}">
                                <h6> <i class="fab fa-facebook"></i> facebook</h6>
                            </a>
                            <a class="dropdown-item p-2 text-right"
                                href="https://twitter.com/intent/tweet?text=my share text&amp;url={{route('showpost',$post->id)}}">
                                <h6> <i class="fab fa-twitter"></i> twitter</h6>
                            </a>
                            <a class="dropdown-item p-2 text-right"
                                href="https://wa.me/?text={{route('showpost',$post->id)}}">
                                <h6> <i class="fab fa-whatsapp"></i> whatsapp</h6>
                            </a>
                        </div>
                    </div>
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
                                <div class="commentContainer">
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
                                                <a href="#"
                                                   data-deletecomment="{{route('deletecomment',$comment->id)}}">
                                                    <i class="fa fa-trash-alt text-danger"></i>
                                                </a>
                                            @else
                                                <button class="dropdown-item p-2 sendCommentReport text-right text-warning"
                                                        type="button" data-toggle="modal" style="outline: none;background-color: #fff;"
                                                        data-target=".examplePostModal{{$comment->id}}"  data-text="إرسال بلاغ ( تعليق )"
                                                        data-id="{{$comment->id}}" data-commentNotice="{{route('commentnotice',$comment->id)}}">
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
                                </div>
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
@endforeach
<p class="text-center">سلفني {{date('Y')}}</p>
