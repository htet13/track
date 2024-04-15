<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryStoreRequest extends FormRequest
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
            'payment_date' => 'required|date',
            'is_paid' => 'required|string',
            'remark' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'payment_date.required' => 'ငွေရှင်းသည့်ရက်စွဲရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'is_paid.required'  => 'ရှင်းပြီး/ မရှင်း ရွေးချယ်ရန် လိုအပ်ပါသည်။',
        ];
    }
}
