<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comments'=> 'required|max:255',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'comments.required'=> 'Bình luận không được bỏ trống',
            'comments.max:255'=> 'Bình luận không được quá 255 kí tự',
        ];
    }
}
