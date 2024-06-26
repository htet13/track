<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarNoStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:car_nos,name',
            'category' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'ကားနံပါတ်ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
