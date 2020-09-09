@extends('layouts.main')
@section('title','Cập nhập thành phố')
@section('content')
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Quản lý thành phố</h4>
                        </div>
                    </div>
                    <!-- title -->
                </div>
                <div class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h5 class="card-title">chỉnh sửa thành phố</h5>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        @if(Session::has('thongbao'))
                                            <div id="div-alert" style="position:absolute; right: 10px; top: 70px"
                                                 class="float-right mt-2 alert alert-success alert-dismissible show"
                                                 role="alert" style="position: absolute;">
                                                <strong>{{ Session::get('thongbao') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    {{ Form::model($city,['route' => ['cities.update',$city->id ],'method' => 'put','enctype '=>'multipart/form-data']) }}
                                    <div class="form-group {{ $errors->has('Name') ?'has-error':'' }}">
                                        {{ Form::label('Tên vùng:') }}
                                        {{ Form::text('Name',$city->name,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Name')}}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('Status') ?'has-error':'' }}">
                                        {{ Form::label('Ghi Chú :') }}
                                        {{ Form::text('Status',$city->Status,['class'=>'form-control']) }}
                                        <span class="text-danger">{{$errors->first('Status')}}</span>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Hình ảnh ' ,'Hình ảnh') }}
                                        <input name="images" type="file" class="form-control" >
                                        <span class="text-danger">{{$errors->first('images')}}</span>
                                    </div>
                                    <div class="form-group  {{ $errors->has('region_id') ?'has-error':'' }}">
                                        {{Form::label('Vùng miền:')}}
                                        {{Form::select('region_id',$regions,$city->id,['class' => " form-control",])}}
                                        @if ($errors->has('category_id'))
                                            <div class="text-danger">{{ $errors->first('category_id') }}</div>
                                        @endif
                                        <span class="text-danger">{{$errors->first('region_id')}}</span>
                                    </div>
                                    <div class="modal-footer">
                                    {{form::submit('Chỉnh Sửa',['class'=>'btn btn-primary']) }}
                                    <a style="margin: 10px" href="{{route('cities.index')}} " class="btn btn-success">Trở
                                        về</a>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
