<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackStoreRequest extends FormRequest
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
            'fromcities.*' => [
                'string',
            ],
            'fromcities' => [
                'required',
                'array',
            ],
            'tocities.*' => [
                'string',
            ],
            'tocities' => [
                'required',
                'array',
            ],
            'date' => 'required',
            'car_no_id' => 'required',
            'expense' => 'required',
            'issuer_id' => 'required',
            'driver_id' => 'required',
            'spare_id'  => 'required',
            'check_cost' => 'required',
            'gate_cost' => 'required',
            'food_cost' =>  'required',
            'total'     =>  'required',
            'remark'    =>  'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'fromcities.required' => 'ဖမ်းမည့်မြို့ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'tocities.required' => 'ပို့မည့်မြို့ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'date.required' => 'ရက်စွဲ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'car_no_id.required' => 'ကားနံပါတ် ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'expense.required' => 'စရိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'issuer_id.required' => 'ထုတ်ပေးသူ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'driver_id.required' => 'ယာဉ်မောင်း ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'spare_id.required' => 'ယာဉ်နောက်လိုက် ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'check_cost.required' => 'ရဲ/စစ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'gate_cost.required' => 'တိုးဂိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'food_cost.required' => 'စားစရိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'total.required' => 'စုစုပေါင်း ထည့်သွင်းရန် လိုအပ်ပါသည်။',
        ];
    }

}
