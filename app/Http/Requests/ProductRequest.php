<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'type'        => 'required|in:premium,standard',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'  => 'Product name is required',
            'price.required' => 'Price is required',
            'price.numeric'  => 'Price must be a number',
            'stock.integer'  => 'Stock must be an integer',
            'type.in'        => 'Type must be premium or standard',
        ];
    }
}
