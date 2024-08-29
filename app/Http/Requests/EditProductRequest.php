<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'id_category' => 'required',
            'brand' => 'required',
            'company' => 'required',
            'images' => 'nullable|max:3',
            'images.*' => 'nullable|mimes:jpeg,jpg,png,gif|max:1024',
            'detail' => 'required|',
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
