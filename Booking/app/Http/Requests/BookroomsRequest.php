<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookroomsRequest extends FormRequest
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
            'in_at'=>'required',
            'out_at'=>'required',
            'payment_status'=>'required',
            'Deposit'=>'required',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
            'in_at.required'=>'Ngày Đặt phòng phải được chọn, không được bỏ trống',
            'out_at.required'=>'Ngày trả phòng phải được chọn, không được bỏ trống',
            'payment_status.required'=>'Trạng thái phải được chọn, không được bỏ trống',
            'Deposit.required'=>'Tiền gửi phải được chọn, không được bỏ trống',
        ];
    }
}
