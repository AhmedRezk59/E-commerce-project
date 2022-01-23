<?php

namespace App\Http\Requests\Weight;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightRequest extends FormRequest
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
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
        ];
    }
    public function messages()
    {
        return [
            'name_ar.required' => 'required',
            'name_ar.string' => 'string',
            'name_en.required' => 'required',
            'name_en.string' => 'string',
        ];
    }
}
