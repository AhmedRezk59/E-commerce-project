<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
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
            'name_ar' => ['required', 'string', 'min:3', 'max:55'],
            'name_en' => ['required', 'string', 'min:3', 'max:55'],
            'color' => ['required', 'string'],
        ];
    }
    public function messages()
    {
        return [
            'name_ar.required' => 'required',
            'name_ar.string' => 'string',
            'name_ar.min' => 'min 2',
            'name_ar.max' => 'max 255',
            'name_en.required' => 'required',
            'name_en.string' => 'string',
            'name_en.min' => 'min 2',
            'name_en.max' => 'max 255',
            'color.required' => 'required',
            'color.string' => 'string',
        ];
    }
}
