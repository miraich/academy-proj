<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckLinkRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (isset($value)) {
            if (!file_get_contents($value)) {
                $fail("По данной ссылке не получилось загрузить файл");
            }
            $mime = ['png', 'jpeg', 'jpg'];
            $extension = pathinfo(parse_url($value, PHP_URL_PATH), PATHINFO_EXTENSION);
            if (!in_array($extension, $mime)) {
                $fail("Загружаемый файл должен быть изображением");
            }
        }
    }
}
