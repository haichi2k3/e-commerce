<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống.',
            'image' => ':attribute phải là hình ảnh.',
            'mimes' => ':attribute phải là hình ảnh có định dạng :values.',
            'max' => ':attribute không được vượt quá :max KB.',
        ];
    }
}
