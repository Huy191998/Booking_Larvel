<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomsRequest extends FormRequest
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
            'rates'=>'required',
            'images'=>'required',
            'acreage'=>'required',
            'AmountPeople'=>'required',
            'surcharge'=>'required',
            'roomcategorys_id'=>'required',
            'kindrooms_id'=>'required',
            'sevices_id'=>'required',
            'description'=>'required|max:200',
        ];
    }
    //thiet lap cac thong diep
    public function messages()
    {
        return [
         
            'rates.required'=>'Giá phòng không được bỏ trống',
            'acreage.required'=>'Diện tích không được bỏ trống',
            'AmountPeople.required'=>'Số người không được bỏ trống',
            'images.required'=>'Hình ảnh không được bỏ trống',
            'surcharge.required'=>'Phụ thu không được bỏ trống',
            'roomcategorys_id.required'=>'Loại phòng phải được chọn, không được bỏ trống',
            'kindrooms_id.required'=>'Hạng phòng phải được chọn, không được bỏ trống',
            'sevices_id.required'=>'Tiện ích phải được chọn, không được bỏ trống',
            'description.required'=>'Mô tả không được bỏ trống',
            'description.max'=>'Mô tả tối đa 200 ký tự',

        ];
    }
}
