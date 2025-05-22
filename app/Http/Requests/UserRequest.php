<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            // バリデーションのルールを定義
            'user_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
            'name_kanji' => 'required|max:255',
        ];
    }

        public function messages () :array
        {
            return[
                'user_name.required' => 'ユーザー名を入力してください',
                'user_name.max' => 'ユーザー名は255文字以内で入力してください',
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => 'メールアドレスの形式が正しくありません',
                'email.max' => 'メールアドレスは255文字以内で入力してください',
                'password.required' => 'パスワードを入力してください',
                'password.min' => 'パスワードは8文字以上で入力してください',
                'password.max' => 'パスワードは255文字以内で入力してください',
                'name_kanji.required' => '名前を入力してください',
                'name_kanji.max' => '名前は255文字以内で入力してください',
            ];
        }
}
