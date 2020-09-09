@extends('layouts.home')
@section('content')

    {{ Form::open(['route' => 'peoples.store', 'method' => 'post']) }}
    <div class="col-5" style="float: left;">
        <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
            {{ Form::label('Tên tài khoản :','',['class' => 'font-weight-bold') }}
            {{ Form::text('name','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('password') ?'has-error':'' }}">
            {{ Form::label('Mật khẩu:','',['class' => 'font-weight-bold']) }}
            {{ Form::password('password',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('last_name') ?'has-error':'' }}">
            {{ Form::label('Email :','',['class' => 'font-weight-bold']) }}
            {{ Form::email('email','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('last_name') ?'has-error':'' }}">
            {{ Form::label('Số điện thoại :','',['class' => 'font-weight-bold']) }}
            {{ Form::email('phone','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
            {{ Form::label('Họ:','',['class' => 'font-weight-bold']) }}
            {{ Form::text('first_name','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
            {{ Form::label('Tên:','',['class' => 'font-weight-bold']) }}
            {{ Form::text('lats_name','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
    </div>
    <div class="col-5" style="float: left;">
        <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
            {{ Form::label('Ngày sinh:','',['class' => 'font-weight-bold']) }}
            {{ Form::date('Birthday','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
            {{ Form::label('CMDN:','',['class' => 'font-weight-bold']) }}
            {{ Form::number('Idcard','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
            {{ Form::label('Giới tính:','',['class' => 'font-weight-bold']) }}
            {{ Form::label('Nam:','',['class' => 'font-weight-bold']) }}
            {{ Form::radio('sex', '0' , true) }}
            {{ Form::label('Nữ:','',['class' => 'font-weight-bold']) }}
            {{ Form::radio('sex', '1' , false) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ?'has-error':'' }}">
            {{ Form::label('Tên đường:','',['class' => 'font-weight-bold']) }}
            {{ Form::text('Address','',['class'=>'form-control']) }}
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>

        <div class="form-group">
            {{Form::label('Thành phố:','',['class' => 'font-weight-bold'])}}
            {{Form::select('cyti_id',$cities,null,['class' => " form-control",'placeholder'=>'------------ Chọn thành phố ------------'])}}
            @if ($errors->has('cyti_id'))
                <div class="text-danger">{{ $errors->first('cyti_id') }}</div>
            @endif
        </div>
    </div>




    <div class="modal-footer" style="float: left;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
        {{form::submit('Khởi tạo',['class'=>'btn btn-primary']) }}

    </div>
    {{ Form::close() }}


@endsection
