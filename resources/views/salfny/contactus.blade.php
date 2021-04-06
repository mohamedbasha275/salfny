@extends('salfny.layouts.layout1')
@section('title')
    اتصل بنا
@endsection
@section('content')
    <!-- start content -->
    <section id="Contact" class="text-center">
        <div id="contactus">
            <div class="container">
                <i class="fa fa-eye-slash"></i>
                <h1 class="text-success">اتصل بنا </h1>
                <p class="lead">نحن في إنتظار مقترحاتكم لتقديم أفضل ما لدينا .</p>
                <form action="{{ route('send_message') }}"
                    method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <h2 class="text-right onestep">كن علي بعد خطوة واحدة منا</h2>
                            <hr>
                            <h3 class="text-left text-info text-right" id="contacinfo">معلومات الاتصال :</h3>
                            <div id="info-detail" class="text-right">
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar"></i>
                                        <span> يومياً :</span> 09:00 ص ل 10:00 م
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker-alt"></i>
                                        <span> العنوان :</span> قنا , شارع المحطة
                                    </li>
                                    <li>
                                        <i class="fa fa-mobile-alt"></i>
                                        <span> الهاتف :</span> <a href="tel:+2001063981560" class="text-white">200106398160+</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        <span> البريد :</span> <a href="salfny2020@gmail.com" class="text-white">salfny2020@gmail.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class=" col-xs-12 col-sm-6">
                            <h2>إرسل لنا رسالة</h2>
                            <hr>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" value="{{ old('contactuser') }}"
                                    name="contactuser" placeholder="ادخل الإسم ..." autocomplete>
                                   @error('contactuser')
                                        <span role="alert">
                                            <h5 class="text-white text-center">{{ $message }}</h5>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control input-lg" value="{{ old('contactmail') }}"
                                       name="contactmail" placeholder="ادخل البريد..." autocomplete="email">
                                    @error('contactmail')
                                       <span role="alert">
                                           <h5 class="text-white text-center">{{ $message }}</h5>
                                       </span>
                                   @enderror
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control input-lg" value="{{ old('contactphone') }}"
                                       name="contactphone" placeholder="ادخل الهاتف...." autocomplete="phone">
                                    @error('contactphone')
                                       <span role="alert">
                                           <h5 class="text-white text-center">{{ $message }}</h5>
                                       </span>
                                   @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control input-lg" value="{{ old('contactmessage') }}" name="contactmessage" placeholder="اكتب رسالتك ..."></textarea>
                                @error('contactmessage')
                                       <span role="alert">
                                           <h5 class="text-white text-center">{{ $message }}</h5>
                                       </span>
                                @enderror
                            </div>
                            <div class="row">
                                <input type="submit" class="btn btn-info btn-lg col-5 mr-4" name="contactsubmit" value="إرسال">
                                <button type="reset" class="btn btn-danger btn-lg col-5 mr-4">إسترجاع</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-xs-12 mt-5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7162.472767261726!2d32.72714103693458!3d26.156429965982905!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x144eb6222d46cbff%3A0x28aa958f05b608d2!2z2YXYs9iq2LTZgdmJINin2YTZh9mE2KfZhCDYp9mE2KPYrdmF2LE!5e0!3m2!1sar!2seg!4v1593428751675!5m2!1sar!2seg"
                            width="100%" height="500" frameborder="0" style="border:2px solid #fff;" allowfullscreen=""></iframe>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </section>
    <!-- end content -->
@endsection
