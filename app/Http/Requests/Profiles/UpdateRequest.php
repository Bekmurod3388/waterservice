<?php

namespace App\Http\Requests\Profiles;

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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
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
            'phone.unique' => 'Bu telefon raqami allaqachon mavjud.',
        ];
    }
}
