<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:admins'],
            'password' => ['required', 'min:5', 'max:20']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'E-mail is required',
            'email.exists' => 'E-mail doesn\'t exist in our tables',
            'password.required' => 'Password is required',
        ];
    }
}
