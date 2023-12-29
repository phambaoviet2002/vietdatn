<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuenMatKhauHoSoRQ extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'                 =>  'required|email|exists:tai_khoan,email',
            // 'g-recaptcha-response'  => 'required|captcha',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'          =>  'Email không được để trống',
            'email.email'             =>  'Email không đúng định dạng',
            'email.exists'            =>  'Email không tồn tại trong hệ thống',
            // 'g-recaptcha-response.*'  =>  'Vui lòng phải chọn vào recaptcha',
        ];
    }

    
}
