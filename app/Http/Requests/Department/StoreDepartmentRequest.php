<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
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
            'description' => ['string', 'sometimes', 'nullable', 'min:3', 'max:255'],
            'keyword' => ['string', 'sometimes', 'nullable', 'min:3', 'max:255',],
            'parent' => ['sometimes', 'nullable', 'integer', 'exists:departments,id']
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
            'description.string' => 'string',
            'description.min' => 'min 3',
            'description.max' => 'max 255',
            'keyword.string' => 'string',
            'keyword.min' => 'min 3',
            'keyword.max' => 'max 255',
            'parent.integer' => 'integer',
            'parent.exists' => 'exists',
        ];
    }
}
