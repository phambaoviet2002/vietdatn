<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoiMatKhauHoSoRQ extends FormRequest
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
            'password_new'              =>  'required|min:6|max:30',
            'password_retype'           =>  'required|same:password_new',
        ];
    }

    public function messages(): array
    {
        return [
            'password_new.required'             => 'Mật khẩu không được để trống',
            'password_new.min'                  => 'Mật khẩu phải từ 6 ký tự trở lên',
            'password_new.max'                  => 'Mật khẩu không được vượt quá 30 ký tự',
            'password_retype.required'          => 'Nhập lại mật khẩu không được để trống',
            'password_retype.same'              => 'Mật khẩu nhập lại không khớp',
        ];
    }
    
}
