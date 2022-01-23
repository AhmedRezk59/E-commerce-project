<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'is_super' => ['required', 'boolean'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'required',
            'name.string' => 'string',
            'name.max' => 'max 255',
            'email.required' => 'required',
            'email.email' => 'email',
            'email.max' => 'max 255',
            'email.unique' =>'unique',
            'is_super.required' => 'required',
            'password.required' => 'required',
            'password.string' =>'string',
            'password.min' => 'min 8',
            'password_confirmation.required' => 'required',
            'password_confirmation.string' => 'string',
            'password_confirmation.min' => 'min 8',
            'password_confirmation:same' => 'same',
        ];
    }
}
