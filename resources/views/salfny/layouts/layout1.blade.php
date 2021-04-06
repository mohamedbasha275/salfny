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
        <!--------- Font Awesome --------->
        <link rel="stylesheet" href="{{asset('fontawesome-free-5.13.1-web/css/all.css')}}">
        <!--------- Fonts --------->
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <style>
            body , *{
                font-family: 'Cairo', serif;
            }
        </style>
        <!--------- Sweet Alert --------->
        <link rel="stylesheet" href="{{asset('sweetalert2/dist/sweetalert2.min.css')}}" />
        <script src="{{asset('sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('sweetalert2/dist/sweetalert2.min.js')}}"></script>
        <!--------- Animation --------->
        <script src="{{asset('salfny/js/wow.min.js')}}"></script>
        <link type="text/css" rel="stylesheet" href="{{asset('salfny/css/hover.css')}}" />
        <link type="text/css" rel="stylesheet" href="{{asset('salfny/css/animate.css')}}" />
        <!--------- Styles --------->
        <link type="text/css" rel="stylesheet" href="{{asset('salfny/css/master.css')}}"/>
        <!-- Styles -->
        @yield('css')
        <!-- /Styles -->
    </head>
    <body dir="rtl">
        <!-- Header -->
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <a class="navbar-brand" href="{{route('index')}}" id="logo" style="padding: 0">
                <img src="{{asset('images/logoo.png')}}" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{(request()->is('/'))? 'active' : '' }}">
                        <a class="nav-link" href="{{route('index')}}"> الرئيسية </a>
                    </li>
                    <li class="nav-item {{(request()->is('contact_us'))? 'active' : '' }}">
                        <a href="{{route('contact_us')}}" class="hvr-hang nav-link"> اتصل بنا </a>
                    </li>
                    <li class="nav-item {{(request()->is('questions'))? 'active' : '' }}">
                        <a href="{{route('questions')}}" class="hvr-hang nav-link"> الأسئلة المتكررة </a>
                    </li>
                    <li class="nav-item {{(request()->is('reviews'))? 'active' : '' }}">
                        <a href="{{route('reviews')}}" class="hvr-hang nav-link"> أراء المستخدمين </a>
                    </li>
                    <li class="nav-item {{(request()->is('about_us'))? 'active' : '' }}">
                        <a href="{{route('about_us')}}" class="hvr-hang nav-link"> من نحن
                        </a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" style="margin-left: 50px">
                    <a href="{{ route('login') }}" class="btn btn-success">دخول</a>
                    <a href="{{ route('register') }}"  class="btn btn-info mr-2" >تسجيل</a>
                </form>
                <form class="form-inline my-2 my-lg-0 searching"
                    action="{{route('offerssearch')}}" method="GET">
                    <input class="form-control mr-sm-2" type="search"
                        placeholder="عن ماذا تبحث.." name="name" aria-label="Search">
                    <button class="btn btn-warning" type="submit">
                        <i class="fa fa-search text-white"></i>
                    </button>
                </form>
            </div>
        </nav>
        <!-- /Header -->
        <div class="section">
            <!-- Content -->
            <!-- Flash Message -->
            @include('salfny.layouts.flashmessage')
            <!-- /Flash Message -->
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
        @yield('js')
        <!-- /Js -->
    </body>
</html>
