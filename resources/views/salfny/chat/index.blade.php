@extends('salfny.layouts.layout2')
@section('title')
   المحادثات
@endsection
@section('content')
    <!-- start content -->
    <div class="container-fluid h-100 chatConts">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="input-group">
                        <input type="text" placeholder="ابحث..."  onkeyup="search_chatUsers(this.value, 'result');"
                            class="form-control search_btn ">
                        <div class="input-group-prepend">
                            <span class="input-group-text search"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body scrollbar d-none d-sm-block">
                    <h5 class="ml-2 mb-2 text-white closeMenu d-block d-sm-none">إغلاق</h5>
                    <ul class="contacts" id="userChatList">
                        @foreach ($users as $use)
                            <li>
                                <a href="{{ route('showchat',$use->id) }}">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{ asset('images/'.$use->image()) }}"
                                            class="rounded-circle user_img">
                                            @if(Cache::has('is_online' . $use->id))
                                                <span class="online_icon"></span>
                                            @else
                                                <span class="online_icon offline"></span>
                                            @endif
                                        </div>
                                        <div class="user_info mr-2">
                                            <span>{{ $use->name }}</span>
                                            <p>{{$use->seening}}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer"></div>
            </div></div>
            <div class="col-md-8 col-xl-6 chat">
                <div class="card chatbox">
                   <div style="width: 100px;height: 100px;background-color: #fff;margin: 180px auto;margin-bottom: 10px;border-radius: 50%">
                        <span class="fas fa-comment-dots text-warning" style="margin: 20px;font-size: 60px"></span>
                   </div>
                   <div style="background-color: #fff;margin: 10px auto;border-radius: 10px;padding: 10px">
                    <span class="text-warning" style="font-weight: bold;font-size: 20px">ابدأ المحادثـــة</span>
               </div>
            </div>
        </div>
    </div>
    <!-- end content -->
@endsection
@section('js')
    <script>
       	$(document).ready(function(){
$('#action_menu_btn').click(function(){
	$('.action_menu').toggle();
});
	});
    $('.search_btn').on('focus',function(){
            $('.contacts_body').removeClass('d-none');
        });
        $('.closeMenu').on('click',function(){
            $('.contacts_body').addClass('d-none');
        });
        function search_chatUsers(search_value)
        {
            $('.contacts_body').removeClass('d-none');
            $.ajax({
                url: '{{ route("chat_searching") }}',
                data : {'search':search_value},
                method: 'GET',
                success:function(data) {
                    $('#userChatList').empty();
                    if(data.users.length != 0)
                    {
                        for(var user of data.users)
                        {
                            url = '{{ route("showchat", ":id") }}'.replace(':id',user.id);
                            var html="<li><a href="+url+"><div class='d-flex bd-highlight'><div class='img_cont'>"+
                                "<img src='{{asset('images')}}/"+user.image+"' class='rounded-circle user_img'>"+
                                "<span class='"+user.activenow+"'></span></div><div class='user_info mr-2'><span>"+user.name+"</span>"+
                                " <p>"+user.since+"</p></div></div></a></li>";
                            $('#userChatList').append(html);
                        }
                    }
                    else
                    {
                        var html='<h5 class="text-white text-center m-2"> لا توجد نتائج بحث مشابهة <i class="fab fa-searchengin"></i></h5>';
                        $('#userChatList').append(html);
                    }
                }
            });
        }
    </script>
@endsection
