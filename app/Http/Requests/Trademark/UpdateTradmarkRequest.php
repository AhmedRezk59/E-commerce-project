<?php

namespace App\Http\Requests\Trademark;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTradmarkRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:55'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'required',
            'name.string' => 'string',
            'name.min' => 'min 3',
            'name.max' => 'max 55',
        ];
    }
}
