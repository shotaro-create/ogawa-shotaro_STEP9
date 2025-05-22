<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // 検索欄のバリデーションを定義
    public function rules(): array
    {
        return [
            'product_name' => 'nullable|string|max:255',
            'price_min' => 'nullable|integer|min:0',
            'price_max' => 'nullable|integer|min:0',
        ];
    }

    
}
