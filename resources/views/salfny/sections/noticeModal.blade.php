<!-- Modal Post -->
<div class="modal fade" id="examplePostModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-primary col-10 text-right" id="exampleModalLabel">

                </h3>
                <button type="button" class="close col-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="formModalPost" class="comment-text d-flex align-items-center mt-3"  method="POST"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group text-right">
                        <div class="iq-card-body">
                            <label for="message-text" class="col-form-label">اختر السبب :</label>
                            <br>
                            @foreach(\App\Notice::reason() as $key=>$reason)
                                <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                                    <input type="radio" id="customRadio-{{$key}}" value="{{$key}}"
                                           name="reason" class="custom-control-input bg-primary">
                                    <label class="custom-control-label" for="customRadio-{{$key}}">{{$reason}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="alert bg-white alert-light mt-5" role="alert">
                            <div class="alert alert-warning">لا يجب عليك تقديم بلاغات عشوائية <i class="fa fa-exclamation-triangle"></i></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary">إرسال</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
