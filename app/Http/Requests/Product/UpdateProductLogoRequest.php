<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductLogoRequest extends FormRequest
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
            'photo' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }

    public function messages()
    {
        return [
            'photo.required' => 'required',
            'photo.image' => 'image',
            'photo.mimes' => 'logo mimes',
        ];
    }
}
