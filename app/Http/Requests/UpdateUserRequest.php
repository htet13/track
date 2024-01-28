<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => [
                'required',
                'unique:users,email,' . request()->segment(3),
            ],
            'password' => [
                'nullable',
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
}
