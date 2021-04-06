@extends('salfny.layouts.layout2')
@section('title')
   العروض
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
                <a href="{{ route('newoffer') }}" class="btn btn-primary">
                    إضافة عرض جديد الآن <span class="fa fa-plus-circle"></span>
                </a>
            </div>
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
                                        <select class="form-control search-slt"
                                         id="exampleFormControlSelect1" name="category">
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
            @include('salfny.sections.offers')
            @if($offers->count() == 0)
                <div class="alert alert-info col-10" style="margin: 0 auto">
                    <h2 class="text-center">لا توجد عروض متاحة حاليا
                        <i class="fa fa-heart-broken"></i>
                    </h2>
                </div>
            @endif
        </div>
    </section>
    <!-- end content -->
@endsection
