@extends('layouts.home')
@section('content')
    <!-- Home -->


        <div class="container-fluid" style="margin-top: 200px;margin-bottom: 20px">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="font-weight-bold">Quản Lý Đặt Phòng</h2>
                    </div>
                    <div class="col-12" style="float: left;">
                           
                        <a style="margin: 10px" href="{{route('hotel.index')}} " class="btn btn-success">Trở về khách sạn</a>
                    </div>
                    <div class="col-12" style="float: left;">
                        {{ Form::open(['route' => ['order',$id],'method' => 'get']) }}
                            <div class="form-group font-weight-bold" >
                                <div class="col-4" style="float: left;">
                                     {{ Form::label('Ngày đặt:')}}
                                     {{ Form::date('date','',['class'=>'form-control ']) }}
                                </div>
                            </div>
                            <div class="form-group font-weight-bold">
                                <div class="col-4" style="float: left;">
                                    {{ Form::label('Tình trạng :')}}
                                    <select class="form-control" name="Deposit">
                                              <option value="">----------------------------Tình trạng----------------------------</option>
                                              <option value="2">Đã thanh toán</option>
                                              <option value="1">Chưa thanh toán</option>
                                              

                                            </select>
                                   
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="col-4" style="float: left; top: 28px">
                                   {{form::submit('Tìm kiếm',['class'=>'btn btn-danger']) }}
                                </div>
                                    
                            </div>
                        {{ Form::close() }}
                        </div>

                        <hr>
                    <div class="card-body">
                        
                        
                        <br>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead style="text-align: center;">
                                    <tr class="table table-bordered table-danger">
                                        <th style="text-align:center;" class="border-top-0">STT</th>
                                        <th style="text-align:center;" class="border-top-0">Người Đặt</th>
                                        <th style="text-align:center;" class="border-top-0">Tên khách sạn</th>
                                        <th style="text-align:center;" class="border-top-0">Ngày đặt</th>
                                        <th style="text-align:center;" class="border-top-0">Tổng tiền</th>
                                        <th style="text-align:center;" class="border-top-0">Tình trạng</th>
                                        <th class="border-top-0"> Thao Tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $bookrooms as $key => $bookroom )
                                        <tr class="table table-bordered ">
                                            <td style="text-align:center;">{{ ++$key }}</td>
                                            <td style="text-align:center;">{{ $bookroom->peoples->first_name }}</td>
                                            <td style="text-align:center;">{{ $bookroom->hotels->Name }}</td>
                                            <td style="text-align:center;">{!! Carbon\Carbon::parse($bookroom->book_at)->format('Y-m-d') !!}</td>
                                            <td style="text-align:center;">{{ number_format($bookroom->total) }} đ</td>
                                            @if($bookroom->payment_status == 2)
                                                <td style="text-align:center;"><a class="btn btn-outline-success btn-sm">Đã thanh toán</a></td>
                                                @else
                                                <td style="text-align:center;" ><a class="btn btn-outline-danger btn-sm">Chưa thanh toán</a> </td>
                                            @endif
                                            <td style="text-align:center;"><a href="{{route('editorder',$bookroom->id)}}"

                                                   class="btn btn-primary">chi tiết</a>
                                               </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="container " style="display: flex;justify-content: center; margin-top: 20px">{{ $bookrooms->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








@endsection
@section('footer')
    @include('shared.footer')
@endsection


