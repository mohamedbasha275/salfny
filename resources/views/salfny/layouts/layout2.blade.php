<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--------- CSRF Token --------->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--------- Title --------->
        <title>
            سلفني
            |
            @yield('title')
        </title>
        <!--------- SEO --------->
        @yield('mymeta')
        <!--------- Icon --------->
        <link rel="icon" href="{{asset('images/icon.png')}}">
        <!--------- Jquery --------->
        <script src="{{asset('salfny/js/jquery-3.2.1.min.js')}}"></script>
        <!--------- BootStrap --------->
        <link href="{{ asset('salfny/css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ asset('salfny/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('salfny/js/bootstrap.bundle.min.js') }}"></script>
        <!--------- Font Awesome --------->
        <link rel="stylesheet" href="{{asset('fontawesome-free-5.13.1-web/css/all.css')}}">
        <!--------- Fonts --------->
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <style>
            body , *{
                font-family: 'Cairo', serif;
            }
            .meImage>.dropdown-toggle::after{display: none;}
        </style>
        <!--------- Sweet Alert --------->
        <link rel="stylesheet" href="{{asset('sweetalert2/dist/sweetalert2.min.css')}}" />
        <script src="{{asset('sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('sweetalert2/dist/sweetalert2.min.js')}}"></script>
        <!--------- ckeditor --------->
        <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
        <!--------- Animation --------->
        <script src="{{asset('salfny/js/wow.min.js')}}"></script>
        <link type="text/css" rel="stylesheet" href="{{asset('salfny/css/hover.css')}}" />
        <link type="text/css" rel="stylesheet" href="{{asset('salfny/css/animate.css')}}" />
        <!--------- Styles --------->
        <link type="text/css" rel="stylesheet" href="{{asset('salfny/css/aftermaster.css')}}"/>
        <!-- Styles -->
        <style>
            .emoji:hover,.emojiComm:hover
            {
                cursor: pointer;
            }
            .emoji,.emojiComm
            {
                margin: -5px;
            }
            .notifContainer
            {
                background-color: #ffa50040;
            }
            .notifContainer:hover
            {
                background-color: aliceblue
            }
        </style>
        @yield('css')
        <!-- /Styles -->
    </head>
    <body dir="rtl">
        <!-- Header -->
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('index')}}" id="logo" tyle="padding: 0">
                <img src="{{asset('images/logoo.png')}}" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0 searching col-12 col-sm-4"
                    action="{{route('offerssearch')}}" method="GET">
                    <input class="form-control mr-sm-2 col-10" type="search"
                    placeholder="عن ماذا تبحث.." name="name" aria-label="Search">
                    <i class="fa fa-search"></i>
                </form>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown meImage">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('images/'.Auth::user()->image())}}"
                                 style="border-radius:50%;width:50px;height:50px;">
                        </a>
                        <div class="dropdown-menu setdropdown" aria-labelledby="navbarDropdown">
                            <!--a class="dropdown-item" href="#">
                                <i class="fa fa-user-circle">ملفي الشخصي</i>
                            </!--a-->
                            <hr>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt">   تسجيل خروج</i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item {{(request()->is('me'))? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('me') }}">
                            <i class="fa fa-home"></i>
                            الأخبار
                        </a>
                    </li>
                    <li class="nav-item {{(request()->is('me/myprofile'))? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('profile') }}">
                            <i class="fa fa-user-circle"></i>
                            ملفي الشخصي
                        </a>
                    </li>
                    <li class="nav-item {{(request()->is('me/offers'))? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('offers') }}">
                            <i class="fa fa-hand-holding-heart"></i>
                            عروض متاحة
                        </a>
                    </li>
                    <li class="nav-item {{(request()->is('me/users'))? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users') }}">
                            <i class="fa fa-users"></i>
                            المستخدمين
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item meImage">
                        <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell">
                                @if(Auth::user()->notifications()->where('seen',1)->count() == 0)
                                    <span class="badge badge-danger notfMeCount d-none">0</span>
                                @endif
                                @if(Auth::user()->notifications()->count()>0)
                                    <span class="badge badge-danger notfMeCount">{{Auth::user()->notifications()->where('seen',1)->count()}}</span>
                                @endif
                            </i>
                            الإشعارات
                        </a>
                        <div class="dropdown-menu" style="left: 60px;text-align: right;"
                             aria-labelledby="notiDropdown">
                            <h5 class="text-danger text-center" style="    font-size: 15px;">لديك <span class="notf-span">{{Auth::user()->notifications()->where('seen',1)->count()}}</span> إشعارات جديدة</h5>
                           <ul style="    list-style-type: none;
                           padding: 0;width: 280px"  class="notf-menu">
                           @foreach(Auth::user()->notifications()->where('seen',1)->limit(3)->get() as $notf)
                               <li class="notifContainer">
                                   <a data-asreadnotff="{{route('asreadnotf',$notf->id)}}"
                                    href="{{route($notf->notfUrl(),$notf->relation_id)}}">
                                    <div style="width: 100%;">
                                        <img src="{{asset('images/'.$notf->reactor->image())}}">
                                        <h6  class="text-info text-bold">{{$notf->reactor->name}}</h6>
                                        <small class="text-secondary">{{$notf->created_at->diffForHumans()}}</small>
                                        <p class="text-secondary">
                                            {{$notf->content}}
                                        </p>
                                    </div>
                                   </a>
                               </li>
                            @endforeach
                               <li class="text-center">
                                   <a href="{{route('notifications')}}" style="text-decoration: none">عرض كل الإشعارات <i class="fa fa-angle-left"></i></a>
                               </li>
                           </ul>
                        </div>
                    </li>
                    <li class="nav-item meImage">
                        <a class="nav-link dropdown-toggle" href="#" id="msgDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-comments">
                                @if(Auth::user()->allUnreadMessages()->count() == 0)
                                    <span class="badge badge-warning chatMeCount d-none">0</span>
                                @endif
                                @if(Auth::user()->allUnreadMessages()->count()>0)
                                    <span class="badge badge-warning chatMeCount">{{Auth::user()->allUnreadMessages()->count()}}</span>
                                @endif
                            </i>
                            الرسائل
                        </a>
                        <div class="dropdown-menu" style="left: 60px;text-align: right;"
                             aria-labelledby="msgDropdown">
                            <h5 class="text-warning text-center" style="font-size: 15px;">لديك <span class="msg-span">{{Auth::user()->allUnreadMessages()->count()}}</span> رسائل جديدة</h5>
                           <ul style="    list-style-type: none;
                           padding: 0;width: 280px" class="message-menu">
                           @foreach(Auth::user()->allUnreadMessages()->latest('created_at')->limit(3)->get() as $msg)
                               <li class="notifContainer">
                                   <a href="{{route('showchat',$msg->id)}}">
                                    <div style="width: 100%;">
                                        <img src="{{asset('images/'.$msg->image())}}">
                                        <h6 class="text-info text-bold">{{$msg->name}}</h6>
                                        <small class="text-secondary">{{$msg->chats()->first()->time}}</small>
                                        <p class="text-secondary">
                                            لقد تلقيت رسالة
                                        </p>
                                    </div>
                                   </a>
                               </li>
                            @endforeach
                               <li class="text-center">
                                   <a href="{{route('chat')}}" style="text-decoration: none">عرض كل المحادثات <i class="fa fa-angle-left"></i></a>
                               </li>
                           </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark" hidden>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown meImage">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('images/'.Auth::user()->image())}}"
                             style="border-radius:50%;width:50px;height:50px;">
                    </a>
                    <div class="dropdown-menu setdropdown" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-cog">  الإعدادات</i>
                        </a>
                        <hr>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt">   تسجيل خروج</i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item {{(request()->is('me'))? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('me') }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="nav-item {{(request()->is('me/myprofile'))? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profile') }}">
                        <i class="fa fa-user-circle"></i>
                    </a>
                </li>
                <li class="nav-item {{(request()->is('me/offers'))? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('offers') }}">
                        <i class="fa fa-hand-holding-heart"></i>
                    </a>
                </li>
                <li class="nav-item {{(request()->is('me/users'))? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users') }}">
                        <i class="fa fa-users"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /Header -->
        <div class="section">
            <!-- Content -->
            <!-- Flash Message -->
        @include('salfny.layouts.flashmessage')
        <!-- /Flash Message -->
            <!--Modal Report -->
        @include('salfny.sections.noticeModal')
            <!-- -->
        @yield('content')
        <!-- /Content -->
        </div>
        <!-- Footer -->
        @include('salfny.layouts.footer');
        <!-- /Footer -->
        <!-- Loading -->
        <section id="loading"></section>
        <!-- /Loading -->
        <!-- Scroll Top -->
        <div id="scrolltop">
            <i class="fa fa-chevron-up"></i>
        </div>
        <!-- /Scroll Top -->
        <!-- Js -->
        <script src="{{asset('salfny/js/project.js')}}"></script>
        <!-- Pusher -->
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <!-- for chat -->
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('e4d8162df4325a7e5699', {
                cluster: 'mt1'
            });
        </script>
        @auth()
            <script>
                var curOrl=function(userD)
                {
                    var currentUrl="{{ Request::url() }}";
                    var parts = currentUrl.split('/');
                    var answer = parts[parts.length - 1];
                    if(parts[parts.length - 1] == userD && parts[parts.length - 2] == 'show'
                        && parts[parts.length - 3] == 'chat')
                        return true;
                };
                // pusher after geting data
                var currentUser="{{ Auth::user()->id }}";
                // Subscribe to the channel we specified in our Laravel Event
                var channel = pusher.subscribe('new-chat');
                // Bind a function to a Event (the full Laravel class)
                channel.bind('App\\Events\\NewChat', function (data)
                {
                    if(data.receiver_id == currentUser)
                    {
                        // audio tone
                        var myAudio = new Audio('{{asset('js/message_tone.mp3')}}');
                        myAudio.play();
                        if(curOrl(data.sender_id))
                        {
                            // if type message or add
                            var message='';
                            // message
                            if(data.message != null)
                            {
                                message=data.message;
                            }
                            var tr="<div class='d-flex justify-content-start mb-4'><div class='img_cont_msg'>"+
                                "<img src='"+data.sender_img+"' class='rounded-circle user_img_msg'></div>"+
                                "<div class='msg_cotainer'>"+message+"<span class='msg_time text-secondary'>"+data.time+"<div>"+
                                "</div></div>";
                            $('#chatConents').append(tr);
                            $("#chatConents").stop().animate({ scrollTop: $("#chatConents")[0].scrollHeight}, 1000);
                        }
                        else
                        {
                            var chatCount = parseInt($('.chatMeCount').text());
                            var newCount=chatCount+1;
                            $('.chatMeCount').removeClass('d-none');
                            $('.chatMeCount').text(newCount);
                            var chatCount2 = parseInt($('.msg-span').text());
                            var newCount2=chatCount2+1;
                            $('.msg-span').text(newCount2);

                            var goChat= '{{ route("showchat", ":id") }}'.replace(':id',data.sender_id);
                            var tr="<li class='notifContainer'><a href='"+goChat+"'><div style='width: 100%;'>"+
                                "<img src='"+data.sender_img+"'><h6 class='text-info text-bold'>"+
                                data.sender_name+"</h6><small class='text-secondary'>"+data.time+"</small>"+
                                "<p class='text-secondary'>لقد تلقيت رسالة</p></div></a></li>";
                            $('.message-menu').prepend(tr);
                        }
                    }
                });
            </script>
        @endauth
        <!-- for notification -->
        @auth()
            <script>
                // pusher after geting data
                var currentUser="{{ Auth::user()->id }}";
                // Subscribe to the channel we specified in our Laravel Event
                var channel = pusher.subscribe('new-notification');
                // Bind a function to a Event (the full Laravel class)
                channel.bind('App\\Events\\NewNotification', function (data)
                {
                    if(data.receiver_id == currentUser)
                    {
                        // audio tone
                        var myAudio = new Audio('{{asset('js/notification.mp3')}}');
                        myAudio.play();
                        var chatCount = parseInt($('.notfMeCount').text());
                        var newCount=chatCount+1;
                        $('.notfMeCount').removeClass('d-none');
                        $('.notfMeCount').text(newCount);
                        var chatCount2 = parseInt($('.notf-span').text());
                        var newCount2=chatCount2+1;
                        $('.notf-span').text(newCount2);
                        var readNotf= '{{ route("asreadnotf", ":idd") }}'.replace(':idd',data.notf_id);
                        var tr="<li class='notifContainer'><a href='"+data.notf_url+"' data-asreadnotffio='"+readNotf+"'><div style='width: 100%;'>"+
                            "<img src='"+data.sender_img+"'><h6 class='text-info text-bold'>"+
                            data.sender_name+"</h6><small class='text-secondary'>"+data.time+"</small>"+
                            "<p class='text-secondary'>"+data.content+"</p></div></a></li>";
                        $('.notf-menu').prepend(tr);
                        // As read notification
                        $("[data-asreadnotffio]").on('click',function(){
                            $.ajax({
                                type: "GET",
                                url: $(this).data('asreadnotffio'),
                                success: function() {
                                }
                            })
                        });
                    }
                });
            </script>
        @endauth
        <!-- /Pusher -->
        @yield('js')
        <!-- /Js -->
    </body>
</html>
