<?php

namespace App\Http\Requests;

use App\Rules\Captcha;
use Validator;
use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|min:6|unique:users,name',
            'password' => 'required|min:6|max:255',
            'email'=>'required|max:150|email',
            'phone'=>'required|regex:/^[0][0-9]*$/|size:10',
            'first_name' => 'required|max:50|min:2|regex:/^[a-zA-Z0-9]*$/',
            'lats_name' => 'required|max:50|min:2|regex:/^[a-zA-Z0-9]*$/',
            'Idcard' => 'required|min:9|numeric',
            'Birthday'=>'required',
            'Sex'=>'required',
            'Address' => 'required|max:100|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'cyti_id'=>'required',
            'g-recaptcha-response' => new Captcha(),
        ];
    }

    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'name.required' => 'Tên tài khoản Không được bỏ trống',
            'name.min' => 'Tên tài khoản tối thiểu 6 ký tự',
            'name.unique' => 'Tên tài khoản đã tồn tại',
            'name.max' => 'Tên tài khoảnKhông được quá 255 ký tự',

            'password.required' => 'Mật khẩu Không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu Không được quá 255 ký tự',

            'phone.required' => 'Số điện thoại không được bỏ trống',
            'phone.size' => 'Số điện thoại phải có 10 chữ số',
            'phone.regex' => 'Số điện thoại không hợp lệ',

            'email.required' => 'Địa chỉ Email Không được bỏ trống',
            'email.max' => 'Địa chỉ Email không được vượt quá 150 ký tự!',
            'email.email' => 'Email không hợp lệ!',

            'first_name.required' => 'Họ Không được bỏ trống',
            'first_name.max' => 'Độ dài Họ dùng tối đa là 50 ký tự',
            'first_name.min' => 'Độ dài Họ dùng tối thiểu là 2 ký tự',
            'first_name.regex' => 'Họ không nhập các ký tự đặc biệt',

            'lats_name.required' => 'Tên Không được bỏ trống',
            'lats_name.max' => 'Độ dài Tên dùng tối đa là 50 ký tự',
            'lats_name.min' => 'Độ dài Tên dùng tối thiểu là 2 ký tự',
            'lats_name.regex' => 'Tên không nhập các ký tự đặc biệt',

            'Idcard.required' => 'CMND Không được bỏ trống',
            'Idcard.min' => 'CMND tối thiểu 9 kí tự',
            'Idcard.numeric' => 'CMND không hợp lệ!',

            'Birthday.required' => 'Ngày sinh Không được bỏ trống',

            'Sex.required' => 'Giới tính Không được bỏ trống',

            'Address.required' => 'Tên đường Không được bỏ trống',
            'Address.max' => 'Độ dài Tên đường dùng tối đa là 100 ký tự',
            'Address.min' => 'Độ dài Tên đường dùng tối thiểu là 5 ký tự',
            'Address.not_regex' => 'Tên đường không nhập các ký tự đặc biệt',

            'cyti_id.required' => 'Thành phố Không được bỏ trống',

        ];
    }
}
