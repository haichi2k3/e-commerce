<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'id_category' => 'required',
            'brand' => 'required',
            'status' => 'required|in:0,1',
            'sale' => 'nullable|numeric',
            'company' => 'required|string|max:255',
            'images' => 'required|array|max:3',
            'images.*' => 'required|mimes:jpeg,jpg,png|max:1024',
            'detail' => 'required|string',

        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống.',
            'mimes' => ':attribute phải là hình ảnh có định dạng :values.',
        ];
    }
}
