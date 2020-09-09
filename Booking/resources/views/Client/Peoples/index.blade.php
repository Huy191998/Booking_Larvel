@extends('layouts.main')
@section('content')

    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Top Selling Products</h4>
                            <h5 class="card-subtitle">Quản vùng miền</h5>
                        </div>

                    </div>
                    <!-- title -->
                </div>
                <div class="table-responsive">

                    <button type="button"
                            class="btn btn-block create-btn text-white no-block d-flex align-items-center col-2"
                            data-toggle="modal" data-target="#ModalCreate"><i class="fa fa-plus-square"></i> <span
                            class="hide-menu m-l-5">Create New</span></button>
                    <table class="table v-middle">
                        <thead>
                        <tr class="bg-light">
                            <th style="text-align:center;" class="border-top-0">STT</th>
                            <th style="text-align:center;" class="border-top-0">Tên vùng miền</th>
                            <th style="text-align:center;" class="border-top-0">Ghi Chú</th>
                            <th style="text-align:center;" class="border-top-0"> qưewq</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $peoples as $key => $peoples )
                            <tr>
                                <td style="text-align:center;">{{ ++$key }}</td>
                                <td style="text-align:center;">{{ $peoples->Name }}</td>
                                <td style="text-align:center;">{{ $peoples->Status }}</td>
                                <td>
                                    <a href="{{route('peoples.edit',$peoples->id)}}"
                                       style="float: left;margin-right: 10px" class="btn btn-primary">Chi tiết</a>

                                    <button type="button" class="btn btn-danger deleteUser" data-toggle="modal"
                                            data-target="#Modal" data-id="{{$peoples->id}}">Xóa
                                    </button>

                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('Peoples.create')

@endsection
@section('footer')
    @include('shared.footer')
@endsection
