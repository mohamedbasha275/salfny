@extends('salfny.layouts.layout2')
@section('title')
    تعديل عرض {{ $offer->name }}
@endsection
@section('content')
    <!-- start content -->
    <div id="top2" class="m-5">
        <h1>تعديل عرض</h1>
        <p>
           سعيدون للغاية بمساعدتك .
        </p>
    </div>
    <section id="createoffer" class="col-12 col-md-5" style="float: right">
        <div class="container">
            <form action="{{ route('updateoffer',$offer->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="input-name">الاسم :</label>
                        <input type="text" class="form-control input-lg" id="input-name"  
                            placeholder="اسم المنتج ...." name="name" value="{{ $offer->name }}">
                        @error('name')
                            <span role="alert">
                                <h5 class="text-white text-danger">{{ $message }}</h5>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-category_id">القسم :</label>
                        <select id="input-category_id" style="padding:0" class="form-control input-lg" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $offer->category_id ? "selected" : "" }}>
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
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="image">
                        <label class="custom-file-label text-center " for="validatedCustomFile">اختر الصورة ...</label>
                        <div class="invalid-feedback"></div>
                        @error('image')
                            <span role="alert">
                                <h5 class="text-white text-danger">{{ $message }}</h5>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <img src="{{ asset('images/'.$offer->image) }}" style="border: 6px solid #dbdcdd;;border-radius: 5px" width="100%" height="300px">
                    </div>
                    <div class="form-group " id="pac-card">
                        <label for="pac-input">المكان :</label>
                        <input type="text" class="form-control input-lg" id="pac-input"
                            placeholder="اختر مكانك ...." name="place" value="{{ $offer->place }}">
                        @error('place')
                            <span role="alert">
                                <h5 class="text-white text-danger">{{ $message }}</h5>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">وصف المنتج :</label>
                        <textarea class="form-control input-lg" rows="3" id="exampleFormControlTextarea1" placeholder="اكتب وصف المنتج ..." name="description">{{ $offer->description }}</textarea>
                        @error('description')
                            <span role="alert">
                                <h5 class="text-white text-danger">{{ $message }}</h5>
                            </span>
                        @enderror
                    </div>
                    <!-- Map -->
                    <input  type="text" value="{{ $offer->lng }}" name="lng" id="lng" hidden>
                    <input  type="text" value="{{ $offer->lat}}" name="lat" id="lat" hidden>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-warning col-12">
                            حفظ التعديل <i class="fa fa-edit"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
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
    </script>
    <!-- Auto Search Map -->
    <!-- -->
@endsection    
