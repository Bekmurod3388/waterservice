<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:clients,phone',
            'telegram_id' => 'nullable|integer',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'To\'liq ism kiritilishi shart.',
            'name.string' => 'Ism faqat matn bo\'lishi kerak.',
            'name.max' => 'Ism uzunligi 255 ta belgidan oshmasligi kerak.',
            'phone.required' => 'Telefon raqami kiritilishi shart.',
            'phone.string' => 'Telefon raqami faqat matn bo\'lishi kerak.',
            'phone.unique' => 'Bu telefon raqami allaqachon ro\'yxatdan o\'tgan.',
            'operator_dealer_id.integer' => 'Operator Dealer ID faqat butun son bo\'lishi kerak.',
            'telegram_id.integer' => 'Telegram ID faqat butun son bo\'lishi kerak.',
            'description.string' => 'Tavsif faqat matn bo\'lishi kerak.',
        ];
    }
}
