<?php

namespace App\Http\Requests\XetDuyet;

use Illuminate\Foundation\Http\FormRequest;

class XetDuyetRequest extends FormRequest
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
            'Gia' => 'required',
            'NgayDuKien' => 'required'
        ];
    }
}
