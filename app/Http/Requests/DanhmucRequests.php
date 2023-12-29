<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DanhmucRequests extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "ten_danh_muc" => "required|unique:danh_muc,ten_danh_muc",
        ];
    }
    public function messages(): array
    {
        return [
            "ten_danh_muc.required"  =>   "Tên danh mục không được để trống",
            "ten_danh_muc.unique"    =>   "Tên danh mục đã tồn tại",
        ];
    }

}