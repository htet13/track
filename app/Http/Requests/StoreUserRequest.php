<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'roles.*' => [
                'string',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'အမည်ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'email.required' => 'အီးမေးလ်ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'roles.required' => 'role ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'password.required' => 'လျှို့ဝှက်နံပါတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
