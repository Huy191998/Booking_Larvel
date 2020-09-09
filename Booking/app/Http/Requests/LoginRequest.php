<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LoginRequest extends FormRequest
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
            'name' => 'required|max:255|min:6',
            'password' => 'required|min:6|max:255',

        ];
    }

    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'name.required' => 'Tên tài khoản Không được bỏ trông',
            'name.min' => 'Tên tài khoản tối thiểu 6 ký tự',
            'name.max' => 'Tên tài khoảnKhông được quá 255 ký tự',
            'password.required' => 'Mật khẩu Không được bỏ trông',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu Không được quá 255 ký tự',
        ];
    }
}
