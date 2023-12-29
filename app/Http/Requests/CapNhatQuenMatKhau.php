<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatQuenMatKhau extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'password'              =>  'required|min:6|max:30',
            'nhap_lai_password'     =>  'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required'             => 'Mật khẩu không được để trống',
            'password.min'                  => 'Mật khẩu phải từ 6 ký tự trở lên',
            'password.max'                  => 'Mật khẩu không được vượt quá 30 ký tự',
            'nhap_lai_password.required'    => 'Nhập lại mật khẩu không được để trống',
            'nhap_lai_password.same'        => 'Mật khẩu nhập lại không khớp',
        ];
    }
}
