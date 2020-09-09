<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
           
        
            'first_name'=>'required',
            'lats_name'=>'required',
            'Idcard'=>'required|min:6|max:255',
            'Birthday'=>'required',
            'Sex'=>'required',
            'Address'=>'required',
            'cyti_id'=>'required',

        ];
    }
     public function messages()
    {
        return [
            
            'first_name.required' => 'Họ Không được bỏ trống',
            'lats_name.required' => 'Tên Không được bỏ trống',
            'Idcard.required' => 'CMND Không được bỏ trống',
            'Idcard.min' => 'CMND tối thiểu 6 ký tự',
            'Idcard.max' => 'CMND Không được quá 255 ký tự',
            'Birthday.required' => 'Ngày sinh Không được bỏ trống',
            'Sex.required' => 'Giới tính Không được bỏ trống',
            'Address.required' => 'Tên đường Không được bỏ trống',
            'cyti_id.required' => 'Thành phố Không được bỏ trống',

        ];
    }
}
