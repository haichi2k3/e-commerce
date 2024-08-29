<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;


class MemberRequest extends FormRequest
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
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string|max:15', 
            'select-country' => 'nullable',
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống.',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute phải là hình ảnh có định dạng :values',
            'max' => ':attribute không được vượt quá :max KB',
            'confirmed' => ':attribute xác nhận không khớp',
        ];
    }
}
