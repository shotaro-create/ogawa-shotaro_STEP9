<?php

namespace App\Http\Requests;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        // フォームバリデーションルールを設定
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages(): array
    {
        // 各バリデーションルールに対するエラーメッセージ
        return [
            'name.required' => '名前は必須です。',
            'name.max' => 'お名前は255文字以内で入力してください。',
            'email.required' => 'Eメールは必須です。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'message.required' => '内容は必須です。',
        ];
    }
}
