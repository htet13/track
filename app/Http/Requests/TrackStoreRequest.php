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
            'oil.price.*' => [
                'required'
            ],
            'oil.price' => [
                'array',
            ],
            'oil.liter.*' => [
                'required'
            ],
            'oil.liter' => [
                'array',
            ],
            'driver.driver_id.*' => [
                'required'
            ],
            'driver.driver_id' => [
                'array',
            ],
            'driver.fee.*' => [
                'required'
            ],
            'driver.fee' => [
                'array',
            ],
            'driver.is_paid.*' => [
                'required'
            ],
            'driver.is_paid' => [
                'array',
            ],
            'spare.spare_id.*' => [
                'required'
            ],
            'spare.spare_id' => [
                'array',
            ],
            'spare.fee.*' => [
                'required'
            ],
            'spare.fee' => [
                'array',
            ],
            'spare.is_paid.*' => [
                'required'
            ],
            'spare.is_paid' => [
                'array',
            ],
            'date' => 'required',
            'car_no_id' => 'required',
            'expense' => 'required',
            'issuer_id' => 'required',
            'check_cost' => 'required',
            'gate_cost' => 'required',
            'food_cost' =>  'required',
            'remark'    =>  'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'fromcities.required' => 'ဖမ်းမည့်မြို့ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'tocities.required' => 'ပို့မည့်မြို့ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'oil.price.*.required' => 'ဈေးနှုန်းထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'oil.liter.*.required' => 'လီတာထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'driver.driver_id.*.required' => 'ယာဉ်မောင်းအမည်ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'driver.fee.*.required' => 'ခေါက်ကြေးထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'driver.is_paid.*.required' => 'ရှင်းပြီး/ မရှင်းရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'driver.driver_id.*.required' => 'ယာဉ်နောက်လိုက်အမည်ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'driver.fee.*.required' => 'ခေါက်ကြေးထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'driver.is_paid.*.required' => 'ရှင်းပြီး/ မရှင်းရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'date.required' => 'ရက်စွဲ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'car_no_id.required' => 'ကားနံပါတ် ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'expense.required' => 'စရိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'issuer_id.required' => 'ထုတ်ပေးသူ ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'driver_id.required' => 'ယာဉ်မောင်း ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'spare_id.required' => 'ယာဉ်နောက်လိုက် ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'drive_fee.required' => 'ခေါက်ကြေး ရွေးချယ်ရန် လိုအပ်ပါသည်။',
            'check_cost.required' => 'ရဲ/စစ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'gate_cost.required' => 'တိုးဂိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'food_cost.required' => 'စားစရိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'total.required' => 'စုစုပေါင်း ထည့်သွင်းရန် လိုအပ်ပါသည်။',
        ];
    }

}
