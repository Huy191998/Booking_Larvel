@extends('layouts.main')
@section('title','Quản lý khách sạn')
@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title" style="font-size:30px;">Quản lý Khách sạn</h4>
                        </div>
                        <div class="col-md-6" style="margin-left: 300px">
                            {{ Form::open(['route' => ['hotels' ],'method' => 'get']) }}
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
                        @if(Session::has('thongbao'))
                            <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
                                <strong>{{ Session::get('thongbao') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('loi'))
                            <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                                <strong>{{ Session::get('loi') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('thongbaoo'))
                            <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
                                <strong>{{ Session::get('thongbaoo') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                </div>
                <hr>
                <div class="table-responsive" style="margin-top: 2%">
                    <table class="table table-hover ">
                        <thead style="text-align: center;">
                        <tr class="table table-bordered table-danger">
                            <th>STT</th>
                            <th>Tên khách sạn</th>

                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Trạng Thái</th>
                            <th colspan="3">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $hotel as $key => $hotels )
                            <tr class="table table-bordered" style="text-align: center">
                                <td> {{++$key}} </td>
                                <td>{{ $hotels->Name }}</td>
                                <td>{{ $hotels->cities->Name }} {{ $hotels->Address}}</td>

                                <td>{{ $hotels->email}}</td>
                                <td>{{ $hotels->Phone}}</td>
                                <td>
                                    @if($hotels->Status == 0)
                                        <button class="btn btn-sm btn-danger btn-payment" value=""> chưa kích hoạt
                                        </button>

                                    @else

                                        <button class="btn btn-sm btn-success btn-payment" value=""> đã kích hoạt
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($hotels->Status == 0)
                                        <a href="{{route('Hotelsupdate',$hotels->id)}}"
                                           class="btn btn-primary">kích hoạt</a>
                                    @else
                                        <a href="{{route('Hotelsupdate2',$hotels->id)}}"
                                           class="btn btn-primary">Khóa </a>
                                    @endif

                                    <button type="button" class="btn btn-danger deleteUser" data-toggle="modal"
                                            data-target="#Modal" data-id="{{$hotels->id}}">Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="container " style="display: flex;justify-content: center; margin-top: 10px">{{ $hotel->links() }}</div>
            </div>
        </div>
    </div>

    {{Form::open(['route' => 'HotelsDelete', 'method' => 'POST', 'class'=>'col-md-5'])}}
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    @include('Delete.delete')
    {{ Form::close() }}
@endsection
