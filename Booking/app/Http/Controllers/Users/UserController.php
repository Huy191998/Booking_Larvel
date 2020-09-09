<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\peoples;
use App\Models\cities;
use App\Models\bookrooms;
use Carbon\Carbon;
use Session;
use Auth;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = peoples::where('users_id', Auth::user()->id)->get();
        $cities = cities::pluck('name', 'id')->toArray();
        $count = $user->count();
        //dd($count);
        return view('Users.user.index', compact('user', 'cities', 'count'));
    }

    public function destroy($id)
    {
        $bookrooms = bookrooms::findOrFail($id);
        if ($bookrooms) {

            $bookrooms->delete();
        }
        return back()->with('thongbao', 'Hủy đặt phòng thành công');
    }

    public function listorder($id)
    {
        $peoples = peoples::findOrFail($id);
        $bookrooms = bookrooms::where('peoples_id', $id)->latest()->paginate(5);
        return view('Users.order.index', compact('bookrooms', 'peoples'));
    }

    public function userscreate(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^[0][0-9]*$/|size:10',
            'first_name' => 'required|max:50|min:3|regex:/^[a-zA-Z0-9]*$/',
            'lats_name' => 'required|max:50|min:3|regex:/^[a-zA-Z0-9]*$/',
            'Idcard' => 'required|min:9|numeric',
            'Birthday' => 'required',
            'Address' => 'required|max:100|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'cyti_id' => 'required',

        ],
            [
                'phone.required' => 'Số điện thoại không được bỏ trống',
                'phone.size' => 'Số điện thoại phải có 10 chữ số',
                'phone.regex' => 'Số điện thoại không hợp lệ',

                'first_name.required' => 'Họ Không được bỏ trống',
                'first_name.max' => 'Độ dài Họ dùng tối đa là 50 ký tự',
                'first_name.min' => 'Độ dài Họ dùng tối thiểu là 3 ký tự',
                'first_name.regex' => 'Họ không nhập các ký tự đặc biệt',

                'lats_name.required' => 'Tên Không được bỏ trống',
                'lats_name.max' => 'Độ dài Tên dùng tối đa là 50 ký tự',
                'lats_name.min' => 'Độ dài Tên dùng tối thiểu là 3 ký tự',
                'lats_name.regex' => 'Tên không nhập các ký tự đặc biệt',

                'Idcard.required' => 'CMND Không được bỏ trống',
                'Idcard.min' => 'CMND tối thiểu 9 kí tự',
                'Idcard.numeric' => 'CMND không hợp lệ!',

                'Birthday.required' => 'Ngày sinh Không được bỏ trống',

                'Address.required' => 'Tên đường Không được bỏ trống',
                'Address.max' => 'Độ dài Tên đường dùng tối đa là 100 ký tự',
                'Address.min' => 'Độ dài Tên đường dùng tối thiểu là 5 ký tự',
                'Address.not_regex' => 'Tên đường không nhập các ký tự đặc biệt',

                'cyti_id.required' => 'Thành phố Không được bỏ trống',

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

        $peoples->save();
        Session::flash('thongbao', 'Đã cập nhập thành công !!! ');
        return back();
    }

    public function UserUpdate(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|regex:/^[0][0-9]*$/|size:10',
            'first_name' => 'required|max:50|min:3|regex:/^[a-zA-Z0-9]*$/',
            'lats_name' => 'required|max:50|min:3|regex:/^[a-zA-Z0-9]*$/',
            'Idcard' => 'required|min:9|numeric',
            'Birthday' => 'required',
            'Address' => 'required|max:100|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'cyti_id' => 'required',

        ],
            [
                'phone.required' => 'Số điện thoại không được bỏ trống',
                'phone.size' => 'Số điện thoại phải có 10 chữ số',
                'phone.regex' => 'Số điện thoại không hợp lệ',

                'first_name.required' => 'Họ Không được bỏ trống',
                'first_name.max' => 'Độ dài Họ dùng tối đa là 50 ký tự',
                'first_name.min' => 'Độ dài Họ dùng tối thiểu là 3 ký tự',
                'first_name.regex' => 'Họ không nhập các ký tự đặc biệt',

                'lats_name.required' => 'Tên Không được bỏ trống',
                'lats_name.max' => 'Độ dài Tên dùng tối đa là 50 ký tự',
                'lats_name.min' => 'Độ dài Tên dùng tối thiểu là 3 ký tự',
                'lats_name.regex' => 'Tên không nhập các ký tự đặc biệt',

                'Idcard.required' => 'CMND Không được bỏ trống',
                'Idcard.min' => 'CMND tối thiểu 9 kí tự',
                'Idcard.numeric' => 'CMND không hợp lệ!',

                'Birthday.required' => 'Ngày sinh Không được bỏ trống',

                'Address.required' => 'Tên đường Không được bỏ trống',
                'Address.max' => 'Độ dài Tên đường dùng tối đa là 100 ký tự',
                'Address.min' => 'Độ dài Tên đường dùng tối thiểu là 5 ký tự',
                'Address.not_regex' => 'Tên đường không nhập các ký tự đặc biệt',

                'cyti_id.required' => 'Thành phố Không được bỏ trống',

            ]);
        $peoples = peoples::findOrFail($id);
        if (isset($peoples)) {

            $peoples->first_name = $request->first_name;
            $peoples->lats_name = $request->lats_name;
            $peoples->Idcard = $request->Idcard;
            $peoples->Birthday = $request->Birthday;
            $peoples->Sex = $request->sex;
            $peoples->phone = $request->phone;
            $peoples->Isdelete = 0;
            $peoples->Address = $request->Address;
            $peoples->cyti_id = $request->cyti_id;
            $peoples->updated_at = Carbon::now()->toDateTimeString();

            $peoples->update();
            Session::flash('thongbao', 'Đã cập nhập thành công !!! ');
            return back();

        }

    }
}
