<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class capnhatMagiamgiaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            
            "tien_giam_gia" => "required|numeric|min:0",
            "so_luong" => "required|numeric|min:0",
        ];
    }
    public function messages(): array
    {
        return [
            
            "tien_giam_gia.required"    =>   "Mức giảm giá không được để trống",
            "tien_giam_gia.numeric"    =>   "Mức giảm giá phải là số",
            "tien_giam_gia.min"    =>   "Mức giảm giá không nhỏ hơn 0",
            "so_luong.required"    =>   "Số lượng không được để trống",
            "so_luong.numeric"    =>   "Số lượng giá phải là số",
            "so_luong.min"    =>   "Số lượng giá không nhỏ hơn 0",
        ];
    }
}
