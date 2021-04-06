<div class="card text-right">
    <div class="card-body">
        <p class="card-title font-weight-bold">معلوماتي</p>
        <hr>
        <p class="card-description">المعلومات الشخصية</p>
        <form action="{{ route('updateprofile') }}" class="col-12" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <div style="width: 150px;height: 150px;border-radius: 50%;overflow: hidden;float: left">
                    <img src="{{asset('images/'.Auth::user()->image())}}"
                         width="100%" height="100%" id="profContainerimg">
                </div>
                <a href="#" id="iconnImg" style="margin: -20px 5px;float: left;clear: left;color: orange;">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <input type="file" id="profImg" hidden name="image">
            </div>
            <div class="form-group" style="clear: both">
                <label for="input-name">الاسم : </label>
                <input type="text" class="form-control input-lg" id="input-name"
                       placeholder="الاسم ...." name="name" value="{{Auth::user()->name}}">
                @error('name')
                <span role="alert">
                        <h5 class="text-white text-danger">{{ $message }}</h5>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="input-phone">الهاتف : </label>
                <input type="tel" class="form-control input-lg" id="input-phone"
                       placeholder="الهاتف ...." name="phone" value="{{Auth::user()->phone}}">
                @error('phone')
                <span role="alert">
                        <h5 class="text-white text-danger">{{ $message }}</h5>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="input-email">البريد : </label>
                <input type="email" class="form-control input-lg" id="input-email"
                       placeholder="البريد ...." name="email" value="{{Auth::user()->email}}">
                @error('email')
                <span role="alert">
                        <h5 class="text-white text-danger">{{ $message }}</h5>
                    </span>
                @enderror
            </div>
            <div class="form-group " id="pac-card">
                <label for="input-address">المحافظة :</label>
                <select id="input-address" style="padding:0" class="form-control input-lg" name="address">
                    <option value="">اختر محافظتك</option>
                    <option value="qena" {{ Auth::user()->address == 'qena' ? "selected" : "" }}>قنا</option>
                    <option value="sohag" {{ Auth::user()->address == 'sohag' ? "selected" : "" }}>سوهاج</option>
                    <option value="aswan" {{ Auth::user()->address == 'aswan' ? "selected" : "" }}>أسوان</option>
                    <option value="louxor" {{ Auth::user()->address == 'louxor' ? "selected" : "" }}>الأقصر</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary col-12">
                    حفظ التعديلات <i class="fa fa-save"></i>
                </button>
            </div>
        </form>
    </div>
</div>
