@extends('salfny.layouts.layout2')
@section('title')
    عرض جديد
@endsection
@section('content')
    @if(Session::has('flash_review'))
        <script>
            Swal.fire({
                title:"تم إضافة عرضك بنجاح",
                text:"هل يمكنك ترك رأيك في الخدمة ؟!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#156607',
                cancelButtonColor: '#d08c16',
                confirmButtonText:"نعم",
                cancelButtonText:"ليس الآن"
            }).then(function(e){
                if (e.value == true)
                {
                    $('#reviewModal').modal('show')
                }
            })
        </script>
    @endif
    <!-- start content -->
    <!-- Review Modal-->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-right" id="exampleModalLabel">رأيك في ما يقدمه الموقع</h5>
                    <button type="button" class="close col-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('sendreview')}}" method="post" id="sendReview" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-body">
                        <textarea name="review" class="form-control" required  rows="4" cols="30" style="border:1px solid #d8e5f2;resize: none;" placeholder="ضع رأيك هنا ..">{{ old('review') }}</textarea><br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إرسال الآن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- -->
    <div id="top2" class="m-5">
        <h1>إضافة عرض</h1>
        <p>
           سعيدون للغاية بمساعدتك .
        </p>
    </div>
    <section id="createoffer" class="col-12 col-md-5" style="float: right">
        <div class="container">
            <form action="{{ route('storeoffer') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="form-group">
                    <label for="input-name">الاسم :</label>
                    <input type="text" class="form-control input-lg" id="input-name"
                        placeholder="اسم المنتج ...." name="name" value="{{ old('name') }}">
                    @error('name')
                        <span role="alert">
                            <h5 class="text-white text-danger">{{ $message }}</h5>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input-category_id">القسم :</label>
                    <select id="input-category_id" style="padding:0" class="form-control input-lg" name="category_id">
                        <option value="">-- اختر القسم المناسب --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? "selected" : "" }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span role="alert">
                            <h5 class="text-white text-danger">{{ $message }}</h5>
                        </span>
                    @enderror
                </div>
                <label for="validatedCustomFile">الصورة :</label>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" required id="validatedCustomFile" name="image">
                    <label class="custom-file-label text-center " for="validatedCustomFile">اختر الصورة ...</label>
                    <div class="invalid-feedback"></div>
                    @error('image')
                        <span role="alert">
                            <h5 class="text-white text-danger">{{ $message }}</h5>
                        </span>
                    @enderror
                </div>
                <div class="form-group " id="pac-card">
                    <label for="pac-input">المكان :</label>
                    <input type="text" class="form-control input-lg" id="pac-input"
                        placeholder="اختر مكانك ...." name="place" value="{{ old('place') }}">
                    @error('place')
                        <span role="alert">
                            <h5 class="text-white text-danger">{{ $message }}</h5>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">وصف المنتج :</label>
                    <textarea class="form-control input-lg" rows="3" id="exampleFormControlTextarea1" placeholder="اكتب وصف المنتج ..." name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span role="alert">
                            <h5 class="text-white text-danger">{{ $message }}</h5>
                        </span>
                    @enderror
                </div>
                <!-- Map -->
                <input  type="text" value="{{ old('lng',45.724664) }}" name="lng" id="lng" hidden>
                <input  type="text" value="{{ old('lat',60.158216)}}" name="lat" id="lat" hidden>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-info col-12">
                        أضف الآن <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>
    <p>Click the button to get your coordinates.</p>

    <button onclick="getLocation()">Try It</button>
    <button onclick="initMap()">تحديد يدوي</button>

    <p id="demo"></p>

    <section id="map" class="col-12 col-md-6" style="height: 500px;margin-bottom: 150px"></section>
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
            var map =new google.maps.Map(document.getElementById("map"),{
                zoom: 13,
                center : location,
                scaleControl: true
            });
            var marker = new google.maps.Marker({position: location,map: map});
            // search by place name
            const card = document.getElementById("pac-card");
            const input = document.getElementById("pac-input");
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo("bounds", map);
            autocomplete.setFields([
                "address_components",
                "geometry",
                "icon",
                "name"
            ]);
            const infowindow = new google.maps.InfoWindow();
            autocomplete.addListener("place_changed",function()
            {
                const place = autocomplete.getPlace();
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                // lat and lng
                var lat=document.getElementById("lat");
                var lng=document.getElementById("lng");
                lat.value=place.geometry.location.lat();
                lng.value=place.geometry.location.lng();
                /*************/
                // name of place
                var lo=document.getElementById("submit");
                lo.value=input.value;
            });
            // click on map
            google.maps.event.addListener(map,'click',function(event){
                marker.setMap(null);
                marker = new google.maps.Marker({position: event.latLng,
                    map: map
                });
                var lat=document.getElementById("lat");
                var lng=document.getElementById("lng");
                lat.value=event.latLng.lat();
                lng.value=event.latLng.lng();
                /*************/
                // name of place
                const geocoder = new google.maps.Geocoder();
                const infowindow = new google.maps.InfoWindow();
                geocodeLatLng(geocoder, map, infowindow);
            });
            // name of place
            function geocodeLatLng(geocoder, map, infowindow)
            {
                var latlng = {
                    lat: parseFloat(document.getElementById("lat").value),
                    lng: parseFloat(document.getElementById("lng").value)
                };
                geocoder.geocode(
                    {location: latlng},
                    (results, status) =>
                    {
                        if (status === "OK")
                        {
                            if (results[0])
                            {
                                /*var lo=document.getElementById("submit");
                                lo.value=results[0].formatted_address;*/
                                /*************/
                                //var input=document.getElementById("pac-input");
                                input.value=results[0].formatted_address;
                            }
                            else {window.alert("No results found");}
                        }
                        else {window.alert("Geocoder failed due to: " + status);}
                    }
                );
            };
        }

        var x = document.getElementById("demo");
        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }

        function showPosition(position)
        {
                var myLatLng = {lat: position.coords.latitude, lng: position.coords.longitude};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13,
                    center: myLatLng
                });
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: 'مكانك هنا !'
                });
                // lat and lng
                var lat=document.getElementById("lat");
                var lng=document.getElementById("lng");
                lat.value=position.coords.latitude;
                lng.value= position.coords.longitude;
                /*************/
                // name of place
                const geocoder = new google.maps.Geocoder();
                const infowindow = new google.maps.InfoWindow();
                geocodeLatLng(geocoder, map, infowindow);
        }
        // name of place
        function geocodeLatLng(geocoder, map, infowindow)
        {
            const input = document.getElementById("pac-input");
            var latlng = {
                lat: parseFloat(document.getElementById("lat").value),
                lng: parseFloat(document.getElementById("lng").value)
            };
            geocoder.geocode(
                {location: latlng},
                (results, status) =>
                {
                    if (status === "OK")
                    {
                        if (results[0])
                        {
                            input.value=results[0].formatted_address;
                        }
                        else {window.alert("No results found");}
                    }
                    else {window.alert("Geocoder failed due to: " + status);}
                }
            );
        };

        </script>
    <!-- Auto Search Map -->
    <!-- -->
@endsection
