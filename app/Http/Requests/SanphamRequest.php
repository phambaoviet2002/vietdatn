<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanphamRequest extends FormRequest
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

            'ten_san_pham' => 'required',
            'gia_san_pham' => 'required',
            'giam_gia_san_pham' => 'required',
            'hinh_anh' => 'required',
            'so_luong' => 'required',
            'luot_xem' => 'required',
            'dat_biet' => 'required',
            'mo_ta' => 'required',

        ];
    }
}