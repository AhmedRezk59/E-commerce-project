<?php

namespace App\Http\Requests\Size;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSizeRequest extends FormRequest
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
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'is_public' => ['required', 'in:yes,no'],
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
            'department_id.required' => 'required',
            'department_id.integer' => 'integer',
            'department_id.exists' => 'exists',
            'is_public.required' => 'required',
            'is_public.in' => 'in',
        ];
    }
}
