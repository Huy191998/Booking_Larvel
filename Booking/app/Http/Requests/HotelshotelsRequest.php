<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelshotelsRequest extends FormRequest
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

        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
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

        ];
    }
}
