<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
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
            'content' => 'required',
            'file' => 'required'
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'Vui lòng nhập tên tin tức',
            'file.required' => 'Vui lòng chọn ảnh mô tả',
            'content.required' => 'Vui lòng nhập nội dung'
        ];
    }
}
