<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangKy extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'             =>  'required|min:6|max:50',
            'email'                 =>  'required|email|unique:khach_hang,email',
            'password'              =>  'required|min:6|max:30',
            'nhap_lai_password'     =>  'required|same:password',
            'so_dien_thoai'         =>  'required|digits:10',
            'dia_chi'               =>  'required|min:6|max:50',
            'gioi_tinh'             =>  'required|numeric|min:0|max:1',
            'ngay_sinh'             =>  'required|date',
            // 'g-recaptcha-response'  => 'required|captcha',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required'            => 'Họ và tên không được để trống',
            'ho_va_ten.min'                 => 'Họ và tên phải từ 6 ký tự trở lên',
            'ho_va_ten.max'                 => 'Họ và tên không được vượt quá 50 ký tự',
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
            'gioi_tinh.required'            => 'Vui lòng chọn giới tính',
            'gioi_tinh.numeric'             => 'Giới tính phải là một số',
            'gioi_tinh.min'                 => 'Giới tính phải chọn theo yêu cầu',
            'gioi_tinh.max'                 => 'Giới tính phải chọn theo yêu cầu',
            'ngay_sinh.required'            => 'Ngày sinh không được để trống',
            'ngay_sinh.date'                => 'Ngày sinh không đúng định dạng',
            // 'g-recaptcha-response.required' => 'Vui lòng chọn recaptcha',
            // 'g-recaptcha-response.captcha'  => 'Recaptcha không hợp lệ',
        ];
    }
}
