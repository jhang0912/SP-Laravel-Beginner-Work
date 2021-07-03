<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInPostRequest extends APIRequest
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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute為必填欄位，請重新填寫。',
            'email' => 'email格式錯誤，請重新確認'
        ];
    }
}
