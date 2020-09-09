<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'description' => 'required|max:255|min:5',
            'ct' => 'required|max:255|min:5',
            'image' => 'required|mimes:jpeg,jpg,png',
            'url' => 'required|max:255|min:1',
        ];

    }

    public function messages()
    {
        return [
            'description.required' => 'Nội dung không được bỏ trống.',
            'description.max:255' => 'Nội dung chỉ tối đa 255 ký tự.',
            'description.min:5' => 'Nội dung phải nhiều hơn 5 ký tự.',
            'ct.required' => 'Tiêu đề không được bỏ trống.',
            'ct.max:255' => 'Tiêu đề chỉ tối đa 255 ký tự',
            'ct.min:5' => 'Tiêu đề phải nhiều hơn 5 ký tự.',
            'image.required' => 'Ảnh không được bỏ trống.',
            'image.mimes' => 'Ảnh phải có định dạng (jpeg, png, jpg).',
            'url.required' => 'URL không được bỏ trống.',
            'url.max:255' => 'URL chỉ tối đa 255 ký tự.',
            'url.min:1' => 'URL phải nhiều hơn 5 ký tự.',
        ];
    }
}
