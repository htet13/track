<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'joined_date' => 'required',
            'name' => 'required|string',
            'position' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'joined_date.required' => 'အလုပ်စဝင်သည့်ရက် ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'name.required' => 'အမည်ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'position.required' => 'ရာထူးရွေးချယ်ရန် လိုအပ်ပါသည်။'
        ];
    }
}
