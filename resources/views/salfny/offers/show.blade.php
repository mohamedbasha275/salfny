@extends('salfny.layouts.layout2')
@section('title')
    {{ $offer->name }}
@endsection
@section('content')
    <!-- start content -->
    <div id="top2" class="m-5">
        <h1>تفاصيل العرض</h1>
        <p>
          نتمتي أن نستطيع مساعدتكم .
        </p>
    </div>
    <div class="container">
          <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="text-warning text-right col-7">{{ $offer->name }}</h3>
                        <small class="text-secondary fa fa-clock col-5 mt-3"> {{ $offer->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="imaging col-md-6" >
                            <img src="{{ asset('images/'.$offer->image) }}" width="100%" height="400px" style="border: 6px solid #dbdcdd;border-radius: 5px;">
                        </div>
                        <div class="details text-right col-md-6 text-secondary mt-3">
                            <div>
                                <label class="fa fa-hand-holding-heart"> اسم المنتج :</label>
                                <h4 class="text-info mr-2"><span class="fa fa-angle-left"></span>
                                     {{ $offer->name }}
                                </h4>
                            </div>
                            <div>
                                <label class="fa fa-user">  صاحب العرض :</label>
                                <h4 class="text-info mr-2"><span class="fa fa-angle-left"></span>
                                    <a href="#">{{ $offer->owner->name }}</a>
                                </h4>
                            </div>
                            <div>
                                <label class="fa fa-cubes"> اسم القسم :</label>
                                <h4 class="text-info mr-2"><span class="fa fa-angle-left"></span>
                                    {{ $offer->category->name }}
                                </h4>
                            </div>
                            <div>
                                <label class="fa fa-map-marker-alt">  المكان :
                                    <small class="mr-5"><a href="#map" class="text-secondary">تحديد علي الخريطة</a></small>
                                </label>
                                <h4 class="text-info mr-2"><span class="fa fa-angle-left"></span>
                                    {{ $offer->place }}
                                </h4>
                            </div>
                            <div>
                                <label class="fa fa-pen"> الوصف :</label>
                                <h5 class="text-info mr-2"><span class="fa fa-angle-left"></span>
                                     {{ $offer->description }}
                                </h5>
                            </div>
                            @if (Auth::user()->id == $offer->user_id)
                                <div class="mt-4">
                                    <a href="#" class="btn btn-warning" role="button">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>
                                    <a href="#" class="btn btn-danger" role="button">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </a>
                                </div>
                            @else
                                <div class="mt-4">
                                    <a href="{{route('takeoffer',$offer->id)}}" class="btn btn-success col-5 takeOffer" role="button">
                                        <i class="fas fa-clipboard-check"></i> حجز الآن
                                    </a>
                                    <button class="btn btn-danger sendOfferReport"
                                            type="button" data-toggle="modal"
                                            data-target=".examplePostModal{{$offer->id}}"
                                            data-text="إرسال بلاغ ( عرض )"
                                            data-id="{{$offer->id}}"
                                            data-offerNotice="{{route('offernotice',$offer->id)}}">
                                        <i class="fas fa-exclamation-triangle"></i> إبلاغ
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <input  type="text" value="{{ $offer->lng }}" id="lng" hidden>
            <input  type="text" value="{{ $offer->lat }}" id="lat" hidden>
            <div id="map" style="height: 500px; margin: 15px 0"></div>
        </div>
    </div>
    <!-- end content -->
@endsection
@section('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0YpRDuzIfOT8cxD5x7jWEqZlliA6UmcU&callback=initMap&libraries=places&v=weekly"defer></script>
    <script >
        function initMap()
        {
            var latitide=document.getElementById('lat').value;
            var langtitude=document.getElementById('lng').value;
            var location= {lat: parseFloat(latitide),lng: parseFloat(langtitude)};
            const image ="{{ asset('images/location.png') }}";
            var map =new google.maps.Map(document.getElementById("map"),{
                zoom: 13,
                center : location,
                scaleControl: true
            });
            new google.maps.Marker({
                position: location,
                map,
                title: "مكان صاحب العرض",
                icon: image
            });
            popup.setMap(map);

        }
    </script>
    <!-- Auto Search Map -->
    <!-- -->
@endsection
