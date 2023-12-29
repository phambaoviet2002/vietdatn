<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangNhap extends FormRequest
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
            'email'         => 'required|email',
            'password'      => 'required|min:6|max:300'
        ];
    }

    public function messages()
    {
        return[
            'email.required'    => 'Email không được bỏ trống',
            'email.email'       => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min'      => 'Mật khẩu phải từ 6 ký tự trở lên',
            'password.max'      => 'Mật khẩu không được vượt quá 30 ký tự'
        ];
    }
}
