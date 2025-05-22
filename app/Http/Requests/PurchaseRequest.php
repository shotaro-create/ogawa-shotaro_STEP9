<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認証済みのみ許可ならチェック追加
    }

    public function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1',
            'id' => 'required|exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => '数量を入力してください。',
            'quantity.integer' => '正確な数を入力してください。',
            'quantity.min' => '1以上の数を入力してください。',
            'id.exists' => '指定された商品は存在しません。',
        ];
    }
}
