@extends('salfny.layouts.layout2')
@section('title')
   الإشعارات
@endsection
@section('css')
    <style type="text/css">
        .not_seen {background-color: #ffa50040;;}
    </style>
@endsection
@section('content')
    <!-- start content -->
    <section id="notifications" class="col-sm-9" style="margin: 0 auto">
        <div class="container">
            <div class="row">
                <h3 class="col-6 text-right">كل الإشعارات</h3>
                <div class="col-6">
                    <a href="{{route('readallnotfs')}}" class="text-info asreadall">
                        <i class="fa fa-check-square"></i>
                        تمييز كمقروءة
                    </a>
                    <a href="{{route('deleteallnotfs')}}"
                        class="text-danger deletentfs"><i class="fa fa-trash"></i>
                        حذف الكل
                    </a>
                </div>
                <div class="col-sm-12" id="notfsContainer">
                    <hr>
                    @if($notifications->count() == 0)
                        <h4 class="alert alert-success text-right">
                            لا يوجد لديك أي إشعارات حتى الآن
                            <i class="fas fa-bell-slash pull-right"
                               style="margin: 5px 20px"></i>
                        </h4>
                    @endif
                    @foreach($notifications as $notf)
                    <div class="markingbig {{$notf->seen == 0 ? 'not_seen':''}}">
                        <div>
                            <ul class="notification-list">
                                <li style="    text-align: right;
                                list-style-type: none;">
                                    <img src="{{asset('images/'.$notf->reactor->image())}}"
                                        class="rounded-circle" style="float: right" width="60px" height="60px">
                                    <a href="#" class="col-3" style="    font-size: 23px;
                                    text-decoration: none;float-right">{{$notf->reactor->name}}</a>
                                    <p class="col-8 text-secondary" style="float-right;    margin-right: 60px;">
                                        {{$notf->content}}
                                        <small class="text-left" style="margin-right: 10%;">{{$notf->created_at->diffForHumans()}}</small>
                                    </p>
                                    <div class="dropdown meImage meta" style="float: left;    margin: -50px 20px;">
                                        <a class="dropdown-toggle dropdownNotOptions" href="#"
                                            id="dropdownNotOptions{{$notf->id}}" data-notf="{{$notf->id}}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-secondary"></i>
                                        </a>
                                        <div class="dropdown-menu " id="optionsNotContainer{{$notf->id}}"
                                            aria-labelledby="dropdownNotOptions{{$notf->id}}">
                                            @if($notf->seen==0)
                                                <a class="dropdown-item  p-2 text-right asread"
                                                    href="{{route('asreadnotf',$notf->id)}}"
                                                    data-asreadnotff="{{route('asreadnotf',$notf->id)}}">
                                                    <i class="fas fa-check-square"></i> تمييز كمقروء
                                                </a>
                                            @endif
                                            <a class="dropdown-item  p-2 text-right" href="{{route($notf->notfUrl(),$notf->relation_id)}}"
                                                data-asreadnotff="{{route('asreadnotf',$notf->id)}}">
                                                 <i class="fas fa-eye"></i> عرض
                                             </a>
                                             <a class="dropdown-item deletenotf  p-2 text-right"
                                                href="{{route('deletenotf',$notf->id)}}">
                                                 <i class="fas fa-trash"></i> حذف
                                             </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection
@section('js')
    <script type="text/javascript">
        // mark as read
        $(".asread").on('click',function(e){
            e.preventDefault();
            $(this).closest('.markingbig').removeClass('not_seen');
            $(this).remove();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                success: function() {
                    console.log("mark as read");
                }
            })
        });
        // mark all as read
        $(".asreadall").on('click',function(e){
            e.preventDefault();
            $('.markingbig').removeClass('not_seen');
            $(".asread").remove();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                success: function() {
                    console.log("mark all as read");
                }
            })
        });
        // delete
        $(".deletenotf").on('click',function(e){
            e.preventDefault();
            $(this).closest('.markingbig').remove();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                success: function() {
                    console.log("deleted");
                }
            })
        });
        // delete all notifications
        $(".deletentfs").click(function(e) {
            var url=$(this).attr('href');
            Swal.fire({
                title:"Do you sure ?",
                text:"You can't retrieve it !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText:"Delete",
                cancelButtonText:"Cancel"
            }).then(function(e){
                if(e.value == true){
                    window.location.href = url;
                }
            })
        });
    </script>
@endsection

