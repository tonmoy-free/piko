<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
          'category_name'=>'required|unique:categories',
          'category_image' => 'required',
          'category_image' => 'mimes:jpg,bmp,png', //'image'= dile sob image nibe.
          'category_image' => 'max:1024',
        ];
    }
    public function messages(): array
    {
        return [
          'category_name.required'=>'Category name lagbe.',

        ];
    }
}

