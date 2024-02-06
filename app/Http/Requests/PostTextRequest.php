<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTextRequest extends FormRequest
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
            'text_heading' => 'required|string',
            'description' => 'required|string|max:70',
            'tags' => ['required', 'string', 'regex:|^(#[a-zA-Zа-яА-Я0-9]+ *)+$|'],
        ];
    }
}
