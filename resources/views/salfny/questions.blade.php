@extends('salfny.layouts.layout1')
@section('title')
    الأسئلة
@endsection
@section('content')
    <!-- start content -->
    <section id="Question">
        <div id="questioning">
            <div class="container">
                <div class="row col-xs-12" id="conts">
                    <div id="questions" class="text-center">
                        <i class="fa fa-question"></i>
                        <h1>كل الأسئلة التي قد تشغلك !!</h1>
                        <div id="quest1" class="text-right">
                            <h4>ما هو سلفني ?!</h4>
                            <p>
                                سلفني موقع غير مربح الغرض منه مساعدة الناس لبعضهم عن طريق تقديم ما لا تحتاجه لهم .
                            </p>
                        </div>
                        <div id="quest1" class="text-right">
                            <h4>كيف يمكنني المساعدة ?!</h4>
                            <p>كل ما عليك انشاء حساب وسيتم التفعيل تلقائياً وتقوم بنشر ما تريد .</p>
                            <hr>
                        </div>
                        @foreach($questions as $question)
                            <div id="quest1" class="text-right">
                                <h4>{{$question->question}} ?!</h4>
                                <p>{{$question->answer}} .</p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    <div id="makequestion" class="col-sm-offset-1">
                        <form action="{{ route('send_question') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <input class="input-lg  col-xs-10"name="question" id="quest" autocomplete=off
                                   placeholder="ما هو سؤالك ..." required minlength="8" maxlength="100">
                            <input type="submit"  id="sentquest" class="btn btn-success btn-lg" 
                                 name="questionsubmit" value="إرسال">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection