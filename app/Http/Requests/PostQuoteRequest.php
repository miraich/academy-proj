<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostQuoteRequest extends FormRequest
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
            'quote_heading' => 'required|string',
            'quote_text' => 'required|string|max:70',
            'quote_author' => 'required|string',
            'tags' => ['required', 'string', 'regex:|^(#[a-zA-Zа-яА-Я0-9]+ *)+$|'],
        ];
    }
}
