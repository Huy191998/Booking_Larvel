<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'=>'required|max:100|min:5|unique:blog,title|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'ct'=>'required|min:500',
            'keywords'=>'required|max:100|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'desc' => 'required|max:100|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'tag'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề Không được bỏ trống',
            'title.max' => 'Độ dài Tiêu đề dùng tối đa là 100 ký tự',
            'title.min' => 'Độ dài Tiêu đề dùng tối thiểu là 5 ký tự',
            'title.not_regex' => 'Tiêu đề không nhập các ký tự đặc biệt',
            'title.unique' => 'Tiêu đề Blog đã tồn tại',

            'ct.required'=>'Nội dung không được bỏ trống',
            'ct.min'=>'Nội dung phải ít hơn 500 ký tự',

            'keywords.required' => 'Từ khóa Không được bỏ trống',
            'keywords.max' => 'Độ dài Từ khóa dùng tối đa là 100 ký tự',
            'keywords.min' => 'Độ dài Từ khóa dùng tối thiểu là 5 ký tự',
            'keywords.not_regex' => 'Từ khóa không nhập các ký tự đặc biệt',

            'desc.required' => 'Miêu tả Không được bỏ trống',
            'desc.max' => 'Độ dài Miêu tả dùng tối đa là 100 ký tự',
            'desc.min' => 'Độ dài Miêu tả dùng tối thiểu là 5 ký tự',
            'desc.not_regex' => 'Miêu tả không nhập các ký tự đặc biệt',

            'tag.required'=>'Thẻ Tag không được bỏ trống',

            'image.required' => 'Ảnh không được bỏ trống.',
            'image.mimes' => 'Ảnh phải có định dạng (jpeg, png, jpg).',
        ];
    }
}
