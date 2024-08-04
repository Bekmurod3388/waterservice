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
            'name' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'type' => 'required|in:' . implode(',', [Product::TYPE_FILTER, Product::TYPE_PRODUCT]),
            'service_price'=>'required|numeric|min:0'
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
            'name.required' => 'Ism maydoni to\'ldirilishi shart.',
            'name.string' => 'Ism maydoni matn bo\'lishi kerak.',
            'name.max' => 'Ism maydoni 255 ta belgidan oshmasligi kerak.',
            'quantity.required' => 'Mahsulot soni to\'ldirilishi shart.',
//            'quantity.numeric' => 'Son maydoni raqam bo\'lishi kerak.',
            'quantity.min' => 'Mahsulot Son 0 dan kam bo\'lmasligi kerak.',
        ];
    }
}
