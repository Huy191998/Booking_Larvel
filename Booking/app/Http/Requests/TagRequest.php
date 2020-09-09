<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'tag_name'=>'required|max:15|min:2|unique:tag,tag_name|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'tag_name.required' => 'Tag Không được bỏ trống',
            'tag_name.max' => 'Độ dài Tag dùng tối đa là 10 ký tự',
            'tag_name.min' => 'Độ dài Tag dùng tối thiểu là 2 ký tự',
            'tag_name.not_regex' => 'Tag không nhập các ký tự đặc biệt',
            'tag_name.unique' => 'Tag đã tồn tại',
        ];
    }
}
