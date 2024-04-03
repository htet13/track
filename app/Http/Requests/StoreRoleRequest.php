<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('User Access');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'permissions' => [
                'required',
                'array',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'အမည်ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'permissions.required' => 'permission ရွေးချယ်ရန် လိုအပ်ပါသည်။'
        ];
    }
}
