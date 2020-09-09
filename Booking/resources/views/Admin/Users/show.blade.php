@extends('layouts.main')
@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Chi tiết thông tin khách hàng</h4>

                        </div>

                    </div>
                    <!-- title -->
                </div>
                <div class="col-12">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container123  col-md-6" style="">
                                    <h4></h4>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="table table-bordered table-danger">
                                            <th>Thông tin khách hàng</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Họ Tên</td>
                                            <td>{{ $People->first_name }} {{ $People->lats_name }}
                                        </tr>
                                        <tr>
                                            <td>Địa Chỉ</td>
                                            <td>{{ $People->Address}}</td>
                                        </tr>

                                        <tr>
                                            <td>Giới Tính</td>
                                            @if($People->Sex == 0)
                                                <td>Nam</td>
                                            @else
                                                <td>Nữ</td>
                                            @endif
                                        </tr>

                                        <tr>
                                            <td>Ngày Sinh</td>
                                            <td>{{ $People->Birthday }} </td>
                                        </tr>
                                        <tr>
                                            <td>Tên Tài Khoản</td>
                                            <td>{{ $People->users->name }} </td>
                                        </tr>
                                        <tr>
                                            <td>email</td>
                                            <td>{{ $People->users->email }} </td>
                                        </tr>
                                        <tr>
                                            <td>Thao Tác</td>
                                            <td>
                                                <button type="button" class="btn btn-danger deleteUser"
                                                        data-toggle="modal" data-target="#Modal"
                                                        data-id="{{$People->users->id}}">Xóa người dùng
                                                </button>
                                                 <a href="{{ route('users')}}" class="btn btn-primary">Trở Về</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    {{Form::open(['route' => 'UsersDelete', 'method' => 'POST', 'class'=>'col-md-5'])}}
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    @include('Delete.delete')
    {{ Form::close() }}
@endsection
