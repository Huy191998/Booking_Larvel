<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo mới tiện ích</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'sevices.store', 'method' => 'post']) }}
                <div class="form-group {{ $errors->has('Name') ?'has-error':'' }}">
                    {{ Form::label('Tên tiện ích:') }}
                    {{ Form::text('Name','',['class'=>'form-control']) }}
                    <span class="text-danger">{{$errors->first('Name')}}</span>
                </div>
                <div class="form-group {{ $errors->has('Name_icon') ?'has-error':'' }}">
                    {{ Form::label('Tên ICon:') }}
                    {{ Form::text('Name_icon','',['class'=>'form-control']) }}
                    <span class="text-danger">{{$errors->first('Name_icon')}}</span>
                </div>
                <div class="form-group {{ $errors->has('Describe') ?'has-error':'' }}">
                    {{ Form::label('Ghi Chú :') }}
                    {{ Form::text('Describe','',['class'=>'form-control']) }}
                    <span class="text-danger">{{$errors->first('Describe')}}</span>
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
