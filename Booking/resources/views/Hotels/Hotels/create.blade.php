@extends('layouts.home')
@section('content')

    <div class="contact_form_section" style="margin-top: 200px;margin-bottom: 100px">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="font-weight-bold" style="color: #ff6238">Tạo Khách Sạn</h2>
                        </div>
                        @if(Session::has('message'))
                            <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                                <strong>{{ Session::get('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(Session::has('err'))
                            <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
                                <strong>{{ Session::get('err') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-body">
                            {{ Form::open(['route' => 'hotel.store', 'method' => 'post','enctype '=>'multipart/form-data']) }}
                            <div class="col-6" style="float: left;">
                                <div class="form-group {{ $errors->has('Name') ?'has-error':'' }}">
                                    {{ Form::label('Tên khách sạn:','',['class' => 'font-weight-bold']) }}
                                    {{ Form::text('Name','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('Name')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('Email') ?'has-error':'' }}">
                                    {{ Form::label('Email:','',['class' => 'font-weight-bold']) }}
                                    {{ Form::text('Email','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('Email')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('Phone') ?'has-error':'' }}">
                                    {{ Form::label('Số Điện Thoại:','',['class' => 'font-weight-bold']) }}
                                    {{ Form::text('Phone','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('Phone')}}</span>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('Hình đại diện :' ,'',['class' => 'font-weight-bold']) }}
                                    <input name="images" type="file" class="form-control" required="true">
                                    <span class="text-danger">{{$errors->first('images')}}</span>
                                </div>
                            </div>
                            <div class="col-6" style="float: left;">
                                <div class="form-group {{ $errors->has('Count_star') ?'has-error':'' }}">
                                    {{ Form::label('Hạng khách sạn :','',['class' => 'font-weight-bold']) }}
                                    <input type="number" name="Count_star" class="form-control" max="5">

                                    <span class="text-danger">{{$errors->first('Count_star')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('city_id') ?'has-error':'' }}">
                                    {{Form::label('Thành phố:','',['class' => 'font-weight-bold'])}}
                                    {{Form::select('city_id',$cities,null,['class' => " form-control",'placeholder'=>'Chọn Thành Phố'])}}
                                    @if ($errors->has('city_id'))
                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
                                    @endif

                                </div>
                                <div class="form-group {{ $errors->has('Address') ?'has-error':'' }}">
                                    {{ Form::label('Tên Đường :','',['class' => 'font-weight-bold']) }}
                                    {{ Form::text('Address','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('Address')}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('description') ?'has-error':'' }}">
                                    {{ Form::label('Mô Tả:','',['class' => 'font-weight-bold']) }}
                                    {{ Form::text('description','',['class'=>'form-control']) }}
                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                </div>
                            </div>
                            <div class="modal-footer" >
                                <a style="margin: 10px" href="{{route('hotel.index')}} " class="btn btn-success">Trở
                                    về</a>
                                {{form::submit('Khởi tạo',['class'=>'btn btn-primary']) }}

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
