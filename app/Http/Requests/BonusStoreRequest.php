<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BonusStoreRequest extends FormRequest
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
            'date' => 'required',
            'employee_id' => 'required|string',
            'bonus_type' => 'required|string',
            'amount' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'ရက်စွဲရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'employee_id.required'  => 'ဝန်ထမ်းရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'bonus_type.required'  => 'အပိုဆုကြေးအမျိုးအစားရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'amount.required' => 'ပမာဏထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
