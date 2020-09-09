<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Models\hotel;
use Illuminate\Http\Request;
use App\Models\posts;
use App\Models\rooms;
use App\Models\kindrooms;
use App\Models\images;
use App\Models\comments;
use App\Models\bookrooms;
use App\Models\peoples;
use App\Models\roomcategorys;
use Carbon\Carbon;
use Session;
use Auth;


class BookroomsController extends Controller
{
    public function createbooking(Request $request)
    {
        $request->validate([

            'phone' => 'required|min:9|numeric',
            'first_name' => 'required',
            'lats_name' => 'required',
            'Idcard' => 'required|min:6|max:255',
            'Birthday' => 'required',

            'Address' => 'required',
            'cyti_id' => 'required',
            'in_at' => 'required',
            'out_at' => 'required',

        ],
            [
                'phone.required' => 'Số điện thoại không được bỏ trống',
                'phone.min' => 'Số điện thoại tối thiểu 9 ký tự',
                'phone.numeric' => 'Số điện thoại phải là số',
                'first_name.required' => 'Họ Không được bỏ trống',
                'lats_name.required' => 'Tên Không được bỏ trống',
                'Idcard.required' => 'CMND Không được bỏ trống',
                'Idcard.min' => 'CMND tối thiểu 6 ký tự',
                'Idcard.max' => 'CMND Không được quá 255 ký tự',
                'Birthday.required' => 'Ngày sinh Không được bỏ trống',

                'Address.required' => 'Tên đường Không được bỏ trống',
                'cyti_id.required' => 'Thành phố Không được bỏ trống',
                'in_at.required' => 'Ngày nhập phòng không được bỏ trông',
                'out_at.required' => 'Ngày trả phòng không được bỏ trống',

            ]);

        $peoples = new peoples();
        $peoples->first_name = $request->first_name;
        $peoples->lats_name = $request->lats_name;
        $peoples->Idcard = $request->Idcard;
        $peoples->Birthday = $request->Birthday;
        $peoples->Sex = $request->sex;
        $peoples->phone = $request->phone;
        $peoples->Isdelete = 0;
        $peoples->users_id = Auth::user()->id;
        $peoples->Address = $request->Address;
        $peoples->cyti_id = $request->cyti_id;
        $peoples->updated_at = Carbon::now()->toDateTimeString();

        
        $book = bookrooms::where('out_at', '>=',Carbon::parse($request->in_at)->format('Y-m-d'))->where('in_at', '<',Carbon::parse($request->out_at)->format('Y-m-d'))->where('rooms_id',$request->id)->get();

        $count = $book->count();
        if ($count != 0) {
            return back()->with('book', 'phòng đã được đặt !!!');
        } else {
            $peoples->save();
            $rooms = rooms::findOrFail($request->id);
            $requests = $request;
            $days = (strtotime($request->out_at) - strtotime($request->in_at)) / (60 * 60 * 24);

            //$kindrooms = kindrooms::where('id', $rooms->kindrooms_id)->get();
            //dd($rooms);
            $peoples = peoples::where('users_id', Auth::user()->id)->get('id');

            return view('Hotels.Rooms.index', compact('days', 'requests', 'rooms', 'peoples'));
        }
    }

    public function booking(Request $request)
    {
       // dd(Carbon::parse($request->in_at)->format('Y-m-d'));
        $book = bookrooms::where('out_at', '>=',Carbon::parse($request->in_at)->format('Y-m-d'))->where('in_at', '<',Carbon::parse($request->out_at)->format('Y-m-d'))->where('rooms_id',$request->id)->get();
         //dd($book);
        $count = $book->count();

        $request->validate([
            'in_at' => 'required',
            'out_at' => 'required',
        ],
            [
                'in_at.required' => 'Ngày nhập phòng không được bỏ trông',
                'out_at.required' => 'Ngày trả phòng không được bỏ trống',
            ]);
        if ($count != 0) {
            return back()->with('book', 'phòng đã được đặt !!!');
        } else {
            $rooms = rooms::findOrFail($request->id);
            $requests = $request;
            $days = (strtotime($request->out_at) - strtotime($request->in_at)) / (60 * 60 * 24);

            //$kindrooms = kindrooms::where('id', $rooms->kindrooms_id)->get();
            //dd($rooms);
            $peoples = peoples::where('users_id', Auth::user()->id)->get('id');

            return view('Hotels.Rooms.index', compact('days', 'requests', 'rooms', 'peoples'));
        }

    }

    public function payment(Request $request)
    {


        if ($request->payment_method == '1') {
            $bookrooms = new bookrooms([
                'book_at' => Carbon::now()->toDateTimeString(),
                'in_at' => Carbon::parse($request->in_at)->format('Y.m.d'),
                'out_at' => Carbon::parse($request->out_at)->format('Y.m.d'),
                'total' => $request->total,
                'rooms_id' => $request->rooms_id,
                'hotels_id' => $request->hotels_id,
                'Deposit' => "1",
                'payment_status' => $request->payment_method, //1-un-confirmed | 2-confirmed
                'peoples_id' => $request->peoples_id,
                'Isdelete' => false,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            $bookrooms->save();
        }


        //MoMo
        if ($request->payment_method == '2') {
            $bookrooms = new bookrooms([
                'book_at' => Carbon::now()->toDateTimeString(),
                'in_at' => Carbon::parse($request->in_at)->format('Y.m.d'),
                'out_at' => Carbon::parse($request->out_at)->format('Y.m.d'),
                'total' => $request->total,
                'rooms_id' => $request->rooms_id,
                'hotels_id' => $request->hotels_id,
                'Deposit' => "1",
                'payment_status' => $request->payment_method, //1-un-confirmed | 2-confirmed
                'peoples_id' => $request->peoples_id,
                'Isdelete' => false,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            $bookrooms->save();
            $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
            $partnerCode = "MOMOG2M420200807";
            $accessKey = "ugYym3wRwpSvTBdC";
            $serectkey = "4py5hV6nJlj3a54Zr82W351TKTx43e37";
            $orderId = date("YmdHis") . $bookrooms->id; // Mã đơn hàng
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $request->total;
            $notifyurl = "http://localhost/Booking/public/Hotels/booking";
            $returnUrl = "http://localhost/Booking/public/Hotels/return-payment/" . $request->rooms_id;
            $extraData = "merchantName=MoMo Partner";
            $requestId = time() . "";
            $requestType = "captureMoMoWallet";
            $extraData = ($request->extraData ? $request->extraData : "");
            //before sign HMAC SHA256 signature
            $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
            $signature = hash_hmac("sha256", $rawHash, $serectkey);
            $data = array(
                'partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'returnUrl' => $returnUrl,
                'notifyUrl' => $notifyurl,
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            //dd($jsonResult);
            return redirect($jsonResult['payUrl']);
        }
        //vnpay
        if ($request->payment_method == '3') {
            $bookrooms = new bookrooms([
                'book_at' => Carbon::now()->toDateTimeString(),
                'in_at' => $request->in_at,
                'in_at' => Carbon::parse($request->in_at)->format('Y.m.d'),
                'out_at' => Carbon::parse($request->out_at)->format('Y.m.d'),
                'rooms_id' => $request->rooms_id,
                'hotels_id' => $request->hotels_id,
                'Deposit' => "1",
                'payment_status' => "2", //1-un-confirmed | 2-confirmed
                'peoples_id' => $request->peoples_id,
                'Isdelete' => false,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            $bookrooms->save();

            $vnp_TmnCode = "G1V43U7Q"; //Mã website tại VNPAY
            $vnp_HashSecret = "HDVUNSVRLOBTWSOHFSBKGGGJFHXAPNSO"; //Chuỗi bí mật
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/Booking/public/Hotels/return-payment/" . $request->rooms_id;
            $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->total;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();

            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);
        }


        //return back()->with('thongbao','Bạn đặt phòng thành công !!!');
        return redirect("client/rooms/showrooms/$request->rooms_id")->with('thongdao', 'Bạn đặt phòng thành công !!!');
        //return redirect('Hotels/booking');
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function return(Request $request, $id)
    {
        //dd($id);
        return redirect("client/rooms/showrooms/$id")->with('thongdao', 'Bạn đã thanh toán thành công! xin cảm ơn !!!');
        // return redirect('/client')->with('success', 'Bạn đã thanh toán thành công! xin cảm ơn!');
    }
}

