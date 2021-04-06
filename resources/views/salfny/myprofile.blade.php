@extends('salfny.layouts.layout2')
@section('title')
    {{Auth::user()->name}}
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
										<img src="{{asset('images/'.Auth::user()->image())}}" class="img">
									</div>
								</div>
								<div class="profile-content">
									<div class="profile-name">{{ Auth::user()->name }}</div>
                                    <div class="profile-designation">{{ Auth::user()->address }}</div>
                                    <div  class="text-center">
                                        <small class="fa fa-circle text-success text-center"></small>
                                        نشط الآن
                                    </div>
									<ul class="profile-info-list">
										<a href="#posts" class="profile-info-list-item meactive text-right"><i class="fa fa-book"></i>المنشورات</a>
										<a href="#offers" class="profile-info-list-item text-right"><i class="fa fa-handshake"></i>العروض</a>
										<a href="#Needs" class="profile-info-list-item text-right"><i class="fa fa-hand-holding-heart"></i>الطلبات</a>
										<a href="#About" class="profile-info-list-item text-right"><i class="fa fa-user-circle"></i>المعلومات</a>
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
                            <h1>عروضك </h1>
                            <p>
                                العروض التي قمت بمشاركتها مع الآخرين .
                            </p>
                            <a href="{{ route('newoffer') }}" class="btn btn-primary">
                                إضافة عرض جديد الآن <span class="fa fa-plus-circle"></span>
                            </a>
                        </div>
                        <div class="container">
                            @include('salfny.sections.offers')
                        </div>
                    </div>
                    <div class="col-md-8 d-none meTabs" id="Needs">
                        <!-- needs -->
                        <div id="top2" class="m-5">
                            <h1>طلباتك </h1>
                            <p>
                                العروض التي حجزتها من الآخرين .
                            </p>
                        </div>
                        <div class="container">
                            @include('salfny.sections.needs')
                        </div>
                    </div>
					<div class="col-md-8 grid-margin stretch-card d-none meTabs" id="About">
                        <!-- offers -->
                        <div id="top2" class="m-5">
                            <h1>معلوماتك </h1>
                        </div>
                        <div class="container">
                            @include('salfny.sections.information')
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
        $('.profile-info-list-item').on('click',function(){
            $(this).addClass('meactive');
            $(this).siblings().removeClass('meactive');
            var cont=$(this).attr('href');
            $('.meTabs').addClass('d-none');
            $(cont).removeClass('d-none');
        });
        /**********/
        $('#iconnImg').on('click',function(e)
        {
             e.preventDefault();
            $('#profImg').click();
        });
        $('#profImg').on('change',function(event) {

            var output = document.getElementById('profContainerimg');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function()
            {
                    URL.revokeObjectURL(output.src) // free memory
            }
        });
    </script>
@endsection
