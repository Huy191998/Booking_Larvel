<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KindroomsRequest extends FormRequest
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
            'Name'=>'required|max:200|min:5|unique:kindrooms,name|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Describe'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'Name.required' => 'Hạng Phòng Không được bỏ trống',
            'Name.max' => 'Hạng Phòng Tên Vùng dùng tối đa là 100 ký tự',
            'Name.min' => 'Độ dài Hạng Phòng dùng tối thiểu là 5 ký tự',
            'Name.not_regex' => 'Hạng Phòng không nhập các ký tự đặc biệt',
            'Name.unique' => 'Hạng Phòng đã tồn tại',

            'Describe.required' => 'Mô Tả Không được bỏ trống',
            'Describe.max' => 'Độ dài Mô Tả dùng tối đa là 100 ký tự',
            'Describe.min' => 'Độ dài Mô Tả dùng tối thiểu là 5 ký tự',
            'Describe.not_regex' => 'Mô Tả không nhập các ký tự đặc biệt',
        ];
    }
}
