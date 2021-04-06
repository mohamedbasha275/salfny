@extends('salfny.layouts.layout2')
@section('title')
   المحادثات
@endsection
@section('content')
    <!-- start content -->
    <div class="container-fluid h-100 chatConts">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="input-group">
                        <input type="text" placeholder="ابحث..."  onkeyup="search_chatUsers(this.value, 'result');"
                            class="form-control search_btn ">
                        <div class="input-group-prepend">
                            <span class="input-group-text search"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body scrollbar d-none d-sm-block">
                    <h5 class="ml-2 mb-2 text-white closeMenu d-block d-sm-none">إغلاق</h5>
                    <ul class="contacts" id="userChatList">
                        @foreach ($users as $use)
                            <li class="{{$use->id == $user->id ? 'active':''}}">
                                <a href="{{ route('showchat',$use->id) }}">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{ asset('images/'.$use->image()) }}"
                                            class="rounded-circle user_img">
                                            @if(Cache::has('is_online' . $use->id))
                                                <span class="online_icon"></span>
                                            @else
                                                <span class="online_icon offline"></span>
                                            @endif
                                        </div>
                                        <div class="user_info mr-2">
                                            <span>{{ $use->name }}</span>
                                            <p>{{$use->seening}}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer"></div>
            </div></div>
            <div class="col-md-8 col-xl-6 chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="{{ asset('images/'.$user->image()) }}" class="rounded-circle user_img">
                                @if(Cache::has('is_online' . $use->id))
                                    <span class="online_icon"></span>
                                @else
                                    <span class="online_icon offline"></span>
                                @endif
                            </div>
                            <div class="user_info mr-2 text-right">
                                <span>{{ $user->name }}</span>
                                <p>{{ $user->seening }}</p>

                            </div>
                            <!--div class="video_cam">
                                <span><i class="fas fa-video"></i></span>
                                <span><i class="fas fa-phone"></i></span>
                            </div-->
                            {{-- <span id="action_refresh" class="ml-4"><i class="fas fa-sync-alt"></i></span>
                            <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                            <div class="action_menu">
                                <ul>
                                    <li><i class="fas fa-user-circle"></i> View profile</li>
                                    <li><i class="fas fa-users"></i> Add to close friends</li>
                                    <li><i class="fas fa-plus"></i> Add to group</li>
                                    <li><i class="fas fa-ban"></i> Block</li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body msg_card_body scrollbar" id="chatConents">
                        @include('salfny.chat.content')
                        <div id="scrolltopChat">
                            <i class="fa fa-angle-double-down"></i>
                        </div>
                    </div>
                    <form action="{{route('storechat',$user->id)}}" method="post" id="addNew" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="card-footer">
                            <div class=" emjChatContainer col-sm-12" style="display: none;min-width: 20rem;"></div>
                            <div class=" attachContainer row" style="display: none;min-width: 20rem;">
                                <div class="col-4 text-center pb-2">
                                    <img src="{{ asset('images/cam.png') }}" width="45px" height="45px">
                                </div>
                                <div class="col-4 text-center pb-2">
                                    <img src="{{ asset('images/aud.png') }}" width="45px" height="45px">
                                </div>
                                <div class="col-4 text-center pb-2">
                                    <img src="{{ asset('images/vid4.png') }}" width="45px" height="45px">
                                </div>
                            </div>
                            <div class="input-group">
                                <textarea name="message" class="form-control type_msg" style="border-radius: 0 10px 10px 0;" placeholder="اكتب رسالتك..."></textarea>
                                <div class="input-group-append">
                                    <span class=" input-group-text attach_btn" id="chatmotion"><i class="fas fa-smile"></i></span>
                                </div>
                               {{--  <div class="input-group-append">
                                    <span class=" input-group-text attach_btn" id="attachBtn">
                                        <i class="fas fa-paperclip"></i>
                                    </span>
                                </div> --}}
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text send_btn" >
                                        <i class="fas fa-location-arrow"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->
@endsection
@section('js')
    <script>
       	$(document).ready(function()
        {
            $("#chatConents").stop().animate({ scrollTop: $("#chatConents")[0].scrollHeight}, 1000);
            var scrolltopchat = $("#scrolltopChat");
            var element = document.getElementById("chatConents");
            $("#chatConents").scroll(function()
            {
                console.log( element.scrollHeight +' op '+$(this).scrollTop());
                console.log(element.scrollHeight - $(this).scrollTop());
                if(element.scrollHeight - $(this).scrollTop() >=550)
                {
                    scrolltopchat.show(100);
                }
                else
                {
                    scrolltopchat.hide(100);
                }
            });
            scrolltopchat.on('click',function()
            {
                $("#chatConents").stop().animate({ scrollTop: $("#chatConents")[0].scrollHeight}, 1000);
            });
            $('#action_menu_btn').click(function()
            {
                $('.action_menu').toggle();
            });
            /***/
            // emoj
            for($i=128512;$i<=128576;$i++)
            {
                $('.emjChatContainer').append('<a class="emoji col-1">&#'+$i+';</a>');
            }
            $(".emoji").on('click',function()
            {
                $('.type_msg').val($('.type_msg').val() + $(this).html());
            });
            $('#chatmotion').click(function()
            {
                $('.emjChatContainer').toggle();
            });
            // attach
            $('#attachBtn').click(function()
            {
                $('.attachContainer').toggle();
            });
            // send message
            $('.type_msg').on('keypress',function(){
                $('.fa-location-arrow').css('color','#8083D7');
            });
            $('#addNew').on('submit',function (e)
            {
                $('.emjChatContainer').hide();
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                $.ajax({
                    url: url,
                    dataType: 'json',
                    data: data,
                    type: method,
                    success:function (data)
                    {
                        var html="<div class='d-flex justify-content-end mb-4'><div class='msg_cotainer_send'>"+
                            data.content+"<span class='msg_time_send text-secondary'>"+data.time+
                            "</div><div class='img_cont_msg'><img src='{{ asset('images/'.Auth::user()->image()) }}' "+
                            "class='rounded-circle user_img_msg'></div></div>";
                        $('#chatConents').append(html);
                        $('.fa-location-arrow').css('color','#fff');
                    }
                });
                $(this).trigger('reset');   // to empty inputs
                $("#chatConents").stop().animate({ scrollTop: $("#chatConents")[0].scrollHeight}, 1000);
            });
            /******/
            // when refresh chat
            /*$.get("{{URL::to('me/chat/chatdata/'.$user->id)}}",function (data)
            {
                $('#chatin').html(data);
            });*/


            // Live Search For users

        });
        $('.search_btn').on('focus',function(){
            $('.contacts_body').removeClass('d-none');
        });
        $('.closeMenu').on('click',function(){
            $('.contacts_body').addClass('d-none');
        });
        function search_chatUsers(search_value)
        {
            $('.contacts_body').removeClass('d-none');
            $.ajax({
                url: '{{ route("chat_searching") }}',
                data : {'search':search_value},
                method: 'GET',
                success:function(data) {
                    $('#userChatList').empty();
                    if(data.users.length != 0)
                    {
                        for(var user of data.users)
                        {
                            url = '{{ route("showchat", ":id") }}'.replace(':id',user.id);
                            var html="<li><a href="+url+"><div class='d-flex bd-highlight'><div class='img_cont'>"+
                                "<img src='{{asset('images')}}/"+user.image+"' class='rounded-circle user_img'>"+
                                "<span class='"+user.activenow+"'></span></div><div class='user_info mr-2'><span>"+user.name+"</span>"+
                                " <p>"+user.since+"</p></div></div></a></li>";
                            $('#userChatList').append(html);
                        }
                    }
                    else
                    {
                        var html='<h5 class="text-white text-center m-2"> لا توجد نتائج بحث مشابهة <i class="fab fa-searchengin"></i></h5>';
                        $('#userChatList').append(html);
                    }
                }
            });
        }
    </script>
@endsection
