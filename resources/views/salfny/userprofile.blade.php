@extends('salfny.layouts.layout2')
@section('title')
    {{$user->name}}
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{asset('salfny/css/profile.css')}}"/>
@endsection
@section('content')
    <!-- start content -->
    	<!-- partial -->
		<div class="main-panel">
			<div class="container">
				<div class="row">
					<div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="profile-card">
								<div class="profile-header">
									<div class="cover-image">
										<img src="https://cdn.pixabay.com/photo/2019/10/19/14/16/away-4561518_960_720.jpg" class="img img-fluid">
									</div>
									<div class="user-image">
										<img src="{{asset('images/'.$user->image())}}" class="img">
									</div>
								</div>
								<div class="profile-content">
									<div class="profile-name">{{ $user->name }}</div>
                                    <div class="profile-designation">{{ $user->address }}</div>
                                    <div  class="text-center">
                                        <small class="fa fa-circle text-success text-center"></small>
                                        نشط الآن
                                    </div>
									<ul class="profile-info-list">
										<a href="#posts" class="profile-infom profile-info-list-item meactive text-right"><i class="fa fa-book"></i>المنشورات</a>
										<a href="#offers" class="profile-infom profile-info-list-item text-right"><i class="fa fa-handshake"></i>العروض</a>
                                        <a href="tel:{{$user->phone}}" target="_blank"
                                            class="profile-info-list-item text-right">
                                            <i class="fas fa-mobile-alt"></i>{{$user->phone}}
                                        </a>
                                        <a href="mailto:{{$user->email}}" target="_blank"
                                            class="profile-info-list-item text-right">
                                            <i class="fas fa-envelope"></i>{{$user->email}}
                                        </a>
                                        <a href="{{route('showchat',$user->id)}}"
                                            class="profile-info-list-item text-right">
                                            <i class="fas fa-comments"></i> ابدأ المحادثة
                                        </a>
									</ul>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-md-8 meTabs" id="posts">
                        <!-- posts -->
                        @include('salfny.sections.posts')
                    </div>
                    <div class="col-md-8 d-none meTabs" id="offers">
                        <!-- offers -->
                        <div id="top2" class="m-5">
                            <h1>العروض </h1>
                            <p>
                                العروض التي قام بمشاركتها مع الآخرين .
                            </p>
                        </div>
                        <div class="container">
                            @include('salfny.sections.offers')
                        </div>
                    </div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- main-panel ends -->
@endsection
@section('js')
    <script>
        $('.profile-infom').on('click',function(){
            $(this).addClass('meactive');
            $(this).siblings().removeClass('meactive');
            var cont=$(this).attr('href');
            $('.meTabs').addClass('d-none');
            $(cont).removeClass('d-none');
        });
    </script>
@endsection
