<?php

namespace App\Http\Requests\Points;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'region_id' => 'required',
            'address' => '',
            'filter_id' => 'int',
            'filter_expire' => 'int',
            'dealer_id' => 'int',
            'demo_time' => '',
            'comment' => 'nullable|string'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'region_id.required' => 'Region ID maydoni to\'ldirilishi shart.',
            'address.string' => 'Manzil maydoni matn bo\'lishi kerak.',
            'address.max' => 'Manzil maydoni 255 ta belgidan oshmasligi kerak.',
            'filter_id.required' => 'Filter ID maydoni to\'ldirilishi shart.',
            'filter_expire.required' => 'Filter yaroqlilik muddati maydoni to\'ldirilishi shart.',
            'filter_expire.integer' => 'Filter yaroqlilik muddati son bo\'lishi kerak.',
        ];
    }
}
