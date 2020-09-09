@extends('layouts.main')
@section('title','Quản lý người dùng')
@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title" style="font-size:30px;">Quản lý Người dùng</h4>
                        </div>
                        <div class="col-md-6" style="margin-left: 300px">
                            {{ Form::open(['route' => ['users' ],'method' => 'get']) }}
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
                    @if(Session::has('thongbao'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                <!-- title -->
                </div>
                <hr>
                <div class="table-responsive" style="margin-top: 10px">
                    <table class="table table-hover ">
                        <thead style="text-align: center;">
                        <tr class="table table-bordered table-danger">
                            <th>STT</th>
                             <th>Tên tài khoản</th>
                            <th>Họ Tên</th>
                            <th>Thành phố</th>
                            <th>Địa chỉ</th>
                            <th colspan="3">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $People as $key => $Peoples )
                            <tr class="table table-bordered" style="text-align: center">
                                <td> {{++$key}} </td>
                                <td>{{$Peoples->users->name}}</td>
                                <td>{{ $Peoples->first_name }} {{ $Peoples->lats_name }}</td>
                                <td>{{ $Peoples->cities->Name}}</td>
                                <td>{{$Peoples->Address}}</td>
                                <td class="text-center">
                                    <a href="{{route('ShowPeople',$Peoples->id)}}"
                                       class="btn btn-primary">Chi tiết</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="container " style="display: flex;justify-content: center; margin-top: 10px">{{ $People->links() }}</div>
            </div>
        </div>
    </div>


@endsection
