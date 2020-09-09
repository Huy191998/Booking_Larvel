<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitiesRequest extends FormRequest
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
            'Name'=>'required|max:200|min:3|unique:cities,name|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Status'=>'required|max:200|min:3|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

            'images'=>'required',
            'region_id'=>'required',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'Name.required' => 'Tên Thành phố Không được bỏ trống',
            'Name.max' => 'Độ dài Tên Thành phố dùng tối đa là 100 ký tự',
            'Name.min' => 'Độ dài Tên Thành phố dùng tối thiểu là 3 ký tự',
            'Name.not_regex' => 'Tên Thành phố không nhập các ký tự đặc biệt',
            'Name.unique' => 'Tên Thành phố đã tồn tại',

            'Status.required' => 'Ghi chú Không được bỏ trống',
            'Status.max' => 'Độ dài Ghi chú dùng tối đa là 100 ký tự',
            'Status.min' => 'Độ dài Ghi chú dùng tối thiểu là 3 ký tự',
            'Status.not_regex' => 'Ghi chú không nhập các ký tự đặc biệt',

            'images.required'=>'Hình ảnh không được bỏ trống',
            'region_id.required'=>'Vùng miền không được bỏ trống',

        ];
    }
}
