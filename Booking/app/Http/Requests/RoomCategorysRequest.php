<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomCategorysRequest extends FormRequest
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
            'Name'=>'required|max:100|min:2|unique:roomcategory,RoomCategory|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Describe'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

            'AmountPeople'=>'required|numeric',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'Name.required' => 'Loại phòng Không được bỏ trống',
            'Name.max' => 'Độ dài Loại Phòng dùng tối đa là 100 ký tự',
            'Name.min' => 'Độ dài Loại phòng dùng tối thiểu là 2 ký tự',
            'Name.not_regex' => 'Loại phòng không nhập các ký tự đặc biệt',
            'Name.unique' => 'Loại phòng đã tồn tại',

            'Describe.required' => 'Mô Tả Không được bỏ trống',
            'Describe.max' => 'Độ dài Mô Tả dùng tối đa là 200 ký tự',
            'Describe.min' => 'Độ dài Mô Tả dùng tối thiểu là 5 ký tự',
            'Describe.not_regex' => 'Mô Tả không nhập các ký tự đặc biệt',

            'AmountPeople.required'=> 'Số người không được bỏ trống',
            'AmountPeople.numeric' => 'Số người không hợp lệ!',

        ];
    }
}
