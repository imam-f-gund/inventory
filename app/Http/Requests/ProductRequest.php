<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'brand' => 'required',
            'qty' => request()->method() == 'POST' ? 'required' : 'nullable',
            'category_id' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'image' => request()->method() == 'POST' ? 'required' : 'nullable',
        ];
    }
}
