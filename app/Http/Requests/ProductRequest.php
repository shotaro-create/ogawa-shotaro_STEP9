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
        // アクセスしたすべてのユーザーを許可
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
            //バリデーションのルールを定義
            'product_name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required',
            'img_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required',
        ];
    }

    public function messages () :array
    {
        return [
            'product_name.required' => '商品名を入力してください',
            'product_name.max' => '商品名は255文字以内で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以内で入力してください',
            'price.required' => '価格を入力してください',
            'stock.required' => '在庫数を入力してください',
            'img_path.required' => '画像は必須です。',
            'img_path.image' => '画像を選択してください',
            'img_path.mimes' => '画像の形式はjpeg,png,jpg,gifのみ有効です',
            'img_path.max' => '画像のサイズは2048KB以下である必要があります',
        ];
    }
}
