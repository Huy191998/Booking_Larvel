@extends('layouts.home')
@section('content')
    <div class="container-fluid" style="margin-top: 200px;margin-bottom: 20px">
        @if(count($hotel) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- title -->
                            <div class="d-md-flex align-items-center">
                                <div class="col-md-6">
                                    <h2 class="font-weight-bold">Quản Lý Khách Sạn</h2>
                                </div>
                                <div class="col-md-6" style="margin-left: 350px">
                                    {{ Form::open(['route' => ['hotel.index' ],'method' => 'get']) }}
                                    <form class="form-inline text-right">
                                        <div class="form-group mb-2 col-4" style="float: left;">
                                            <input type="text" name="seachname" class="form-control" id="inputPassword2"
                                                   placeholder="Tìm kiếm...">
                                        </div>
                                        <button type="submit" name="Seach" style="float: left;"
                                                class="btn btn-primary mb-2">Tìm
                                            Kiếm
                                        </button>
                                    </form>
                                    {{ Form::close() }}
                                </div>
                            </div>

                            @if(Session::has('thongdiep'))
                                <div class="alert alert-primary" role="alert">
                                    <p class="">{{Session::get('thongdiep')}}</p>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <div>
                                <a href="{{route('hotel.create')}}" style="margin-left: 10px" class="btn btn-info">Tạo
                                    Khách
                                    Sạn</a>
                            </div>
                            <br>

                            <div class="alert alert-danger" role="alert">
                                <h4 class="card-title text-center" style="font-size:30px;">Chưa có Khách sạn</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <!-- column -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- title -->
                            <div class="d-md-flex align-items-center">
                                <div class="col-md-6">
                                    <h2 class="font-weight-bold">Quản Lý Khách Sạn</h2>
                                </div>
                                <div class="col-md-6" style="margin-left: 350px">
                                    {{ Form::open(['route' => ['hotel.index' ],'method' => 'get']) }}
                                    <form class="form-inline text-right">
                                        <div class="form-group mb-2 col-4" style="float: left;">
                                            <input type="text" name="seachname" class="form-control" id="inputPassword2"
                                                   placeholder="Tìm kiếm...">
                                        </div>
                                        <button type="submit" name="Seach" style="float: left;"
                                                class="btn btn-primary mb-2">Tìm
                                            Kiếm
                                        </button>
                                    </form>
                                    {{ Form::close() }}
                                </div>
                            </div>

                            @if(Session::has('thongbao'))
                                <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                                    <strong>{{ Session::get('thongbao') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @elseif(Session::has('loi'))
                                <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
                                    <strong>{{ Session::get('loi') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(Session::has('xoa'))
                                <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
                                    <strong>{{ Session::get('xoa') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <div>
                                <a href="{{route('hotel.create')}}" style="margin-left: 10px" class="btn btn-info">Tạo
                                    Khách
                                    Sạn</a>
                            </div>
                            <br>
                            <table class="table table-hover ">
                                <thead style="text-align: center;">
                                <tr class="table table-bordered table-danger">
                                    <th>STT</th>
                                    <th>Tên Khách Sạn</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th colspan="3">Thao Tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $hotel as $key => $hotels )
                                    <tr class="table table-bordered text-center">
                                        <td> {{++$key}} </td>
                                        <td>{{ $hotels->Name }}</td>
                                        <td>{{ $hotels->cities->Name }}</td>
                                        <td style="text-align:center;">
                                            @if($hotels->Status== 0)
                                                <a class="btn btn-outline-warning btn-sm"> chưa được kích hoạt</a>
                                            @else
                                                <a class="btn btn-outline-success btn-sm"> đã dược kích hoạt</a>
                                            @endif
                                        </td>
                                        <td style="display: flex;justify-content: center; ">
                                            @if($hotels->Status== 0)

                                            @else
                                                <a href="{{route('hotel.show',$hotels->id)}}"
                                                   class="btn btn-secondary" style="float: left;margin-right: 10px">
                                                    Danh sách phòng
                                                </a>
                                            @endif
                                            <a href="{{route('hotel.edit',$hotels->id)}}"
                                               style="float: left;margin-right: 10px"
                                               class="btn btn-primary">Chỉnh sửa</a>
                                            <a href="{{route('order',$hotels->id)}}"
                                               style="float: left;margin-right: 10px"
                                               class="btn btn-info">Dánh sách đặt phòng</a>
                                            <a href=""
                                               style="float: left;margin-right: 10px"
                                               class="">{{Form::open(['route' => ['hotel.destroy',$hotels->id], 'method' => 'DELETE',])}}
                                                {{form::submit('Xóa',['class'=>'btn btn-danger']) }}
                                                {{ Form::close() }}</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="container "
                             style="display: flex;justify-content: center; margin-top: 20px">{{ $hotel->links() }}</div>
                    </div>
                </div>
            </div>
            {{Form::open(['route' => 'CityDelete', 'method' => 'POST', 'class'=>'col-md-5'])}}
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            @include('Delete.delete')
            {{ Form::close() }}
        @endif
    </div>

@endsection
@section('footer')
    @include('shared.footer')
@endsection


