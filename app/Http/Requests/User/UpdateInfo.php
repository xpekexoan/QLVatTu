<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfo extends FormRequest
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
            'HoTen' => 'required',
            'SDT' => 'required|regex:/[0-9]{10}/',
            'CMND' => 'required|regex:/[0-9]{9}/',
            'Email' => 'required|email',
            'NgaySinh' => 'required|date_format:d/m/Y',
        ];
    }

    public function messages()
    {
        return [
            'HoTen.required' => 'Họ tên không để trống',
            'SDT.required' => 'Số điện thoại không để trống',
            'SDT.regex' => 'Số điện thoại định dạng chưa đúng',
            'CMND.required' => 'CMND không để trống',
            'CMND.regex' => 'CMND định dạng chưa đúng',
            'Email.required' => 'Email không để trống',
            'Email.email' => 'Email định dạng chưa đúng',
            'NgaySinh.required' => 'Ngày sinh không để trống',
            'NgaySinh.date_format' => 'Ngày sinh định dạng chưa đúng',
        ];
    }
}
