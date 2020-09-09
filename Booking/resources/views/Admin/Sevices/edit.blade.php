@extends('layouts.main')
@section('title','Câp nhập tiện ích')
@section('content')
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Quán lý tiện ích</h4>
                        </div>
                    </div>
                    <!-- title -->
                </div>
                <div class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">

                                    <h5 class="card-title">Tạo khách hàng</h5>

                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        @if(Session::has('thongbao'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                                        @endif
                                    </div>
                                    {{ Form::model($sevices,['route' => ['sevices.update',$sevices->id ],'method' => 'put']) }}
                                    <div class="form-group {{ $errors->has('Name') ?'has-error':'' }}">
                                        {{ Form::label('Tên tiện ích:') }}
                                        {{ Form::text('Name',$sevices->Name,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Name')}}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('Name_icon') ?'has-error':'' }}">
                                        {{ Form::label('Tên ICon:') }}
                                        {{ Form::text('Name_icon',$sevices->Name_icon,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Name_icon')}}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('Describe') ?'has-error':'' }}">
                                        {{ Form::label('Ghi Chú :') }}
                                        {{ Form::text('Describe',$sevices->Describe,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Describe')}}</span>
                                    </div>

                                    <div class="modal-footer">
                                        {{form::submit('Khởi tạo',['class'=>'btn btn-primary']) }}
                                        <a style="margin: 10px" href="{{route('sevices.index')}} " class="btn btn-success">Trở
                                            về</a>

                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
