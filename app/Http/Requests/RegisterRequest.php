<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:30'],
            'email' => ['required', 'max:100', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:30', 'confirmed'],

        ];
    }
    public function messages()
    {
        return [
            'username.required' => '名前が未入力です',
            'email.required' => 'メールアドレスが未入力です。',
            'email.email' => 'メール形式で入力してください。',
            'email.unique' => 'このメールアドレスは登録済みです。',
            'password.required' => 'パスワードが未入力です。',
            'password.min' => 'パスワードは8文字以上で設定してください。',
            'password.confirmed' => 'パスワードが異なります。',
        ];
    }
}
