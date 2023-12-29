<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class binhluantintucRequest extends FormRequest
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
            "noi_dung" => "required|string|max:250",
            
        ];
    }
    public function messages(): array
    {
        return [
            "noi_dung.required"  =>   "Nội dung không được để trống",
            "noi_dung.max"    =>   "Nội dung không quá hơn 250 kí tự",
           
        ];
    }
}
