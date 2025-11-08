<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'description' => 'required|string|max:300',
            'price' =>  'required|numeric|min:0',
            'image' => 'required|image|max:2048'
        ];
    }

    public function messages() :array{
        return [
             'name.required' => 'اسم المنتج مطلوب',
            'description.required' => 'الوصف مطلوب',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب أن يكون رقمًا',
            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.mimes' => 'يجب أن تكون الصورة بصيغة jpeg أو png أو jpg أو webp',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت',
        ];
    }
}
