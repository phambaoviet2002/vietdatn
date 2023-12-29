<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TKQuanTriRequest extends FormRequest
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
            'ten_tai_khoan'         =>  'required|min:6|max:50',
            'email'                 =>  'required|email|unique:tai_khoan,email',
            'password'              =>  'required|min:6|max:30',
            'nhap_lai_password'     =>  'required|same:password',
            'so_dien_thoai'         =>  'required|digits:10',
            'dia_chi'               =>  'required|min:6|max:50',
            'loai_tai_khoan'        =>  'required',

        ];
    }
    public function messages(): array
    {
        return [
            'ten_tai_khoan.required'        => 'Họ và tên không được để trống',
            'ten_tai_khoan.min'             => 'Họ và tên phải từ 6 ký tự trở lên',
            'ten_tai_khoan.max'             => 'Họ và tên không được vượt quá 50 ký tự',
            'email.required'                => 'Email không được để trống',
            'email.email'                   => 'Email không đúng định dạng',
            'email.unique'                  => 'Email đã tồn tại',
            'password.required'             => 'Mật khẩu không được để trống',
            'password.min'                  => 'Mật khẩu phải từ 6 ký tự trở lên',
            'password.max'                  => 'Mật khẩu không được vượt quá 30 ký tự',
            'nhap_lai_password.required'    => 'Nhập lại mật khẩu không được để trống',
            'nhap_lai_password.same'        => 'Mật khẩu nhập lại không khớp',
            'so_dien_thoai.required'        => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits'          => 'Số điện thoại phải có 10 chữ số',
            'dia_chi.required'              => 'Địa chỉ không được để trống',
            'dia_chi.min'                   => 'Địa chỉ phải từ 6 ký tự trở lên',
            'dia_chi.max'                   => 'Địa chỉ không được vượt quá 50 ký tự',
            'loai_tai_khoan.required'       => 'Loại tài khoản không được để trống',

        ];
    }
}
