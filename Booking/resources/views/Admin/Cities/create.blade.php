<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo mới thành phố</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'cities.store', 'method' => 'post','enctype '=>'multipart/form-data']) }}
                @csrf
                <div class="form-group {{ $errors->has('Name') ?'has-error':'' }}">
                    {{ Form::label('Tên thành phố:') }}
                    {{ Form::text('Name','',['class'=>'form-control']) }}
                    <span class="text-danger">{{$errors->first('Name')}}</span>
                </div>
                <div class="form-group {{ $errors->has('region_id') ?'has-error':'' }}"">
                    {{Form::label('Vùng miền:')}}
                    {{Form::select('region_id',$regions,null,['class' => " form-control",'placeholder'=>'------------ Chọn vùng miền ------------'])}}
                    @if ($errors->has('category_id'))
                        <div class="text-danger">{{ $errors->first('category_id') }}</div>
                    @endif
                    <span class="text-danger">{{$errors->first('region_id')}}</span>
                </div>
                <div class="form-group {{ $errors->has('Status') ?'has-error':'' }}">
                    {{ Form::label('Ghi Chú :') }}
                    {{ Form::text('Status','',['class'=>'form-control']) }}
                    <span class="text-danger">{{$errors->first('Status')}}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('Hình ảnh ' ,'Hình ảnh') }}
                    <input name="images" type="file" class="form-control">
                    <span class="text-danger">{{$errors->first('images')}}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button>
                    {{form::submit('Khởi tạo',['class'=>'btn btn-primary']) }}

                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>
