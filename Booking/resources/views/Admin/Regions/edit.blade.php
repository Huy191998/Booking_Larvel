@extends('layouts.main')
@section('title','Cập nhập vùng miền')
@section('content')
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Quản lý vùng miền</h4>
                        </div>
                    </div>
                    <!-- title -->
                </div>
                <div class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h5 class="card-title">chỉnh sửa vùng miền</h5>
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
                                        @elseif(Session::has('loi'))
                                            <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                                                <strong>{{ Session::get('loi') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    {{ Form::model($regions,['route' => ['regions.update',$regions->id ],'method' => 'put','enctype '=>'multipart/form-data']) }}

                                    <div class="form-group {{ $errors->has('Name') ?'has-error':'' }}">
                                        {{ Form::label('Tên vùng:') }}
                                        {{ Form::text('Name',$regions->name,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Name')}}</span>
                                    </div>

                                    <div class="form-group {{ $errors->has('Status') ?'has-error':'' }}">
                                        {{ Form::label('Ghi Chú :') }}
                                        {{ Form::text('Status',$regions->Status,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Status')}}</span>
                                    </div>
                                    <div class="modal-footer">
                                    {{form::submit('Chỉnh Sửa',['class'=>'btn btn-primary']) }}
                                    <a style="margin: 10px" href="{{route('regions.index')}} " class="btn btn-success">Trở
                                        về</a>
                                    {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
