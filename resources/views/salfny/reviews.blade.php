@extends('salfny.layouts.layout1')
@section('title')
    أراء المستخدمين
@endsection
@section('content')
    <!-- start content -->
    <section id="Review">
        <div id="content2">
            <div class="container">
                <div id="top2">
                    <h1>أراء المستخدمين</h1>
                    <p>
                        في هذه الصفحة يتم نشر أراء المستخدمين بشكل حيادي طالما كانت هذه الأراء قابلة للنشر نتمي المشاركة بوجهات نظركم .
                    </p>
                </div>
                <div id="reviewing" class="row">
                    @if ($reviews->count() ==0)
                        <div class="alert alert-primary col-12">
                            <h4 class="text-center">لا توجد أراء من المستخدمين حتي الآن <i class="fas fa-heart-broken"></i></h4>
                        </div>
                    @endif
                    @foreach($reviews as $review)
                        <div id="p" class="col-sm-6">
                            <blockquote id="user">
                                <p><q>{{$review->content}}</q></p>
                                <img src="{{asset("images/".$review->owner->image)}}" width="80px" height="80px">
                            </blockquote>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection
