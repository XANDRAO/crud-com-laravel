<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     public function rules(): array
     {
        return [
            'name'        => 'required|min:3|max:100|unique:products,name',
            'url'         => 'required|min:3|max:100|:products,url',
            'price'       => 'required|numeric',
            'description' => 'nullable|max:9000',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}