<?php

namespace App\Http\Requests\Products;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Разрешить выполнение запроса
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
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:0',

        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'quantity.required' => 'Son maydoni to\'ldirilishi shart.',
            'quantity.numeric' => 'Son maydoni raqam bo\'lishi kerak.',
            'quantity.min' => 'Son maydoni 0 dan kam bo\'lmasligi kerak.',
        ];
    }
}
