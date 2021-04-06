@extends('salfny.layouts.layout1')
@section('title')
    الرئيسية
@endsection
@section('content')
    <!-- start slideshow -->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>معاً</h1>
                    <p>نستطيع تجاوز كل الصعوبات لا بديل عن التعاون والمشاركة .</p>
                    <a class="btn btn-lg btn-info" role="button" href="#">إقرا المزيد</a>
                </div>
            </div>
          <div class="carousel-item">
            <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>معاً</h1>
                <p>نستطيع تجاوز كل الصعوبات لا بديل عن التعاون والمشاركة .</p>
                <a class="btn btn-lg btn-info" role="button" href="#">إقرا المزيد</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>معاً</h1>
                <p>نستطيع تجاوز كل الصعوبات لا بديل عن التعاون والمشاركة .</p>
                <a class="btn btn-lg btn-info" role="button" href="#">إقرا المزيد</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/slide4.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>معاً</h1>
                <p>نستطيع تجاوز كل الصعوبات لا بديل عن التعاون والمشاركة .</p>
                <a class="btn btn-lg btn-info" role="button" href="#">إقرا المزيد</a>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    <!-- /end slideshow -->
    <section class="search-sec">
        <div class="container">
            <form action="{{route('offerssearch')}}" method="get" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <input type="text" class="form-control search-slt"
                                    name="name" placeholder="عن ماذا تبحث...">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <input type="text" class="form-control search-slt"
                                name="place" placeholder="مكان البحث...">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <select class="form-control search-slt"  name="category"
                                    id="exampleFormControlSelect1">
                                    <option value="">-- اختر القسم --</option>
                                    @foreach (\App\Category::all() as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <button type="submit" class="btn btn-danger wrn-btn">
                                    ابحث الآن
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- start content -->
    <section id="Home">
        <div class="container">
            <div id="welcome" class="text-center">
                <h1>اهلا بكم في <span>سلفني</span></h1>
                <p class="lead">مجتمع المشاركة الأول</p>
                <p class="lead"> هدفنا تقديم كل ما يمكننا لمساعدة الآخرين .</p>
            </div>
        </div>
    </section>
    <section id="offers">
        <div class="container">
            <div class="row">
                @if ($offers->count() == 0)
                    <div class="alert alert-info col-12">
                        <h3 class="text-center">لا توجد عروض حتي الآن</h3>
                    </div>
                @endif
                @foreach($offers as $offer)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="{{asset("images/".$offer->image)}}" height="235px">
                            <div class="card-body">
                                <h5 class="card-title border-bottom pb-3 text-right text-warning">
                                    {{ $offer->name }}
                                    <small class="float-left d-inline-flex text-secondary" style="font-size: 13px">
                                        <i class="fa fa-clock m-1"></i>
                                        {{ $offer->created_at->diffForHumans() }}
                                    </small>
                                </h5>
                                <p class="card-text text-right">
                                    {{$offer->description}}
                                </p>
                                <a href="{{route('showoffer',$offer->slug)}}"
                                    class="float-right"> المزيد
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                                <a href="{{route('showoffer',$offer->slug)}}"
                                    class="float-left"> حجز الآن
                                    <i class="fas fa-clipboard-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-xs-6 col-sm-5 col-xs-offset-4 col-sm-offset-5">{!! $offers->render() !!}</div>
        </div>
    </section>
    <!-- end content -->
@endsection
