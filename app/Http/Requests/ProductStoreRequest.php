<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'sell_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'barcode' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'name.max' => 'O nome do produto não pode ter mais que 255 caracteres.',
            'sell_price.required' => 'O preço de venda do produto é obrigatório.',
            'sell_price.min' => 'O preço de venda do produto deve ser maior que zero.',
            'description.nullable' => 'A descrição do produto é obrigatória.',
            'barcode.nullable' => 'O código de barras do produto é obrigatório.',
            'image.required' => 'A imagem do produto é obrigatória.',
        ];
    }
}
