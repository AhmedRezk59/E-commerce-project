<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => ['required' , 'min:5' , 'max:20'],
            'password_confirmation' => ['required' , 'min:5' , 'max:20' , 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password is required'
        ];
    }
}
