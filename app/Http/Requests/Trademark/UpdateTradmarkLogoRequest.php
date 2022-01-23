<?php

namespace App\Http\Requests\Trademark;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTradmarkLogoRequest extends FormRequest
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
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
    public function messages()
    {
        return [
            'logo.required' => 'required',
            'logo.image' => 'image',
            'logo.mimes' => 'logo mimes',
        ];
    }
}
