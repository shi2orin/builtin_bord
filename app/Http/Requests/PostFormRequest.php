<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:100'],
            'post_body' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages()
    {
        return
            [
                'title.required' => '※タイトルは必須です。',
                'title.max' => '※タイトルは100文字以内で記入してください。',
                'post_body.required' => '※投稿内容は必須です。',
                'post_body.max' => '※投稿内容は5000文字以内で記入してください。',
            ];
    }
}
