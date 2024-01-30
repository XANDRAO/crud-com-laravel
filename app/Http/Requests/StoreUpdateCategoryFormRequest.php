<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategoryFormRequest extends FormRequest
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
        $id = $this->segment('3');
        return [
            'title' => "required|min:3|max:60|unique:categories,title,{$id},id",
            'url' => "required|min:3|max:60|unique:categories,url,{$id},id",
            'title' => 'max:2000',
        ];
    }
}
