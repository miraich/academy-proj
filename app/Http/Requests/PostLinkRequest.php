<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLinkRequest extends FormRequest
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
            'link_heading' => 'required|string',
            'post_link' => 'required|active_url',
            'tags' => ['required', 'string', 'regex:|^(#[a-zA-Zа-яА-Я0-9]+ *)+$|'],
        ];
    }
}
