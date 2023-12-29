<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaoHoaDonRequest extends FormRequest
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
            'ma_khach_hang'             =>  'required',
            'ho_va_ten'                 =>  'required',
            'so_dien_thoai'             =>  'required|digits:10',
            'dia_chi'                   =>  'required',
            'trang_thai_don'            =>  'required',
            'trang_thai_thanh_toan'     =>  'required',

        ];
    }
    public function messages(): array
    {
        return [
            'ma_khach_hang.required'            => 'Mã khách hàng không được để trống',
            'ho_va_ten.required'                => 'Họ và tên không được để trống',
            'trang_thai_don.required'           => 'Trạng thái đơn không được để trống',
            'so_dien_thoai.required'            => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits'              => 'Số điện thoại phải có 10 chữ số',
            'dia_chi.required'                  => 'Địa chỉ không được để trống',
            'trang_thai_thanh_toan.required'    => 'Trạng thái thanh toán không được để trống',
        ];
    }
}
