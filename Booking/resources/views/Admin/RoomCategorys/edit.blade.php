@extends('layouts.main')
@section('title','Quản lý loại phòng')
@section('content')
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Quản lý loại phòng</h4>
                        </div>

                    </div>
                    <!-- title -->
                </div>
                <div class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h5 class="card-title">Chỉnh sửa loại phòng</h5>
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
                                    {{ Form::model($roomcategorys,['route' => ['roomcategorys.update',$roomcategorys->id ],'method' => 'put']) }}

                                    {{ Form::open(['route' => 'kindrooms.store', 'method' => 'post']) }}
                                    <div class="form-group {{ $errors->has('Name') ?'has-error':'' }}">
                                        {{ Form::label('Loại phòng:') }}
                                        {{ Form::text('Name',$roomcategorys->RoomCategory,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Name')}}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('AmountPeople') ?'has-error':'' }}">
                                        {{ Form::label('Số người:') }}
                                        {{ Form::text('AmountPeople',$roomcategorys->AmountPeople,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('AmountPeople')}}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('Describe') ?'has-error':'' }}">
                                        {{ Form::label('Mô Tả:') }}
                                        {{ Form::text('Describe',$roomcategorys->Describe,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Describe')}}</span>
                                    </div>
                                    <div class="modal-footer">
                                        {{form::submit('Cập nhập',['class'=>'btn btn-primary']) }}
                                        <a style="margin: 10px" href="{{route('roomcategorys.index')}} " class="btn btn-success">Trở
                                            về</a>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
