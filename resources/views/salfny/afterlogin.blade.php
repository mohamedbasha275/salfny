@extends('salfny.layouts.layout2')
@section('title')
    الأخبار
@endsection
@section('content')
    <!-- start content -->
    @if(count($posts) == 0)
        <div class=" col-xs-8 col-xs-offset-2 alert alert-info text-center">
            <h2>There isn't any post till now , wait soon <i class="fa fa- fa-smile-o"></i></h2>
        </div>
    @endif
    <section id="Me">
        <div class="container">
            <div class="row">
                <div class="col-md-3 pb-2" style="background-color: #fbfbfb;
                        margin: 10px;border-radius: 10px;height: 100%">
                    <h2 class="text-info text-center mb-5 mt-2"> الأعلي مشاركة</h2>
                    @foreach ($users as $user)
                        <div class="using row" style="margin: 10px 0">
                            <div class="float-right col-3">
                                <span style="    position: absolute;
                                margin: 31px -8px;
                                background-color: #fff;
                                border-radius: 50%;
                                padding: 0 3px;"><i class="
                                @if(Cache::has('is_online' . $user->id))
                                    text-success
                                @endif
                                fa fa-circle"></i></span>
                                <img src="{{ asset('images/'.$user->image()) }}"
                                style="width: 60px; height: 60px;border-radius: 50%;border: 2px solid silver;padding: 2px">
                            </div>
                            <div class="row col-9 text-right">
                                <a href="{{route('userprofile',$user->id)}}" class="text-warning col-12" style="font-weight: 600;margin-right: 15px;">{{ $user->name }}</a>
                                <a class="text-secondary col-12" style="margin: 0 15px"><small>{{$user->posts_count}} عروض</small></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <a role="button" class="btn btn-primary col-12 text-white" style="margin-bottom: 20px">عرض الكل</a>
                </div>
                <div class="col-md-8" id="posts">
                    <h2 class="text-info text-center">منشورات المستخدمين</h2>
                    <!-- posts -->
                    @include('salfny.sections.posts')
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection
