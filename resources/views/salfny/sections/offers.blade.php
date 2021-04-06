<div class="row">
    @foreach($offers as $offer)
        <div class="col-md-4 mb-4">
            <div class="card">
                <a href="{{ route('showoffer',$offer->slug) }}">
                    <img class="card-img-top offer-img" src="{{asset("images/".$offer->image)}}" height="235px">
                </a>
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-3 text-right">
                        <a href="{{ route('showoffer',$offer->slug) }}" class=" text-warning">{{ $offer->name }}</a>
                        <small class="float-left d-inline-flex text-secondary" style="font-size: 13px">
                            <i class="fa fa-clock m-1"></i>
                            {{ $offer->created_at->diffForHumans() }}
                        </small>
                    </h5>
                    <p class="card-text text-right">
                        {{$offer->description}}
                    </p>
                    @if(Auth::user()->id == $offer->user_id)
                        <a href="{{ route('editoffer',$offer->id) }}"  class="float-right text-warning"> تعديل
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" data-delete="{{route('deleteoffer',$offer->id)}}"
                            class="float-left text-danger"> حذف
                            <i class="fa fa-trash-alt"></i>
                        </a>
                    @else
                        <a href="{{ route('showoffer',$offer->slug) }}" class="float-right"> المزيد
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                        <a href="{{route('takeoffer',$offer->id)}}" class="float-left text-success takeOffer"> حجز الآن
                            <i class="fas fa-clipboard-check"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="col-xs-6 col-sm-5 col-xs-offset-4 col-sm-offset-5">{!! $offers->render() !!}</div>
