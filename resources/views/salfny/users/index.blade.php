@extends('salfny.layouts.layout2')
@section('title')
   المستخدمين
@endsection
@section('content')
    <!-- start content -->
    <section id="offers">
        <div class="container">
            <div id="top2" class="m-5">
                <h1>عروض المستخدمين</h1>
                <p>
                    الآن يمكنك الحصول علي ما تريد من عروض ويمكنك أيضاً المساعدة .
                </p>
            </div>
            <section class="search-sec">
                <div class="container">
                    <form action="#" method="post" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 p-0">
                                        <input type="text" class="form-control search-slt"
                                        placeholder="اكتب اسم ...">
                                    </div>
                                    <div class="col-md-4 col-sm-12 p-0">
                                        <select class="form-control search-slt" id="exampleFormControlSelect1">
                                            <option value="">-- اختر المحافظة --</option>
                                            @foreach (\App\Category::all() as $category )
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-12 p-0">
                                        <button type="button" class="btn btn-danger wrn-btn">
                                            ابحث الآن
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <div class="container userConts">
                <div class="row">
                    @foreach ($users as $user)
                        <div class="col-lg-3 col-sm-6">
                            <div class="card hovercard">
                                <div class="cardheader">
                                </div>
                                <div class="avatar">
                                    <img alt="" src="{{asset('images/'.$user->image())}}">
                                </div>
                                <div class="info">
                                    <div class="title">
                                        <a target="_blank" href="https://scripteden.com/">{{ $user->name }}</a>
                                    </div>
                                    <div class="desc">{{ $user->address }}</div>
                                    <div class="desc">5 عروض</div>
                                    <div class="desc">عضو {{ $user->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="bottom">
                                    <a class="btn btn-primary btn-twitter btn-sm" data-toggle="tooltip" data-placement="top" title="اتصال"
                                        href="tel:{{ $user->phone }}">
                                        <i class="fas fa-phone" style="    margin: 1px -4px;
                                        font-size: 16px"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm" rel="publisher" data-toggle="tooltip" data-placement="top" title="عرض الملف الشخصي"
                                    href="https://plus.google.com/shahnuralam">
                                        <i class="fas fa-user-circle" style="    margin: 2px -4px;
                                        font-size: 16px"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" rel="publisher" href="https://plus.google.com/shahnuralam" data-toggle="tooltip" data-placement="top" title="محادثة">
                                        <i class="fas fa-comments" style="    margin: 1px -4px;
                                        font-size: 16px"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm sendUserReport" type="button" data-toggle="modal"
                                       data-target=".examplePostModal{{$user->id}}"  data-text="إرسال بلاغ ( عضو )"
                                       data-id="{{$user->id}}" data-userNotice="{{route('usernotice',$user->id)}}">
                                        <i class="fas fa-exclamation-triangle" style="margin: 1px -4px;font-size: 16px"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-xs-6 col-sm-5 col-xs-offset-4 col-sm-offset-5">{!! $users->render() !!}</div>
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection
@section('js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection
