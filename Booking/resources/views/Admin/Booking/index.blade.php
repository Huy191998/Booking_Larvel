@extends('layouts.main')
@section('title','Quản lý đặt phòng')
@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title" style="font-size:30px;">Quản lý Đặt phòng</h4>
                        </div>
                        <div class="col-md-6" style="margin-left: 300px">
                            {{ Form::open(['route' => ['bookings' ],'method' => 'get']) }}
                            <form class="form-inline text-right">
                                <div class="form-group mb-2 col-4" style="float: left;">
                                    <input type="text" name="seachname" class="form-control" id="inputPassword2"
                                           placeholder="Tìm kiếm...">
                                </div>
                                <button type="submit" name="Seach" style="float: left;" class="btn btn-primary mb-2">Tìm
                                    Kiếm
                                </button>
                            </form>
                            {{ Form::close() }}
                        </div>
                    </div>
                    @if(Session::has('message'))
                        <div class="alert alert-primary" role="alert">
                            <p class="">{{Session::get('message')}}</p>
                        </div>
                @endif
                <!-- title -->
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead style="text-align: center;">
                        <tr class="table table-bordered table-danger">
                            <th>STT</th>
                            <th>Ngày đặt phòng</th>
                            <th>Ngày nhận phòng</th>
                            <th>Ngày trả phòng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái thanh toán</th>
                            <th colspan="3">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $bookings as $key => $booking )
                            <tr class="table table-bordered" style="text-align: center">
                                <td> {{++$key}} </td>
                                <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $booking->book_at)->format('d.m.Y ') !!}</td>
                                <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $booking->in_at)->format('d.m.Y ') !!}</td>
                                <td>{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $booking->out_at)->format('d.m.Y ') !!}</td>
                                <td>{{ number_format($booking->total)}} đ</td>
                                <td class="text-center">
                                    @if($booking->payment_status == 1)
                                        <a class="btn btn-outline-danger btn-sm">Chưa thanh toán</a>
                                    @else
                                         <a class="btn btn-outline-success btn-sm">Đã thanh toán</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('ShowBookings',$booking->id)}}"
                                       class="btn btn-primary">Chi tiết</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="container " style="display: flex;justify-content: center; margin-top: 10px">{{ $bookings->links() }}</div>
            </div>
        </div>
    </div>


@endsection
