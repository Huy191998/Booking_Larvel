@extends('layouts.main')
@section('title','Chi tiết đặt phòng')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title">Chi tiết thông tin đặt phòng</h4>
                        </div>
                        <div class="col-md-6" style="left: 400px">
                            <a href="{{route('bookings')}}"  class="btn btn-primary">Trở về</a>
                            <a href="{{url('/Admin/print-order/'.$bookings->id)}}" target="_blank"
                               class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i> In hóa đơn</a>

                        </div>
                    </div>
                    <!-- title -->
                </div>
                <hr>
                <div class="col-12">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container123  col-md-6" style="">
                                    <h4></h4>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="table table-bordered table-danger">
                                            <th>Thông tin khách hàng đặt phòng</th>
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
                                            <td>{!! Carbon\Carbon::createFromFormat('Y-m-d', $People->Birthday)->format('d.m.Y') !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Tên Tài Khoản</td>
                                            <td>{{ $People->users->name }} </td>
                                        </tr>
                                        <tr>
                                            <td>email</td>
                                            <td>{{ $People->users->email }} </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead style="text-align: center;">
                        <tr class="table table-bordered table-danger">
                            <th>Ngày đặt phòng</th>
                            <th>Ngày nhận phòng</th>
                            <th>Ngày trả phòng</th>
                            <th>Tên khách sạn</th>
                            <th>Hạng phòng</th>
                            <th>Loại phòng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái thanh toán</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table table-bordered" style="text-align: center">
                            <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bookings->book_at)->format('d.m.Y ') !!}</td>
                            <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bookings->in_at)->format('d.m.Y ') !!}</td>
                            <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bookings->out_at)->format('d.m.Y ') !!}</td>
                            <td>{{$bookings->hotels->Name}}</td>
                            <td>{{$bookings->rooms->kindrooms->Name}}</td>
                            <td>{{$bookings->rooms->roomcategory->RoomCategory}}</td>
                            <td>{{ number_format($bookings->total)}} đ</td>

                            <td class="text-center">
                                @if($bookings->payment_status == 1)
                                    <a class="btn btn-outline-danger btn-sm">Chưa thanh toán</a>
                                @else
                                    <a class="btn btn-outline-success btn-sm">Đã thanh toán</a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
