@extends('layouts.main')
@section('title','Viết Blog')
@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-gray-dark">Tạo mới Blog</h3>
            </div>
            @if(Session::has('thongbao'))
                <div id="div-alert"  class="alert alert-success alert-dismissible show" role="alert">
                    <strong>{{ Session::get('thongbao') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(Session::has('loi'))
                <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert" >
                    <strong>{{ Session::get('loi') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card-body">
                {!! Form::open(['route'=>'blog.store', 'method'=>'post','enctype '=>'multipart/form-data']) !!}
                <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                    {{Form::label('Tiêu đề:','',['class' => 'font-weight-bold'])}}
                    {{Form::text('title', '',['class' => 'form-control',])}}
                    <span class="text-danger"> {{ $errors->first('title')}} </span>
                </div>
                <div class="form-group {{ $errors->has('desc') ? 'has-error':'' }}">
                    {{Form::label('Miêu tả:','',['class' => 'font-weight-bold'])}}
                    {{Form::text('desc', '',['class' => 'form-control'])}}
                    <span class="text-danger"> {{ $errors->first('desc')}} </span>
                </div>
                <div class="form-group">
                    {{Form::label('Hình ảnh:','Hình ảnh',['class' => 'font-weight-bold'])}}
                    <input type="file" name="image" class="form-control">
                    <span class="text-danger"> {{ $errors->first('image')}} </span>
                </div>
                <div class="form-group {{ $errors->has('keywords') ? 'has-error':'' }}">
                    {{Form::label('Từ khóa:','',['class' => 'font-weight-bold'])}}
                    {{Form::text('keywords', '',['class' => 'form-control',])}}
                    <span class="text-danger"> {{ $errors->first('keywords')}} </span>
                </div>
                <div class="form-group {{ $errors->has('tag') ? 'has-error':'' }}">
                    {{Form::label('Tag cho bài viết:','',['class' => 'font-weight-bold'])}}
                    {!!Form::select('tag[]',$tag, null,['class'=>'form-control tag','multiple'=>'multiple' ]) !!}
                    <span class="text-danger"> {{ $errors->first('tag')}} </span>
                </div>
                <br>
                <div class="form-group {{ $errors->has('ct') ? 'has-error':'' }}">
                    {{Form::label('Nội dung:','',['class' => 'font-weight-bold'])}}
                    <textarea name="ct" id="ckeditor" cols="5" rows="5" class="form-control"></textarea>
                    <span class="text-danger"> {{ $errors->first('ct')}} </span>
                </div>
                <br>
                <div class="modal-footer">
                    {{Form::submit('Tạo mới',["class"=> "btn btn-success"])}}
                    <a href="{{ route('blog.index')}}" class="btn btn-primary">Trở Về</a>
                </div>


                {!! Form::close() !!}

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
        </div>
    </div>
    </div>

@endsection
