<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionsRequest extends FormRequest
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
            'Name'=>'required|max:100|min:3|unique:regions,name|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Status'=>'required|max:200|min:3|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'Name.required' => 'Tên Vùng Không được bỏ trống',
            'Name.max' => 'Độ dài Tên Vùng dùng tối đa là 100 ký tự',
            'Name.min' => 'Độ dài Tên Vùng dùng tối thiểu là 3 ký tự',
            'Name.not_regex' => 'Tên Vùng không nhập các ký tự đặc biệt',
            'Name.unique' => 'Tên Vùng đã tồn tại',

            'Status.required' => 'Ghi chú Không được bỏ trống',
            'Status.max' => 'Độ dài Ghi chú dùng tối đa là 200 ký tự',
            'Status.min' => 'Độ dài Ghi chú dùng tối thiểu là 3 ký tự',
            'Status.not_regex' => 'Ghi chú không nhập các ký tự đặc biệt',

        ];
    }
}
