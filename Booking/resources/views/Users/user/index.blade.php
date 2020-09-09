@extends('layouts.home')
@section('content')
    <!-- Home -->
    <div class="container " style="margin-top: 200px;margin-bottom: 20px;margin-bottom: 10px">
        <div class="card border-danger mb-3">
            @if($count == 0)
           
                <div class="card-header ">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item card border-success mb-3">
                            <a class="nav-link disabled" href="#">Cập nhập thông tin tài khoản</a>
                        </li>
                       

                    </ul>
                </div>
                <div class="card-body">
                    @if(Session::has('thongbao'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: -30px "
                             class="float-right mt-2 alert alert-success alert-dismissible show" role="alert"
                             style="position: absolute;">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('loi'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: -30px"
                             class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert"
                             style="position: absolute;">
                            <strong>{{ Session::get('loi') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <br>

                    {!! Form::open(['route'=>'userscreate', 'method'=>'post','enctype '=>'multipart/form-data']) !!}
                    <div class="col-md-6" style="float: left">
                        <div class="form-group {{ $errors->has('first_name') ?'has-error':'' }}">
                            {{ Form::label('Họ:','',['class' => 'font-weight-bold']) }}
                            {{ Form::text('first_name','',['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lats_name') ?'has-error':'' }}">
                            {{ Form::label('Tên:','',['class' => 'font-weight-bold']) }}
                            {{ Form::text('lats_name','',['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('lats_name')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('Birthday') ?'has-error':'' }}">
                            {{ Form::label('Ngày sinh:','',['class' => 'font-weight-bold']) }}
                            {{ Form::date('Birthday','',['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('Birthday')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('Idcard') ?'has-error':'' }}">
                            {{ Form::label('CMDN:','',['class' => 'font-weight-bold']) }}
                            {{ Form::number('Idcard','',['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('Idcard')}}</span>
                        </div>

                    </div>
                    <div class="col-md-6" style="float: left">
                        <div class="form-group {{ $errors->has('phone') ?'has-error':'' }}">
                            {{ Form::label('Số điện thoại:','',['class' => 'font-weight-bold']) }}
                            {{ Form::number('phone','',['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                        <div class="form-group  {{ $errors->has('cyti_id') ?'has-error':'' }}">

                        
                            {{Form::label('Thành phố:','',['class' => 'font-weight-bold'])}}
                            {{Form::select('cyti_id',$cities,null,['class' => " form-control",'placeholder'=>'--------------------------------- Chọn thành phố---------------------------------'])}}                        
       
                            <span class="text-danger">{{$errors->first('cyti_id')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('Address') ?'has-error':'' }}">
                            {{ Form::label('Tên đường:','',['class' => 'font-weight-bold']) }}
                            {{ Form::text('Address','',['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('Address')}}</span>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('Giới tính:','',['class' => 'font-weight-bold']) }}
                            <div class=" " style="margin-top: 10px">
                            
                                {{ Form::label('Nam:','',['class' => 'font-weight-bold']) }}
                                {{ Form::radio('sex', '0' , true) }}
                                {{ Form::label('Nữ:','',['class' => 'font-weight-bold']) }}
                                {{ Form::radio('sex', '1' , false) }}
                           
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer" >
                        {{form::submit('Chỉnh Sửa',['class'=>'btn btn-primary']) }}
                        <a style="margin: 10px" href="{{url('client/')}} " class="btn btn-success">Trở
                            về</a>
                        
                    </div>
                    {{ Form::close() }}
                </div>
            @else
            @foreach( $user as $key => $user )
                <div class="card-header ">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item card border-success mb-3">
                            <a class="nav-link disabled" href="#">Khách Hàng: {{$user->first_name}} {{$user->lats_name}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" href="{{route('user')}}">Thông tin tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="{{route('listorder',$user->id)}}">Lịch sử đặt phòng</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    @if(Session::has('thongbao'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: -30px "
                             class="float-right mt-2 alert alert-success alert-dismissible show" role="alert"
                             style="position: absolute;">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('loi'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: -30px"
                             class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert"
                             style="position: absolute;">
                            <strong>{{ Session::get('loi') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <br>

                    {{ Form::model($user,['route' => ['UserUpdate',$user->id ],'method' => 'put','enctype '=>'multipart/form-data']) }}
                    <div class="col-md-6" style="float: left">
                        <div class="form-group {{ $errors->has('first_name') ?'has-error':'' }}">
                            {{ Form::label('Họ:','',['class' => 'font-weight-bold']) }}
                            {{ Form::text('first_name',$user->first_name,['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lats_name') ?'has-error':'' }}">
                            {{ Form::label('Tên:','',['class' => 'font-weight-bold']) }}
                            {{ Form::text('lats_name',$user->lats_name,['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('lats_name')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('Birthday') ?'has-error':'' }}">
                            {{ Form::label('Ngày sinh:','',['class' => 'font-weight-bold']) }}
                            {{ Form::date('Birthday',$user->Birthday,['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('Birthday')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('Idcard') ?'has-error':'' }}">
                            {{ Form::label('CMDN:','',['class' => 'font-weight-bold']) }}
                            {{ Form::number('Idcard',$user->Idcard,['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('Idcard')}}</span>
                        </div>

                    </div>
                    <div class="col-md-6" style="float: left">
                        <div class="form-group {{ $errors->has('phone') ?'has-error':'' }}">
                            {{ Form::label('Số điện thoại:','',['class' => 'font-weight-bold']) }}
                            {{ Form::number('phone',$user->phone,['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                        <div class="form-group  {{ $errors->has('cyti_id') ?'has-error':'' }}">

                            {{Form::label('Thành phố:','',['class' => 'font-weight-bold'])}}
                            {{Form::select('cyti_id',$cities,$user->id,['class' => " form-control",])}}
                            @if ($errors->has('category_id'))
                                <div class="text-danger">{{ $errors->first('category_id') }}</div>
                            @endif
                            <span class="text-danger">{{$errors->first('cyti_id')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('Address') ?'has-error':'' }}">
                            {{ Form::label('Tên đường:','',['class' => 'font-weight-bold']) }}
                            {{ Form::text('Address',$user->Address,['class'=>'form-control']) }}
                            <span class="text-danger">{{$errors->first('Address')}}</span>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('Giới tính:','',['class' => 'font-weight-bold']) }}
                            <div class=" " style="margin-top: 10px">
                            @if($user->Sex == 0)
                                {{ Form::label('Nam:','',['class' => 'font-weight-bold']) }}
                                {{ Form::radio('sex', '0' , true) }}
                                {{ Form::label('Nữ:','',['class' => 'font-weight-bold']) }}
                                {{ Form::radio('sex', '1' , false) }}
                            @else
                                {{ Form::label('Nam:','',['class' => 'font-weight-bold']) }}
                                {{ Form::radio('sex', '0' , false) }}
                                {{ Form::label('Nữ:','',['class' => 'font-weight-bold']) }}
                                {{ Form::radio('sex', '1' , true) }}
                            @endif
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer" >
                        {{form::submit('Chỉnh Sửa',['class'=>'btn btn-primary']) }}
                        <a style="margin: 10px" href="{{url('client/')}} " class="btn btn-success">Trở
                            về</a>
                        {{ Form::close() }}
                    </div>
                </div>
            @endforeach
            @endif
            
        </div>
    </div>
@endsection
@section('footer')
    @include('shared.footer')
@endsection
