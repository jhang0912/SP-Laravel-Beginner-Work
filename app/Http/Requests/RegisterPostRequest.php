<?php

namespace App\Http\Requests;

class RegisterPostRequest extends APIRequest
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
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute為必填欄位，請重新填寫。',
            'confirmed' => '密碼確認錯誤，請再次輸入'
        ];
    }
}
