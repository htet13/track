<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:cities,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'မြို့အမည်ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
