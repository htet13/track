<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarNoUpdateRequest extends FormRequest
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
            'name' => 'required|string|unique:car_nos,name,'.$this->car_no->id,
            'category' => 'nullable'
        ];
    }
}
