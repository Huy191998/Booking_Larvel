@extends('layouts.home')
@section('content')
    <div class="container-fluid" style="margin-top: 200px;margin-bottom: 20px">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6" style="float: left">
                        <h2 class="font-weight-bold">Chi tiết đặt phòng</h2>
                    </div>
                    <div class="col-md-6" style="float: left; left: 480px">
                        <a href="{{route('hotel.index')}}" class="btn btn-secondary"> Trở về</a>
                        <a href="{{url('/Hotels/print-orders/'.$bookrooms->id)}}" target="_blank"
                           class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i> In Hóa Đơn</a>
                    </div>


                </div>

                <div class="card-body">
                    @if(Session::has('thongbao'))
                        <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('loi'))
                        <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert">
                            <strong>{{ Session::get('loi') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <br>
                    <div class="row">
                        <div class="table-responsive">
                            <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="container123  col-md-6" style="">
                                            <h4></h4>
                                            <table class="table table-bordered">
                                                <thead class="table table-bordered table-danger">
                                                <tr class="table table-bordered table-danger">
                                                    <th>Thông tin khách hàng</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Tên người đặt</td>
                                                    <td>{{ $bookrooms->peoples->first_name }} {{ $bookrooms->peoples->lats_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ</td>
                                                    <td>{{ $bookrooms->peoples->cities->Name }} {{ $bookrooms->peoples->Address }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td>{{ $bookrooms->peoples->phone }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>{{ $bookrooms->peoples->users->email }} </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-header">
                                            <h4 class="font-weight-bold">thông tin đặt phòng</h4>
                                        </div>
                                        <table id="myTable" class="table table-bordered table-hover dataTable">
                                            <thead class="table table-bordered table-danger">
                                            <tr style="text-align: center">
                                                <th>Loại Phòng</th>
                                                <th>Hạng Phòng</th>
                                                <th>Ngày đặt</th>
                                                <th>Ngày đến</th>
                                                <th>Ngày đi</th>
                                                <th>Số người kê thêm</th>
                                                <th>Tổng tiền</th>
                                                <th>Tình trạng đơn</th>
                                                <th>Tình trạng phòng</th>
                                                <th>Thao tác</th>
                                            </thead>
                                            <tbody>
                                            <tr style="text-align: center">
                                                <td>{{ $bookrooms->rooms->roomcategory->RoomCategory }}</td>
                                                <td>{{ $bookrooms->rooms->kindrooms->Name }}</td>
                                                <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bookrooms->book_at)->format('d.m.Y') !!}</td>
                                                <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bookrooms->in_at)->format('d.m.Y ') !!}</td>
                                                <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bookrooms->out_at)->format('d.m.Y ') !!}</td>
                                                <td>{{ $bookrooms->Deposit }} Người</td>
                                                <td>{{ number_format($bookrooms->total) }} đ</td>
                                                @if($bookrooms->Deposit == 1)
                                                    <td><p class="alert-primary">Đã đặt phòng</p></td>
                                                @endif

                                                @if($bookrooms->Deposit == 2)
                                                    <td><p class="alert-secondary">Đã nhận phòng</p></td>
                                                @endif
                                                @if($bookrooms->Deposit == 3)
                                                    <td><p class="alert-warning">Đã trả phòng</p></td>
                                                @endif
                                                @if($bookrooms->payment_status == 2)
                                                    <td><a class="btn btn-outline-success btn-sm">Đã thanh toán</a></td>
                                                @else
                                                    <td><a class="btn btn-outline-danger btn-sm">Chưa thanh toán</a>
                                                    </td>
                                                @endif

                                                @if($bookrooms->payment_status == 1)
                                                    <td><a href="{{route('uporder',$bookrooms->id)}}"

                                                           class="btn btn-primary">Thanh toán</a></td>
                                                @else
                                                    <td><a href="{{route('hotel.index')}} " class="btn btn-success">Trở
                                                            về khách sạn</a></td>
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{ Form::model($bookrooms,['route' => ['upDeposit',$bookrooms->id ],'method' => 'put','enctype '=>'multipart/form-data']) }}
                                    <div class="form-group col-6">
                                        <label class="col-5 font-weight-bold"><h4>Cập nhập trạng thái phòng</h4></label>
                                        <select class="form-control" name="Deposit">
                                            <option value="1">Đã Đặt Phòng</option>
                                            <option value="2">Đã nhập Phòng</option>
                                            <option value="3">Đã Trả phòng</option>

                                        </select>
                                    </div>
                                    {{form::submit('cập nhập',['class'=>'btn btn-primary','style'=>'margin-left: 20px']) }}
                                    {{ Form::close() }}

                                </div>

                            </div>
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
