@extends('layouts.home')
@section('content')
    <div class="contact_form_section" style="margin-top: 200px;">
        <div class="contact">
            <div class="contact_background" style="background-image:url({{asset('images/contact.png')}})"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact_image">
                        </div>
                    </div>
                    <div class="col-lg-7">

                        <div class="contact_form_container" style="background: linear-gradient(to top right, #FFE8E8, #8d4fff)">

                            <div class="contact_title">Đăng Ký Booking Hotel</div>
                            @if(Session::has('thongdiep'))
                                <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert">
                                    <strong>{{ Session::get('thongdiep') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @elseif(Session::has('err'))
                                <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert">
                                    <strong>{{ Session::get('err') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <hr>
                            {{ Form::open(['route' => 'peoples.store', 'method' => 'post']) }}
                            <div class="col-6" style="float: left;">
                                <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
                                    {{ Form::label('Tên tài khoản :','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::text('name','',['class'=>' form-control']) }}
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('password') ?'has-error':'' }}">
                                    {{ Form::label('Mật khẩu:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::password('password',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('email') ?'has-error':'' }}">
                                    {{ Form::label('Email :','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::email('email','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>

                                <div class="form-group {{ $errors->has('first_name') ?'has-error':'' }}">
                                    {{ Form::label('Họ:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::text('first_name','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('first_name')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('lats_name') ?'has-error':'' }}">
                                    {{ Form::label('Tên:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::text('lats_name','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('lats_name')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('sex') ?'has-error':'' }}">
                                    {{ Form::label('Giới tính:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    <div class=" " style="margin-top: 10px">
                                        {{ Form::label('Nam:','',['class' => 'font-weight-bold ','style'=>'color:black']) }}
                                        {{ Form::radio('Sex', '0' , true) }}
                                        {{ Form::label('Nữ:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                        {{ Form::radio('Sex', '1') }}
                                    </div>
                                    <span class="text-danger">{{$errors->first('sex')}}</span>
                                </div>
                            </div>
                            <div class="col-6" style="float: left;">
                                <div class="form-group {{ $errors->has('Birthday') ?'has-error':'' }}">
                                    {{ Form::label('Ngày sinh:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::date('Birthday','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('Birthday')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('Idcard') ?'has-error':'' }}">
                                    {{ Form::label('CMDN:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::number('Idcard','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('Idcard')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('phone') ?'has-error':'' }}">
                                    {{ Form::label('Số điện thoại :','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::text('phone','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('Address') ?'has-error':'' }}">
                                    {{ Form::label('Tên đường:','',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                    {{ Form::text('Address','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('Address')}}</span>
                                </div>

                                <div class="form-group {{ $errors->has('cyti_id') ?'has-error':'' }}">
                                    {{Form::label('Thành phố:','',['class' => 'font-weight-bold','style'=>'color:black'])}}
                                    {{Form::select('cyti_id',$cities,null,['class' => " form-control",'placeholder'=>'----- Chọn Thành Phố -----'])}}
                                    @if ($errors->has('cyti_id'))
                                        <div class="text-danger">{{ $errors->first('cyti_id') }}</div>
                                    @endif
                                </div>

                                <div style="right: 270px; margin-top: 100px">
                                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                    <br/>
                                    @if($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" style="display:block">
                                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                    @endif
                                </div>


                            </div>


                            <div class="modal-footer" style="">
                                <a href="{{url('client/')}}">
                                    <button type="button" class="btn btn-info">Trở Về</button>
                                </a>
                                {{form::submit('Khởi tạo',['class'=>'btn btn-primary']) }}

                            </div>

                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('footer')
    @include('shared.footer')
@endsection
