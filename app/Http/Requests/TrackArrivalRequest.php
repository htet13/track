<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackArrivalRequest extends FormRequest
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
            
            'check_cost' => 'required',
            'gate_cost' => 'required',
            'food_cost' =>  'required',
            'remark'    =>  'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'oil.price.*.required' => 'ဈေးနှုန်းထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'oil.liter.*.required' => 'လီတာထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'check_cost.required' => 'ရဲ/စစ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'gate_cost.required' => 'တိုးဂိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'food_cost.required' => 'စားစရိတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
        ];
    }

}
