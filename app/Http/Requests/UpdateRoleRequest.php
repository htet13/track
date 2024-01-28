<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
                'string',
                'required',
            ],
            'permissions' => [
                'required',
                'array',
            ],
        ];
    }
}
