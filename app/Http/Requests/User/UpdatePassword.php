<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'MatKhau_current' => 'required',
            'MatKhau' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'MatKhau.required' => 'Mật khẩu không để trống',
            'MatKhau.min' => 'Mật khẩu tối đa 6 kí tự',
            'MatKhau.required' => 'Mật khẩu không để trống',
            'MatKhau.confirmed' => 'Mật khẩu nhập lại chưa trùng khớp'
        ];
    }
}
