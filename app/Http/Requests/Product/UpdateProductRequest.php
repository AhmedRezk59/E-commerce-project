<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'content' => ['required', 'string', 'min:2', 'max:55'],
            'department_id' => ['sometimes', 'nullable', 'integer'],
            'trademark_id' => ['sometimes', 'nullable', 'integer'],
            'color_id' => ['sometimes', 'nullable', 'integer'],
            'size' => ['sometimes', 'nullable', 'string'],
            'size_id' => ['sometimes', 'nullable', 'integer'],
            'price' => ['required', 'numeric'],
            'start_at' => ['sometimes', 'nullable','date'],
            'price_offer' => ['sometimes', 'nullable', 'numeric'],
            'start_offer_at' => ['sometimes', 'nullable','date', 'after_or_equal:start_at'],
            'end_offer_at' => ['sometimes', 'nullable','date', 'after:start_offer_at'],
            'weight' => ['required', 'string'],
            'weight_id' => ['required', 'integer'],
            'stock' => ['sometimes', 'nullable', 'integer'],
            'other_data' => ['sometimes', 'nullable', 'string', 'min:55'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'required',
            'title.string' => 'string',
            'title.min' => 'min 2',
            'title.max' => 'max 255',
            'content.required' => 'required',
            'content.string' => 'string',
            'content.min' => 'min 2',
            'content.max' => 'max 255',
            'department_id.integer' => 'integer',
            'trademark_id.integer' => 'integer',
            'color_id.integer' => 'integer',
            'size.string' => 'string',
            'size_id.integer' => 'integer',
            'price.required' => 'required',
            'price.numeric' => 'numeric',
            'start_at.date' => 'date',
            'start_at.after' => 'start after',
            'price_offer.numeric' => 'numeric',
            'start_offer_at.date' => 'date',
            'start_offer_at.after_or_equal' => 'after_or_equal',
            'end_offer_at.date' => 'date',
            'end_offer_at.after' => 'after offer',
            'weight.required' => 'required',
            'weight.string' => 'string',
            'weight_id.required' => 'required',
            'weight_id.integer' => 'integer',
            'stock.integer' => 'integer',
            'other_data.string' => 'string',
            'other_data.min' => 'min 55',
        ];
    }
}
