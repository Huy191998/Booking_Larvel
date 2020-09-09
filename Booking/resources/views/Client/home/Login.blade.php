@extends('layouts.home')
@section('content')
    <div class="contact_form_section" style="margin-top: 200px">
        <div class="contact">
            <div class="contact_background" style="background-image:url({{asset('images/contact.png')}})"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact_image">
                        </div>
                    </div>

                    <div class="col-lg-7">

                        <div class="contact_form_container"
                             style="background: linear-gradient(to top right, #FFE8E8, #8d4fff)">
                            <div class="contact_title">Đăng nhập</div>
                            <span style="color: white">Đăng nhập Booking Hotel để trải nghiệm</span>
                            <hr>
                            {{ Form::open(['route' => 'checklogin', 'method' => 'post']) }}
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
                                {{ Form::label('name','Tên Tài khoản:',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                {{ Form::text('name','',['class'=>'form-control']) }}
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group {{ $errors->has('password') ?'has-error':'' }}">
                                {{ Form::label('name','Mật khẩu:',['class' => 'font-weight-bold','style'=>'color:black']) }}
                                {{ Form::password('password',['class'=>'form-control']) }}
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            </div>
                            @if(Session::has('error'))
                                <div id="div-alert" style="position:absolute; right: 10px; top: 70px"
                                     class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert"
                                     style="position: absolute;">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <hr>


                            <div class="form-group">
                                <div class="form-group">
                                    {{form::submit('Đăng Nhập',['class'=>'btn  btn-danger','style' => 'width:257px']) }}
                                    <a class="font-weight-bold" style="color: #0b0b0b">Or</a>
                                    <a style="width: 257px " href="{{url('client/peoples/create')}}"
                                       class="btn btn-success">Đăng
                                        Ký</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{route('redirect',['facebook'])}}" class="btn btn-block btn-primary">
                                    <i class="fa fa-facebook-official"> Đăng nhập bằng facebook</i>
                                </a>
                            </div>
                            {{ Form::close() }}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    @include('shared.footer')
@endsection
