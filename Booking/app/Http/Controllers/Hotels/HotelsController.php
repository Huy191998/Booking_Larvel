<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Models\peoples;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\hotel;
use App\Models\images;
use App\Models\bookrooms;
use App\Models\kindrooms;
use App\Models\roomcategorys;
use App\Models\sevices;
use App\Models\cities;
use App\Models\rooms;
use App\Models\users;
use Carbon\Carbon;
use Session;
use Auth;

//khai bao formRequest
use App\Http\Requests\HotelshotelsRequest;
use PDF;
class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $hotel = hotel::where('Isdelete', 0)->where('id', 'like', '%' . $request->seachname . '%')->orWhere('Name', 'like',
                '%' . $request->seachname . '%')->orWhere('Address', 'like',
                '%' . $request->seachname . '%')->orWhere('Status', 'like',
                '%' . $request->seachname . '%')->paginate(5);
            return view('Hotels.Hotels.index', compact('hotel'));
        }
        $hotel = hotel::where('Isdelete', false)->where('users_id', Auth::user()->id)->paginate(5);
        //dd($hotel);
        return view('Hotels.Hotels.index', compact('hotel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = cities::where('isdelete', false)->pluck('name', 'id')->toArray();
        return view('Hotels.Hotels.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelshotelsRequest $request)
    {
        //dd($request);
        $request->validated();
        if ($request->hasFile('images')) {
            $request->images->move('img', $request->images->getClientOriginalName());
            $hotel = new hotel([
                'Name' => $request->Name,
                'email' => $request->Email,
                'image' => $request->images->getClientOriginalName(),
                'Phone' => $request->Phone,
                'Count_star' => $request->Count_star,
                'Address' => $request->Address,
                'city_id' => $request->city_id,
                'description' => $request->description,
                'users_id' => Auth::user()->id,
                'Status' => false,
                'Isdelete' => false,
                'created_at' => Carbon::now()->toDateTimeString(),

            ]);
        }
        $hotel->save();
        if ($hotel) return redirect("Hotels/hotel/$request->hotels_id")->with('thongbao','Đã tạo khách sạn thành công !!!');
        else return back()->with('loi','Bạn đã tạo khách sạn không thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

        $hotel = hotel::findOrFail($id);
        $sevices = sevices::where('isdelete', false)->get();
        $rooms = rooms::where('isdelete', false)->where('hotels_id', $id)->paginate(10);

        return view('Hotels.Hotels.show', compact('hotel', 'sevices', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = hotel::findOrFail($id);
        $cities = cities::where('isdelete', false)->pluck('name', 'id')->toArray();
        return view('Hotels.Orders.edit', compact('cities', 'hotel'));
    }

    public function order(Request $request, $id)
    {
        //dd($request);
        if($request->date != null && $request->Deposit != null ){
            $hotel = hotel::findOrFail($id);
            $bookrooms = bookrooms::where('isdelete', false)->where('book_at','>=',$request->date)->where('payment_status',$request->Deposit)->where('hotels_id', $id)->latest()->paginate(10);
        //dd($bookrooms);
        return view('Hotels.Orders.order', compact('bookrooms','id'));
        }
        if($request->date != null && $request->Deposit == null ){
            $hotel = hotel::findOrFail($id);
            $bookrooms = bookrooms::where('isdelete', false)->where('book_at','>=',$request->date)->where('hotels_id', $id)->latest()->paginate(10);
        //dd($bookrooms);
        return view('Hotels.Orders.order', compact('bookrooms','id'));
        }
        if($request->Deposit != null && $request->date == null){
            $hotel = hotel::findOrFail($id);
            $bookrooms = bookrooms::where('isdelete', false)->where('payment_status',$request->Deposit)->where('hotels_id', $id)->latest()->paginate(10);
        //dd($bookrooms);
        return view('Hotels.Orders.order', compact('bookrooms','id'));
        }
        $hotel = hotel::findOrFail($id);
        $bookrooms = bookrooms::where('isdelete', false)->where('hotels_id', $id)->latest()->paginate(10);
        //dd($bookrooms);
        return view('Hotels.Orders.order', compact('bookrooms','id'));
    }

    public function editorder($id)
    {
        $bookrooms = bookrooms::findOrFail($id);

        return view('Hotels.Orders.editorder', compact('bookrooms'));
    }
    public function upDeposit(Request $request,$id)
    {
        //dd($request->Deposit);
        $bookrooms = bookrooms::findOrFail($id);
        $bookrooms->Deposit = $request->Deposit;
        $bookrooms->update();
        return back()->with('thongbao', 'Đã cập nhập thành công');


    }
    public function uporder($id)
    {
        $bookrooms = bookrooms::findOrFail($id);
        $bookrooms->payment_status = "2";
        $bookrooms->update();
        return back()->with('thongbao', 'Đã thanh toán thành công');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Name'=>'required|max:100|min:3|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Email'=>'required|max:150|email',
            'Phone' => 'required|regex:/^[0][0-9]*$/|size:10',
            'Address' => 'required|max:100|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Count_star'=>'required',
            'city_id'=>'required',
            'description'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

        ],
            [
                'Name.required' => 'Tên khách sạn Không được bỏ trống',
                'Name.max' => 'Độ dài Tên khách sạn dùng tối đa là 50 ký tự',
                'Name.min' => 'Độ dài Tên khách sạn dùng tối thiểu là 3 ký tự',
                'Name.not_regex' => 'Tên khách sạn không nhập các ký tự đặc biệt',

                'Email.required' => 'Địa chỉ Email Không được bỏ trống',
                'Email.max' => 'Địa chỉ Email không được vượt quá 150 ký tự!',
                'Email.email' => 'Email không hợp lệ!',

                'Phone.required' => 'Số điện thoại không được bỏ trống',
                'Phone.size' => 'Số điện thoại phải có 10 chữ số',
                'Phone.regex' => 'Số điện thoại không hợp lệ',

                'Address.required' => 'Tên đường Không được bỏ trống',
                'Address.max' => 'Độ dài Tên đường dùng tối đa là 100 ký tự',
                'Address.min' => 'Độ dài Tên đường dùng tối thiểu là 5 ký tự',
                'Address.not_regex' => 'Tên đường không nhập các ký tự đặc biệt',

                'Count_star.required'=>'Hạng khách sạn không được bỏ trống',

                'city_id.required'=>'Thành phố phải được chọn, không được bỏ trống',

                'description.required' => 'Mô Tả Không được bỏ trống',
                'description.max' => 'Độ dài Mô Tả dùng tối đa là 100 ký tự',
                'description.min' => 'Độ dài Mô Tả dùng tối thiểu là 5 ký tự',
                'description.not_regex' => 'Mô Tả không nhập các ký tự đặc biệt',

            ]);

        $hotel = hotel::findOrFail($id);
        //dd($regions);
        if (isset($hotel)) {
            if ($request->hasFile('images')) {
                $request->images->move('img', $request->images->getClientOriginalName());
                $hotel->Name = $request->Name;
                $hotel->email = $request->Email;
                $hotel->Status = false;
                $hotel->image = $request->images->getClientOriginalName();
                $hotel->Phone = $request->Phone;
                $hotel->Count_star = $request->Count_star;
                $hotel->Address = $request->Address;
                $hotel->description = $request->description;
                $hotel->city_id = $request->city_id;
                $hotel->updated_at = Carbon::now()->toDateTimeString();
                //dd($regions);
                $hotel->update();
                //echo "string";

                // return back()->with('thongdiep','Cập nhập thành công');
            } else {
                $hotel->Name = $request->Name;
                $hotel->email = $request->Email;
                $hotel->Status = false;
                $hotel->Phone = $request->Phone;
                $hotel->Count_star = $request->Count_star;
                $hotel->Address = $request->Address;
                $hotel->city_id = $request->city_id;
                $hotel->updated_at = Carbon::now()->toDateTimeString();
                //dd($regions);
                $hotel->update();
            }
        }
        if ($hotel) return redirect("Hotels/hotel/$request->hotels_id")->with('thongbao','Đã chỉnh sửa thành công !!!');
        else return back()->with('loi','Đã chỉnh sửa không thành công !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = hotel::findOrFail($id);
        if ($hotel) {
            $hotel->Isdelete = true;
            $hotel->update();
            //echo "string";
            return back()->with('xoa','Đã xóa thành công!');
        }
        else return back()->with('loi','Xóa không thành công!');
    }

    public function print_orders($checkout_codes)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_codes));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_codes)
    {
        $bookrooms = bookrooms::findOrFail($checkout_codes);
        $People = Peoples::findOrFail($checkout_codes);
        $cities = cities::findOrFail($checkout_codes);

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
                <h3><center>Hóa Đơn chi tiết thông tin đặt phòng</center></h3>
              </div>
        </div>


		<hr><br>
		    <table class="table-styling ">
                <thead >
                <tr class="table-danger">
                      <th>Tên Người Đặt</th>
                      <th>Địa Chỉ</th>
                      <th>Số Điện Thoại</th>
                      <th>email</th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-danger">
                    <td>' . $bookrooms->peoples->first_name .' '. $bookrooms->peoples->lats_name . ' </td>
                    <td>' . $bookrooms->peoples->cities->Name .' '.$bookrooms->peoples->Address.'</td>
                    <td>' . $bookrooms->peoples->phone . '</td>
                    <td>' . $bookrooms->peoples->users->email . ' </td>
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
                    <td>Loại Phòng</td>
                    <td>'.$bookrooms->rooms->roomcategory->RoomCategory.'</td>
                </tr>
                <tr>
                    <td>Hạng Phòng</td>
                    <td>'.$bookrooms->rooms->kindrooms->Name.'</td>
                </tr>
                <tr>
                    <td>Ngày đặt</td>
                    <td>'.$bookrooms->book_at.'</td>
                </tr>
                <tr>
                    <td>Ngày đến</td>
                    <td>'.$bookrooms->in_at.'</td>
                </tr>
                <tr>
                    <td>Ngày đi</td>
                    <td>'.$bookrooms->out_at.'</td>
                </tr>
                <tr>
                    <td>Số người kê thêm</td>
                    <td>'. $bookrooms->Deposit .' '.'Người'. '</td>
                </tr>
                <tr>
                    <td>Tổng tiền</td>
                    <td>' . number_format($bookrooms->total,0,',','.').' '.'đ'. ' </td>
                </tr>
                <tr>
                    <td>Tình trạng đơn</td>
                    <td>'.($bookrooms['Deposit']=="1" ? 'Đã đặt phòng' : 'Đã nhận phòng').'</td>
                </tr>

                <tr>
                   <td>Tình Trạng Phòng</td>
                   <td>
                        '. ($bookrooms['payment_status']=="2" ? 'Đã Thanh Toán' : 'Chưa Thanh Toán') .'
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

}
