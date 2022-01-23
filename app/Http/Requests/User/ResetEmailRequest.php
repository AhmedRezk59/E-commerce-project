<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetEmailRequest extends FormRequest
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
            'email' => ['required', 'email' , 'exists:users,email']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The E-mail address is required',
            'email.email' => 'Please Enter a valid E-mail',
            'email.exists' => 'This E-mail doesn\'t exist in our tables',
        ];
    }
}