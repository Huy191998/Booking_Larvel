@extends('layouts.main')
@section('title','Quản lý Slide')
@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title" style="font-size:30px;">Quản lý Slide</h4>
                        </div>
                        <div class="col-md-6" style="margin-left: 300px">
                            {{ Form::open(['route' => ['slide.index' ],'method' => 'get']) }}
                            <form class="form-inline text-right">
                                <div class="form-group mb-2 col-4" style="float: left;">
                                    <input type="text" name="seachname" class="form-control" id="inputPassword2" placeholder="Tìm kiếm...">
                                </div>
                                <button type="submit" name="Seach" style="float: left;" class="btn btn-primary mb-2">Tìm Kiếm</button>
                            </form>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <!-- title -->
                    @if(Session::has('thongbao'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('loi'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                            <strong>{{ Session::get('loi') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                </div>
                <hr>
                <div class="table-responsive">
                    <button type="button"
                            class="btn btn-success text-white no-success d-flex align-items-center"
                            data-toggle="modal" data-target="#ModalCreate"><i class="fa fa-plus-square"></i> <span
                            class="hide-menu m-l-5">Tạo mới</span></button>


                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead style="text-align: center;">
                            <tr class="table table-bordered table-danger">
                                <th>STT</th>
                                <th>Tên Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Ảnh</th>
                                <th colspan="3">Thao Tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $slides as $key => $slide )
                                <tr class="table table-bordered" style="text-align: center">
                                    <td> {{++$key}} </td>
                                    <td>{{ $slide->ct }}</td>
                                    <td>{{$slide->description}}</td>
                                    <td class="text-center">
                                        <img src="{{asset('images/'.$slide->image)}}" width="200" alt="logo">
                                    </td>
                                    <td class="text-center">

                                        <button type="button" class="btn btn-danger deleteUser" data-toggle="modal"
                                                data-target="#Modal" data-id="{{$slide->id}}">Xóa
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="container " style="display: flex;justify-content: center; margin-top: 10px">{{ $slides->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    @include('Admin.slides.create')
    {{Form::open(['route' => 'slideDelete', 'method' => 'POST', 'class'=>'col-md-5'])}}
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    @include('Delete.delete')
    {{ Form::close() }}

@endsection
