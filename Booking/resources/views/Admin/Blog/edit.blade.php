@extends('layouts.main')
@section('title','Cập nhập Blog')
@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow mb-4">
            @if(Session::has('thongbao'))
                        <div id="div-alert" style="position:absolute; right: 10px; top: 70px" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                            <strong>{{ Session::get('thongbao') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            @endif
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-gray-dark">Chỉnh sửa Blog</h3>
            </div>
            <div class="card-body">
                {!! Form::model($blog,['route'=>['blog.update',$blog->id], 'method'=>'put']) !!}
                <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                    {{Form::label('Tiêu đề:')}}
                    {{Form::text('title', $blog->title,['class' => 'form-control',])}}
                    <span class="text-danger"> {{ $errors->first('title')}} </span>
                </div>
                <br>
                <div class="form-group {{ $errors->has('desc') ? 'has-error':'' }}">
                    {{Form::label('Miêu tả:')}}
                    {{ Form::textarea('desc',isset($blog->seo->first()->desc) ? $blog->seo->first()->desc : null ,['class'=>'form-control', 'rows' => '3', 'id' => 'demo']) }}
                    <span class="text-danger"> {{ $errors->first('desc')}} </span>
                </div>
                <div class="form-group ">
                    {{ Form::label('Hình ảnh','Hình ảnh:')}}
                    {{ Form::file('images',$blog->image,['class'=>'form-control ', 'required'=>'true'])}}
                    <span class="text-danger"> {{ $errors->first('image')}} </span>
                </div>
                <br>
                <div class="form-group {{ $errors->has('keyword') ? 'has-error':'' }}">
                    {{Form::label('Từ Khóa:')}}
                    {{Form::text('keyword', isset($blog->seo->first()->keywords) ? $blog->seo->first()->keywords : null,['class' => 'form-control',])}}
                    <span class="text-danger"> {{ $errors->first('keyword')}} </span>
                </div>

                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('tag') ? 'has-error':'' }}">
                        {{Form::label('Tag cho bài viết:')}}
                        {!!Form::select('tag[]',$tag,$blog->tag_name ,['class'=>'form-control tag','multiple'=>'multiple' ]) !!}
                        <span class="text-danger"> {{ $errors->first('tag')}} </span>
                    </div>
                </div>
                <br>
                <div class="form-group {{ $errors->has('ct') ? 'has-error':'' }}">
                    {{Form::label('Nội dung:')}}
                    {{Form::textarea('ct', $blog->ct,['class' => 'form-control','id'=>'ckeditor'])}}
                    <span class="text-danger"> {{ $errors->first('ct')}} </span>
                </div>
                <br>
                <div class="modal-footer">
                    {{Form::submit('Cập Nhập',["class"=> "btn btn-success"])}}
                    <a href="{{ route('blog.index')}}" class="btn btn-primary">Trở Về</a>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css"
                      rel="stylesheet"/>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
                <script type="text/javascript">
                    $('.tag').select2({});
                </script>

                <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
                <script type="text/javascript">
                    CKEDITOR.replace('ckeditor', {
                        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form'
                    });
                </script>
            </div>
@endsection
