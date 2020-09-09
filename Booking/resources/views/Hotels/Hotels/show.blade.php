@extends('layouts.home')
@section('content')
    @include('links.bootstrap')
    <div class="container-fluid" style="margin-top: 200px;margin-bottom: 20px">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold">Quản lý phòng khách sạn</h2>
                </div>
                <div class="card-body">
                    <a href="{{route('rooms.edit',$hotel->id)}}" style=""
                       class="btn btn-info">Tạo Phòng</a>
                    <a style="margin: 10px" href="{{route('hotel.index')}} " class="btn btn-success">Trở về khách
                        sạn</a>

                    <br>

                    @if(Session::has('thongbao'))
                        <div id="div-alert" style="position:absolute; right: 10px;top: -30px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('err'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: -30px" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
                            <strong>{{ Session::get('err') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(count($rooms) == 0)
                        <div class="container-fluid">
                            <div class="col-12" style="">
                                <h3 class="col-12" style="text-align: center;">Chưa có phòng nào</h3>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <table class="table table-hover ">
                                <thead style="text-align: center;">
                                <tr class="table table-bordered table-danger">
                                    <th style="text-align:center;" class="border-top-0">STT</th>
                                    <th style="text-align:center;" class="border-top-0">Hạng Phòng</th>
                                    <th style="text-align:center;" class="border-top-0">Loại Phòng</th>
                                    <th style="text-align:center;" class="border-top-0"> Giá</th>
                                    <th style="text-align:center;" class="border-top-0">Thao tác</th>
                                </tr>
                                </thead>
                                @foreach( $rooms as $key => $room )
                                    <tr class="table table-bordered ">
                                        <td style="text-align:center;">{{ ++$key }}</td>
                                        <td style="text-align:center;">{{ $room->kindrooms->Name }}</td>
                                        <td style="text-align:center;">{{ $room->roomcategory->RoomCategory }}</td>
                                        <td style="text-align:center;">{{ number_format($room->rates)}} đ</td>
                                        <td style="display: flex;justify-content: center; ">
                                            <a href="{{route('editrooms',$room->id)}}"
                                               style="float: left;margin-right: 10px"
                                               class="btn btn-primary">chỉnh sửa</a>
                                            {{Form::open(['route' => ['rooms.destroy',$room->id], 'method' => 'DELETE',])}}
                                            {{form::submit('Xóa',['class'=>'btn btn-danger']) }}
                                            {{ Form::close() }}

                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
                <div class="container "
                     style="display: flex;justify-content: center; margin-top: 20px">{{ $rooms->links() }}</div>
            </div>
        </div>

    </div>
@endsection
@section('footer')
    @include('shared.footer')
@endsection
