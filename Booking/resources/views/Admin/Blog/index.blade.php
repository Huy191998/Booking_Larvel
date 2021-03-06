@extends('layouts.main')
@section('title','Quản lý Blog')
@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title" style="font-size:30px;">Quản lý Blog</h4>
                        </div>
                        <div class="col-md-6" style="margin-left: 300px">
                            {{ Form::open(['route' => ['blog.index' ],'method' => 'get']) }}
                            <form class="form-inline text-right">
                                <div class="form-group mb-2 col-4" style="float: left;">
                                    <input type="text" name="seachname" class="form-control" id="inputPassword2" placeholder="Tìm kiếm...">
                                </div>
                                <button type="submit" name="Seach" style="float: left;" class="btn btn-primary mb-2">Tìm Kiếm</button>
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
                    <a class="btn btn-success" href="{{route('blog.create')}}"><i class="fa fa-plus-square"></i> Tạo Mới Blog</a>
                    <table class="table table-hover ">
                        <thead style="text-align: center;">
                        <tr class="table table-bordered table-danger">
                            <th>STT</th>
                            <th>Tiêu Đề</th>
                            <th>Ảnh</th>
                            <th>Nội Dung</th>
                            <th colspan="3">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blog as $key => $blogs)
                            <tr class="table table-bordered ">
                                <td> {{++$key}} </td>
                                <td>{!!$blogs->title!!}</td>
                                <td><img style="width: 150px; height: 150px" src="{{asset('images/')}}/{{$blogs->images}}"></td>
                                <td>{!! Str::limit($blogs->ct,100,'...')!!}</td>
                                <td class=" text-center" style="display: flex;justify-content: center; " >
                                    <a href="{{route('blog.edit',$blogs->id)}}" style="float: left;margin-right: 10px"
                                       class="btn btn-primary">Chỉnh sửa</a>
                                    <button type="button" class="btn btn-danger deleteUser" data-toggle="modal"
                                             data-target="#Modal" data-id="{{$blogs->id}}">Xóa
                                    </button>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="container " style="display: flex;justify-content: center; margin-top: 10px">{{ $blog->links() }}</div>
            </div>
        </div>
    </div>

    {{Form::open(['route' => 'blogDelete', 'method' => 'POST', 'class'=>'col-md-5'])}}
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    @include('Delete.delete')
    {{ Form::close() }}

@endsection
