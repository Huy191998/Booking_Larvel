<div class="col-md-12 ">
    <h3 class="text-center">Danh sách Tags</h3>
    @if(Session::has('xoa'))
        <div id="div-alert"  class="alert alert-success alert-dismissible show" role="alert">
            <strong>{{ Session::get('xoa') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(Session::has('xoaloi'))
        <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert" >
            <strong>{{ Session::get('xoaloi') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table table-hover text-center">
        <thead style="text-align: center;">
            <tr class="table table-bordered table-danger">
                <th scope="col">ID</th>
                <th scope="col">Tag_Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tag_info as $key => $tag)
                <tr class="table table-bordered ">
                    <td>{{ ++$key }}</td>
                    <td>{{ $tag->tag_name}}</td>
                    <td>{{ $tag->slug}}</td>
                    <td>
                        <button type="button" class="btn btn-danger deleteUser" data-toggle="modal"
                                data-target="#Modal" data-id="{{$tag->id}}">Xóa
                        </button>
                    </td>
                </tr>
            @endforeach()
        </tbody>
    </table>
</div>
<div class="container " style="display: flex;justify-content: center; margin-top: 10px">{{ $tag_info->links() }}</div>

{{Form::open(['route' => 'TagDelete', 'method' => 'POST', 'class'=>'col-md-5'])}}
{{ method_field('DELETE') }}
{{ csrf_field() }}
@include('Delete.delete')
{{ Form::close() }}
