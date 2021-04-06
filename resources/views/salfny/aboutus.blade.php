@extends('salfny.layouts.layout1')
@section('title')
    من نحن
@endsection
@section('content')
    <!-- start content -->
    <!-- start about -->
    <section id="about">
        <div class="container">
            <h1 class="text-center">من نحن</h1>
            <div class="row">
                <div class="col-md-4" id="smallmap">
                    <div id="head">
                        <h4 class="text-center">من نحن ؟؟</h4>
                    </div>
                    <div id="body" class="text-right">
                        <ul>
                            <li><a href="#abouthist">من نحن</a></li>
                            <li><a href="#features">خدماتنا</a></li>
                            {{--<li><a href="#team">فريقنا</a></li>--}}
                            <li><a href="#skilling">مهراتنا</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 text-right" id="abouthist">
                    <h5>JUNE,26 2019</h5>
                    <img src="{{asset('images/aboutimg.jpg')}}"   style="width: 100%">
                    <h3>من نحن وماذا نقدم ؟؟!</h3>
                    <p id="alltextabout">
                        نحن مجموعة من الشباب ظهرت فكرة مساعدة الغير عن طريق موقع إلكتروني
                        من خلاله يقوم المستخدمين بعرض منتجات لما يعدوا يستخدمونها او تزيد عن استخدامهم,
                        او يتم تبادل تلك الأشياء أفضل من شرائها مرة أخري مثل الكتب والملخصات و...الخ.
                        كل هدفنا هو كيفية مساعدة الآخرين دون أى عائد مادي أو إنتظار ربح كما تم توفير شات بين
                        المستخدمين لسهولة الوصول وأيضا المكان الذي تم عرض المنتج منه لوصوله لمستخدمين الجوار
                        كل ما نتمناه المشاركة الفعالة ومساعدة الآخرين بشكل جيد .
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end about -->
    <!-- start features -->
    <section id="features">
        <div class="container text-center">
            <h1>خدماتنا</h1>
            <p class="laed">بعض المعلومات عن ما نقدمه</p>
            <div class="row">
                <div class="col-md-4 col-sm-6 text-center featureic">
                    <i class="fa fa-globe"></i>
                    <h3>الوصول</h3>
                    <p> سهولة الوصول بين المستخدمين عن طريق الموقع كما تم الحفاظ علي جعله مناسب
                        للعرض من خلال شاشات الهواتف الذكية .
                    </p>
                </div>
                <div class="col-md-4 col-sm-6 text-center featureic">
                    <i class="fa fa-users"></i>
                    <h3>مشاركة المستخدمين</h3>
                    <p>نحاول بشكل كبير العمل على نطاق أكبر من المستخدمين لزيادة نسبة المشاركة والتعاون
                        بين بعضهم البعض .
                    </p>
                </div>
                <div class="col-md-4 col-sm-6 text-center featureic">
                    <i class="fas fa-smile"></i>
                    <h3>هدفنا</h3>
                    <p>نحاول جاهدين علي إرضاء جميع المستخدمين ومساعدتهم وتوفير أسهل وأنسب الوسائل التى
                        تسهل عليه التواصل معنا ومع الأخرين .
                    </p>
                </div>
                <div class="col-md-4 col-sm-6 text-center featureic">
                    <i class="fas fa-handshake"></i>
                    <h3>المجانية</h3>
                    <p> كل ما يتم في الموقع فهو بشكل مجاني وبغرض التعاون والمساعدة ولن يتم طلب أى مبالغ 
                        مالية مقابل أي تعامل .
                    </p>
                </div>
    
                <div class="col-md-4 col-sm-6 text-center featureic">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>مستخدمين الجوار</h3>
                    <p> تم توفير الأماكن التى تم عرض منها المنتجات وذلك لوصول المستخدمين الذين في نطاق 
                        هذه الأماكن وذلك لسهولة الوصول .
                    </p>
                </div>
                <div class="col-md-4 col-sm-6 text-center featureic">
                    <i class="fa  fa-envelope"></i>
                    <h3>التواصل مع الأخرين</h3>
                    <p> للتواصل بين المستخدمين ستتوافر معلومات عارض المنتج مثل البريد والهاتف والعنوان 
                        كما يمكنك متابعته من خلال الدردرشة .
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end features -->
    <!-- start skills -->
    <section id="skills">
        <div class="container text-center">
            {{--<div id="team" class="col-xs-12">
                <h1>OUR TEAM</h1>
                <div class="col-sm-4 col-xs-12">
                    <div class="person">
                        <img src="{{asset('salfny/img/used/review1.jpg')}}" width="80%">
                        <div class="person-content">
                            <h4>Johnathan Doe</h4>
                            <h5 class="role">The Mastermind</h5>
                            <p>Fusce dapibus, tellus ac cursus commodo, tortor
                                mauris condimentum nibh, ut fermentum massa justo sit amet risus. </p>
                        </div>
                        <ul class="social-icons clearfix">
                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="person">
                        <img src="{{asset('salfny/img/used/review4.jpg')}}" width="80%">
                        <div class="person-content">
                            <h4>Lisa Brown</h4>
                            <h5 class="role">CREATIVE HEAD</h5>
                            <p>Fusce dapibus, tellus ac cursus commodo, tortor
                                mauris condimentum nibh, ut fermentum massa justo sit amet risus. </p>
                        </div>
                        <ul class="social-icons clearfix">
                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="person">
                        <img src="{{asset('salfny/img/used/review3.jpg')}}" width="80%">
                        <div class="person-content">
                            <h4>Mike Collins</h4>
                            <h5 class="role">TECHNICAL LEAD</h5>
                            <p>Fusce dapibus, tellus ac cursus commodo, tortor
                                mauris condimentum nibh, ut fermentum massa justo sit amet risus. </p>
                        </div>
                        <ul class="social-icons clearfix">
                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>--}}
            <div class="row mb-5">
                <div id="skilling" class="col-md-5 text-right">
                    <h1 class="text-center">مهارتنا</h1>
                    {{--<div id="skil-progress" class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success " role="progressbar"
                                 aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" 
                                 style="width: 85%">Visting</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                 aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">Helping</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger " role="progressbar"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">Contacting</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">Reaching</div>
                        </div>
                    </div>--}}
                    <div class="progress">
                        <div class="progress-bar bg-warning text-center" role="progressbar" 
                            style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                            %85 زيارات
                        </div>
                    </div>
                    <br>
                    <div class="progress">
                        <div class="progress-bar bg-success text-center" role="progressbar" 
                            style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                            %90 مساعدات
                        </div>
                    </div>
                    <br>
                    <div class="progress">
                        <div class="progress-bar bg-info text-center" role="progressbar" 
                            style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            %100 مجانية
                        </div>
                    </div>
                </div>
                <div id="skillinfo" class="col-md-5">
                    <h1 class="text-center">عن فريقنا</h1>
                    <p class="lead text-right">
                        نحاول بذل قصاري جهدنا في توفير كل شئ ومساعدة الآخرين 
                        معاً نستطيع حل المشكلات التي تواجهنا وفريق العمل يحاول جاهداً لتوفير ذلك دون وجود 
                        صعوبات وعن طريق تسهيل الخدمات للمستخدمين .
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end skills -->
    <!-- end content -->
@endsection