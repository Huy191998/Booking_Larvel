@extends('layouts.main')
@section('title','Quản lý Tag')
@section('content')
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title" style="font-size:30px;">Quản lý Tag</h4>
                        </div>
                        <div class="col-md-6" style="margin-left: 300px">
                            {{ Form::open(['route' => ['tags.index' ],'method' => 'get']) }}
                            <form class="form-inline text-right">
                                <div class="form-group mb-2 col-4" style="float: left;">
                                    <input type="text" name="seachname" class="form-control" id="inputPassword2" placeholder="Tìm kiếm...">
                                </div>
                                <button type="submit" name="Seach" style="float: left;" class="btn btn-primary mb-2">Tìm Kiếm</button>
                            </form>
                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
                <hr>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-md-6 float-left">
                            @include('Admin.Tags.create')
                        </div>
                        <div class="col-md-6 float-left">
                            @include('Admin.Tags.list')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{ Form::close() }}



@endsection
