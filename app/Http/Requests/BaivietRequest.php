<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaivietRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'ten_bai_viet' => 'required|string|max:500',
            'mo_ta_ngan' => 'required|string|max:500',
            'hinh_anh' => 'required',
            'noi_dung' => 'required',

        ];
    }
    public function messages()
    {
        return[
            'ten_bai_viet.required'    => 'Tiêu đề không được bỏ trống',
            'ten_bai_viet.max'    => 'Tiêu đề không được quá 500 kí tự',
            'mo_ta_ngan.required'    => 'Mô tả ngắn không được bỏ trống',
            'mo_ta_ngan.max'       => 'Mô tả ngắn không quá 500 kí tự',
            'hinh_anh.required'    => 'Hình ảnh không được bỏ trống',
            'noi_dung.required' => 'Nội dung không được bỏ trống',
            
        ];
    }
}
