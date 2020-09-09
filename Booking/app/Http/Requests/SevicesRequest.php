<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SevicesRequest extends FormRequest
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
            'Name'=>'required|max:100|min:2|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Name_icon'=> 'required|max:50',
            'Describe'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'Name_icon.required'=>'Tên Icon không được bỏ trống',
            'Name.Name_icon'=> 'Tên Icon không được quá 50 kí tự',

            'Name.required' => 'Tên tiện ích Không được bỏ trống',
            'Name.max' => 'Độ dài tiện ích dùng tối đa là 100 ký tự',
            'Name.min' => 'Độ dài tiện ích dùng tối thiểu là 2 ký tự',
            'Name.not_regex' => 'tiện ích không nhập các ký tự đặc biệt',

            'Describe.required' => 'Ghi chú Không được bỏ trống',
            'Describe.max' => 'Độ dài Ghi chú dùng tối đa là 200 ký tự',
            'Describe.min' => 'Độ dài Ghi chú dùng tối thiểu là 5 ký tự',
            'Describe.not_regex' => 'Ghi chú không nhập các ký tự đặc biệt',
        ];
    }
}
