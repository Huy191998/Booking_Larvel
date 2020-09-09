<div class="col-md-12 ">
    <h3 class="col-md-12 text-center">Tạo Thẻ Tag</h3>
    <!-- hiển thị thông điệp -->

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

        {!! Form::open(['route'=>'tags.store', 'method'=>'post']) !!}
        <div class="form-group {{ $errors->has('tag_name') ? 'has-error':'' }}">
                {{Form::label('Tag name:','',['class' => 'col-md-3 float-left mt-2 font-weight-bold'])}}
                {{Form::text('tag_name', '',['class' => 'form-control col-md-9 float-left',])}}
                <span class="text-danger"> {{ $errors->first('tag_name')}} </span>
        </div>
        <br>

        <br>
        <div class="modal-footer">
            {{form::submit('Khởi tạo',['class'=>'btn btn-primary']) }}
        </div>

	{!! Form::close() !!}
</div>
