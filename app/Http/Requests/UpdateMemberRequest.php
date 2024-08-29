<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'email|unique:users,email,' . Auth::id(),
            'password' => 'nullable',
            'avatar' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
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
