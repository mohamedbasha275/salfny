@extends('salfny.layouts.layout1')
@section('title')
    تسجيل الدخول
@endsection
@section('content')
    <!-- start content -->
    <section id="Login" >
        <div id="logining">
            <div class="container text-center">
                <div class="col-md-6 col-xs-12" id="log">
                    <h1 id="loginh">تسجيل الدخول</h1>
                    <img src="{{asset('images/loginlogo.jpg')}}" class="img-circle" 
                        height="100px" width="100px" style="border-radius: 50%">
                    <p class="lead">بخطوة واحدة يمكنك الدخول</p>
                    <form role="form" method="post" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <div class="row">
                                <i class="fa fa-user-circle col-sm-2 logicon" aria-hidden="true"></i>
                                <input id="email" type="text" class="loginput col-sm-10 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" placeholder="البريد الإلكترونى أو الهاتف..." required autofocus>
                                @error('email')
                                    <span role="alert">
                                        <h5 class="text-white text-center">{{ $message }}</h5>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mt-2">
                                <i class="fa fa-lock col-xs-2 logicon" aria-hidden="true"></i>
                                <input id="password" type="password" class="loginput col-xs-10{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" placeholder="كلمة المرور..." required>
                                @error('password')
                                    <span role="alert">
                                        <h5 class="text-white text-center">{{ $message }}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check col-xs-6 ">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label mr-4" for="remember">
                                    {{ __('تذكرني') }}
                                </label>
                            </div>
                            <div class="col-xs-6"  id="forgetpas">
                                <a href="#">نسيت كلمة المرور ؟؟ </a>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" id="loginsubmit" 
                            class="btn btn-success col" name="loginsubmit" value="دخول">
                        </div>
                        <div class="col-xs-12" id="signsoc">
                            <p class="lead text-center">أو سجل دخول عبر</p>
                            <div class="row">
                                <a href="#" role="button" class="col-sm-5 offset-sm-1 btn btn-lg" id="face">
                                    <i class="fab fa-facebook-square fa-2x">  Facebook</i>
                                </a>
                                <a href="{{ url('/login/google/redirect') }}" role="button" class="col-sm-5 btn btn-lg" id="google">
                                    <i class="fab fa-google-plus-square fa-2x"> Google</i>
                                </a>
                            </div>
                        </div>
                        <div id="notmem">
                            <label class="lead">
                                ليس لديك حساب؟ <a href="{{ route('register') }}">تسجيل الآن</a>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection