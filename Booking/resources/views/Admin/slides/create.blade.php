<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo mới Slide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'slide.store', 'method' => 'post','enctype '=>'multipart/form-data']) }}

                <div class="form-group">
                    {{ Form::label('Tiêu Đề: ','',['class' => 'font-weight-bold']) }}
                    {!! Form::text('ct', null, [
                        'class' => 'form-control',
                    ])
                    !!}
                    <span class="text-danger">{{ $errors->first('ct')}}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('Nội dung: ','',['class' => 'font-weight-bold']) }}
                    {!! Form::textArea('description', null, [
                        'class' => 'form-control',
                        'rows' => '3',
                    ])
                    !!}
                    <span class="text-danger">{{ $errors->first('description')}}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('Url: ','',['class' => 'font-weight-bold']) }}
                    {!! Form::text('url', null, [
                        'class' => 'form-control',
                    ])
                    !!}
                    <span class="text-danger">{{ $errors->first('url')}}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('Image: ','Hình Ảnh',['class' => 'font-weight-bold']) }}
                    {{ Form::file('image', null, ['class' => 'form-control' ]) }}
                    <br>
                    <span class="text-danger">{{ $errors->first('image')}}</span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button>
                    {{form::submit('Khởi tạo',['class'=>'btn btn-primary']) }}
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
