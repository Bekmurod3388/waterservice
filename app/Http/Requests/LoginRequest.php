<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone' => 'required|numeric',
            'password' => 'required|string',
            'role' => 'required|string|in:dealer,agent,cashier'
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Telefon raqami kiritilishi shart.',
            'phone.numeric' => 'Telefon raqami faqat raqamlardan iborat bo\'lishi kerak.',
            'password.required' => 'Parol kiritilishi shart.',
            'password.string' => 'Parol matn turida bo\'lishi kerak.',
        ];
    }
}
