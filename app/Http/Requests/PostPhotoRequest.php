<?php

namespace App\Http\Requests;

use App\Rules\CheckIsFilled;
use App\Rules\CheckLinkRule;
use App\Rules\TagRule;
use Illuminate\Foundation\Http\FormRequest;

class PostPhotoRequest extends FormRequest
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
            'photo_heading' => 'required|string',
            'link' => ['nullable', new CheckLinkRule,],
            'tags' => ['required', 'string', 'regex:|^(#[a-zA-Zа-яА-Я0-9]+ *)+$|'],
            'userpic-file-photo' => ['required_without:link', 'image']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'link.required' => 'Загрузите файл, либо введите ссылку',
            'tags.regex' => 'Теги должны быть разделены пробелом и начинаться с #'
        ];
    }
}
