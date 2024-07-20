<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'phone' => 'required|string|max:9|min:9|unique:users,phone',
            'roles' => 'required',
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
            'phone.required' => 'Telefon raqami maydoni to\'ldirilishi shart.',
            'phone.string' => 'Telefon raqami maydoni matn bo\'lishi kerak.',
            'phone.max' => 'Telefon raqami 9 ta belgidan oshmasligi kerak.',
            'phone.min' => 'Telefon raqami 9 ta belgidan kam bo\'lmasligi kerak.',
            'phone.unique' => 'Bu telefon raqami allaqachon mavjud.',
            'roles.required' => 'Rol maydoni to\'ldirilishi shart.',
        ];
    }
}
