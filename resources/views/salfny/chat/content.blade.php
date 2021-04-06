@foreach($chats as $chat)
    @if($chat->receiver_id == Auth::user()->id)
        <div class="d-flex justify-content-start mb-4">
            <div class="img_cont_msg">
                <img src="{{asset('images/'.$user->image())}}" class="rounded-circle user_img_msg">
            </div>
            <div class="msg_cotainer">
                {!! nl2br($chat->content) !!}
                <span class="msg_time text-secondary">{{ $chat->created_at->diffForHumans() }}</span>
            </div>
        </div>
        @if($chat->image != null)
            <h4 class="col-xs-7">
                <img src="{{asset("images/".$chat->chatimage)}}"
                     width="240px" height="250px" class="pull-left">
                <small><span class="fa fa-clock-o pull-right">{{ $chat->created_at->diffForHumans() }}</span>
                </small>
            </h4>
        @endif
    @endif
    @if($chat->sender_id == Auth::user()->id)
        <div class="d-flex justify-content-end mb-4">
            <div class="msg_cotainer_send">
                {!! nl2br($chat->content) !!}
                <span class="msg_time_send text-secondary">{{ $chat->created_at->diffForHumans() }}</span>
            </div>
            <div class="img_cont_msg">
                <img src="{{ asset('images/'.Auth::user()->image()) }}" class="rounded-circle user_img_msg">
            </div>
        </div>
        @if($chat->image != null)
            <h4 class="col-xs-7 pull-right">
                <img src="{{asset("images/".$chat->image)}}" class="pull-right"
                     width="240px" height="250px">
                <small><span class="fa fa-clock-o pull-left"> {{ $chat->created_at->diffForHumans() }}</span>
                </small>
            </h4>
        @endif
    @endif
@endforeach