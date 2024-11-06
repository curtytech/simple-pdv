<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação para o formulário.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sell_price' => 'required|numeric|min:0',
            'barcode' => 'nullable|string|unique:products,barcode',
            'image' => 'nullable|string|max:255',
        ];
    }
}
