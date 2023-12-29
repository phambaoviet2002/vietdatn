<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LienHe extends FormRequest
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
            'ho_va_ten'             =>  'required|min:6|max:50',
            'email'                 =>  'required|email',
            'so_dien_thoai'         =>  'required|digits:10',
            'tieu_de'               =>  'required|min:6|max:50',
            'noi_dung'              =>  'required|min:6|max:50',
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
            'so_dien_thoai.required'        => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits'          => 'Số điện thoại phải có 10 chữ số',
            'tieu_de.required'              => 'Tiêu đề không được để trống',
            'tieu_de.min'                   => 'Tiêu đề phải từ 6 ký tự trở lên',
            'tieu_de.max'                   => 'Tiêu đề không được vượt quá 50 ký tự',
            'noi_dung.required'             => 'Nội dung không được để trống',
            'noi_dung.min'                  => 'Nội dung phải từ 6 ký tự trở lên',
            'noi_dung.max'                  => 'Nội dung không được vượt quá 50 ký tự',



        ];
    }
}
