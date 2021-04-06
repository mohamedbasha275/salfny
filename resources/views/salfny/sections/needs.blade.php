<div class="row">
    @foreach($needs as $need)
        <div class="col-md-4 mb-4 needConto">
            <div class="card">
                <a href="{{ route('showoffer',$need->offer->slug) }}">
                    <img class="card-img-top offer-img" src="{{asset("images/".$need->offer->image)}}" height="235px">
                </a>
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-3 text-right">
                        <a href="{{ route('showoffer',$need->offer->slug) }}" class=" text-warning">{{ $need->offer->name }}</a>
                        <small class="float-left d-inline-flex text-secondary" style="font-size: 13px">
                            <i class="fa fa-clock m-1"></i>
                            {{ $need->created_at->diffForHumans() }}
                        </small>
                    </h5>
                    <p class="card-text text-right">
                        {{$need->offer->description}}
                    </p>
                    <a href="{{ route('showoffer',$need->offer->slug) }}" class="float-right"> المزيد
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                    <a href="{{route('removeneed',$need->id)}}" class="float-left text-warning removeNeed"> تراجع الآن
                        <i class="fas fa-remove"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="col-xs-6 col-sm-5 col-xs-offset-4 col-sm-offset-5">{!! $needs->render() !!}</div>
