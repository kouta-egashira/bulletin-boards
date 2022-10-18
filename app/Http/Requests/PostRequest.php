<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // このフォームリクエストを利用が許可されているかを示すアクション。(trueで許可)
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // バリデーション
    public function rules()
    {
        return [
            // タイトルは必須で20文字以内
            'title' => 'required|max:20',
            // bodyは必須
            'body'  => 'required',
        ];
    }

    // バリデーションメッセージ。（新規投稿で表示される）
    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.max'      => 'タイトルは20文字以内で記入してください。',
            'body.required'  => '内容は必須です。',
        ];
    }
}
