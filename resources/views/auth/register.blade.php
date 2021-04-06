@extends('salfny.layouts.layout1')
@section('title')
    تسجيل عضوية
@endsection
@section('content')
    <!-- start content -->
    <section id="Register" >
        <div id="registering">
            <div class="container text-center">
                <div class="col-md-6 col-xs-12" id="regis">
                    <h1 id="registerh">تسجيل عضوية</h1>
                    <img src="{{asset('images/registerlogo.gif')}}" class="img-circle" 
                        height="100px" width="100px" style="border-radius: 50%">
                    <p class="lead">كل هدفنا كيف نجعلك سعيد</p>
                    <form role="form" method="post" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <div class="row">
                                <i class="fa fa-user col-sm-2 regisicon" aria-hidden="true"></i>
                                <input id="name" type="text" class="registerput col-sm-10 {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" value="{{old('name')}}" placeholder=" الإسم..." required autofocus>
                                @error('name')
                                    <span role="alert">
                                        <h5 class="text-white text-center">{{ $message }}</h5>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mt-2">
                                <i class="fa fa-envelope col-sm-2 regisicon" aria-hidden="true"></i>
                                <input id="email" type="email" class="registerput col-sm-10 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{old('email')}}" placeholder="البريد الإلكترونى..." required autofocus>
                                @error('email')
                                    <span role="alert">
                                        <h5 class="text-white text-center">{{ $message }}</h5>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mt-2">
                                <i class="fa fa-lock col-xs-2 regisicon" aria-hidden="true"></i>
                                <input id="password" type="password" class="registerput col-xs-10{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required placeholder="كلمة المرور...">
                                @error('password')
                                    <span role="alert">
                                        <h5 class="text-white text-center">{{ $message }}</h5>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mt-2">
                                <i class="fa fa-lock col-xs-2 regisicon" aria-hidden="true"></i>
                                <input id="password_confirmation" type="password" class="registerput col-xs-10"
                                       name="password_confirmation" required placeholder="كرر كلمة المرور...">
                            </div>
                            <div class="row mt-2">
                                <i class="fa fa-home col-sm-2 regisicon" aria-hidden="true"></i>
                                <select class="registerput col-sm-10" style="padding: 0" name="address">
                                    <option value="">اختر محافظتك</option>
                                    <option value="qena">قنا</option>
                                    <option value="sohag">سوهاج</option>
                                    <option value="aswan">أسوان</option>
                                    <option value="louxor">الأقصر</option>
                                </select>
                                @error('address')
                                    <span role="alert">
                                        <h5 class="text-white text-center">{{ $message }}</h5>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <i class="fa fa-mobile-alt col-xs-2 regisicon" aria-hidden="true"></i>
                                <input type="tel" class="registerput col-xs-10{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       name="phone" value="{{old('phone')}}" required placeholder="رقم الهاتف...">
                                @error('phone')
                                    <span role="alert">
                                        <h5 class="text-white text-center">{{ $message }}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" id="registersubmit" 
                            class="btn btn-success col" name="registersubmit" value="تسجيل الآن">
                        </div>
                        <div class="col-xs-12" id="signsoc">
                            <p class="lead text-center">أو سجل  عبر</p>
                            <div class="row">
                                <a href="#" role="button" class="col-sm-5 offset-sm-1 btn btn-lg" id="face">
                                    <i class="fab fa-facebook-square fa-2x">  Facebook</i>
                                </a>
                                <a href="#" role="button" class="col-sm-5 btn btn-lg" id="google">
                                    <i class="fab fa-google-plus-square fa-2x"> Google</i>
                                </a>
                            </div>
                        </div>
                        <div id="notmem">
                            <label class="lead">
                                 لدي حساب بالفعل؟ <a href="{{ route('login') }}">دخول الآن</a>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection