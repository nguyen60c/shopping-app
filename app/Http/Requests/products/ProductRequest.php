<?php

namespace App\Http\Requests\products;

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
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|min:3",
            "slug" => "required|min:3",
            "details" => "required|min:3",
            "price" => "required|numeric|gt:0",
            "shipping_cost" => "required|numeric|gt:0",
            "category_id" => "",
            "brand_id" => "",
            "image_path" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }
}
