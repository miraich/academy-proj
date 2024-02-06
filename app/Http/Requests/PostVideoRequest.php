<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostVideoRequest extends FormRequest
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
            'video_heading' => 'required|string',
            //правило валидации url:youtube не работает, хотя пример есть в документации
            'video_link' => ['required', 'regex:|https?://(?:www\.)?youtube\.com/watch\?v=|', 'active_url'],
            'tags' => ['required', 'string', 'regex:|^(#[a-zA-Zа-яА-Я0-9]+ *)+$|'],
        ];
    }
}
