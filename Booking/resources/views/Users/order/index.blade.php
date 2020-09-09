@extends('layouts.home')
@section('content')
    <!-- Home -->

    <div class="container" style="margin-top: 200px;margin-bottom: 20px;margin-bottom: 10px">
        <div class="card border-danger mb-3 text-center">
            <div class="card-header ">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item card border-success mb-3">
                        <a class="nav-link disabled" href="#">Khách
                            Hàng: {{$peoples->first_name}} {{$peoples->lats_name}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="{{route('user')}}">Thông tin tài khoản</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" href="{{route('listorder',$peoples->id)}}">Lịch sử
                            đặt phòng</a>
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

                <table class="table table-hover ">
                    <thead style="text-align: center;">
                    <tr class="table table-bordered table-danger">
                        <th>STT</th>
                        <th>Khách sạn</th>
                        <th>Loại phòng</th>
                        <th>Hạng phòng</th>
                        <th>Ngày đến</th>
                        <th>Ngày đi</th>
                        <th>Tổng tiền</th>
                        <th>Tình trạng phòng</th>
                        <th>Tình trạng đơn</th>
                        <th>Thao tác</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $bookrooms as $key => $bookroom )
                        <tr class="table table-bordered" style="text-align: center">
                            <td> {{++$key}} </td>
                            <td>{{ $bookroom->hotels->Name }}</td>
                            <td>{{ $bookroom->rooms->roomcategory->RoomCategory }}</td>
                            <td>{{ $bookroom->rooms->kindrooms->Name }}</td>
                            <td>{!! \Carbon\Carbon::parse($bookroom->in_at)->format('d/m/Y')!!}</td>
                            <td>{!! \Carbon\Carbon::parse($bookroom->out_at)->format('d/m/Y')!!}</td>
                            <td>{{ number_format($bookroom->total) }} đ</td>
                            @if($bookroom->Deposit == 1)
                                <td><p class="alert-primary">Đã đặt phòng</p></td>
                            @endif

                            @if($bookroom->Deposit == 2)
                                <td><p class="alert-secondary">Đã nhận phòng</p></td>
                            @endif
                            @if($bookroom->Deposit == 3)
                                <td><p class="alert-warning">Đã trả phòng</p></td>
                            @endif
                            @if($bookroom->payment_status == 1)
                                <td><p class=" alert-primary">chưa thanh toán</p></td>
                            @else
                                <td><p class=" alert-danger">Đã thanh toán</p></td>
                            @endif
                            @if($bookroom->payment_status == 1)
                                <td>
                                    {{ Form::open(['route' => ['OrderDelete',$bookroom->id ],'method' => 'Delete']) }}
                                    {{form::submit('Hủy đặt',['class'=>'btn btn-danger','style'=>'float: left']) }}
                                    {{ Form::close() }}
                                </td>
                            @else
                                <td></td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="container "
                     style="display: flex;justify-content: center; margin-top: 20px">{{ $bookrooms->links() }}</div>
            </div>

        </div>
    </div>


@endsection
@section('footer')
    @include('links.scriptdelete')
    @include('shared.footer')
@endsection
