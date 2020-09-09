<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\peoples;
use Illuminate\Http\Request;
use App\Models\hotel;
use App\Models\posts;
use App\Models\rooms;
use App\Models\kindrooms;
use App\Models\images;
use App\Models\comments;
use App\Models\bookrooms;
use App\Models\roomcategorys;
use Carbon\Carbon;
use Session;
use Auth;

use PDF;

class BookingController extends Controller
{
    public function print_order($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code)
    {
        $bookings = bookrooms::findOrFail($checkout_code);
        $People = Peoples::findOrFail($checkout_code);

        $output = '';

        $output .= '<style>body{
			font-family: DejaVu Sans;
		}
        * {
          box-sizing: border-box;
        }
		.table-styling{
			border-collapse: collapse;
            width: 100%;
            font-size: 12px;
            border: 1px solid black;
		}
		.table-styling tbody tr td{
			text-align: center;
            padding: 8px;
            border: 1px solid black;
		}
		.table-danger th {
		    background-color: #fcc4ce;
            color: black;
            text-align: center;
            padding: 8px;
            border: 1px solid black;
		}
		.column {
          float: left;
          width: 30%;
          padding: 10px;
          height: 300px;
          text-align: center;
        }
        .column1 {
          float: left;
          width: 45%;
          padding: 10px;
          text-align: center;
        }
        .img1 {
            width: 165px;
            height: 125px;
        }
        .left {
          width: 15%;
        }

        .right {
          width: 85%;
        }
        .row:after {
          content: "";
          display: table;
          clear: both;
        }
		</style>

        <div class="row">
              <div class="column1 left" >
                <img class="img1" src="images/logob.png">
              </div>
              <div class="column1 right" >
                <h1><center>Booking Hotel</center></h1>
                <h3><center>Hóa Đơn chi tiết thông tin đặt phòng khách sạn</center></h3>
              </div>
        </div>


		<hr><br>
		    <table class="table-styling ">
                <thead >
                <tr class="table-danger">
                      <th>Họ Tên</th>
                      <th>Địa Chỉ</th>
                      <th>Ngày Sinh</th>
                      <th>Tên Tài Khoản</th>
                      <th>email</th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-danger">
                    <td>' . $People->first_name .' '. $People->lats_name . ' </td>
                    <td>' . $People->Address . '</td>
                    <td>' . $People->Birthday . '</td>
                    <td>' . $People->users->name . ' </td>
                    <td>' . $People->users->email . ' </td>
                </tr>
                </tbody>
            </table>
		<br>
		';


        $output.= '
             <table class="table-styling">
                <thead>
                    <tr class="table-danger">
                        <th>Thông tin khách hàng đặt phòng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Ngày đặt phòng</td>
                    <td>'.$bookings->book_at.'</td>
                </tr>
                <tr>
                    <td>Ngày nhận phòng</td>
                    <td>'.$bookings->in_at.'</td>
                </tr>
                <tr>
                    <td>Ngày trả phòng</td>
                    <td>'.$bookings->out_at.'</td>
                </tr>
                <tr>
                    <td>Tên khách sạn</td>
                    <td>'.$bookings->hotels->Name.'</td>
                </tr>
                <tr>
                    <td>Hạng phòng</td>
                    <td>'.$bookings->rooms->kindrooms->Name.'</td>
                </tr>
                <tr>
                    <td>Loại phòng</td>
                    <td>'.$bookings->rooms->roomcategory->RoomCategory.'</td>
                </tr>
                <tr>
                    <td>Tổng tiền</td>
                    <td>' . number_format($bookings->total,0,',','.').' '.'đ'. ' </td>
                </tr>
                <tr>
                   <td>Trạng thái thanh toán</td>
                   <td>
                        '. ($bookings['payment_status']=="1" ? 'Chưa Thanh Toán' : 'Đã Thanh Toán') .'
                   </td>
                </tr>
                <tbody>
            </table>
		<br>
            ';

        $output.= '

            <div class="row">
                <div class="column " >
                    <h4>Ký tên</h4>
                  </div>
                  <div class="column" >
                    <h4>Người Lập Phiếu</h4>
                  </div>
                  <div class="column" >
                    <h4>Người Nhận</h4>
                  </div>
            </div>
        ';

        return $output;
    }

    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $bookings = bookrooms::where('book_at', 'like', '%' . $request->seachname . '%')->orWhere('in_at', 'like',
                '%' . $request->seachname . '%')->orWhere('out_at', 'like',
                '%' . $request->seachname . '%')->orWhere('total', 'like',
                '%' . $request->seachname . '%')->orWhere('payment_status', 'like',
                '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->where('isdelete', 0)->paginate(5);
            return view('Admin.Booking.index', compact('bookings'));
        }
        $bookings = bookrooms::where('isdelete', 'false')->latest()->paginate(10);
        return view('Admin.Booking.index', compact('bookings'));
    }

    public function shows($id)
    {
        $bookings = bookrooms::findOrFail($id);
        $People = Peoples::findOrFail($id);
        //dd($People);
        return view('Admin.Booking.show', compact('bookings', 'People'));
    }

}
