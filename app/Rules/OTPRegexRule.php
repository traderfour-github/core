<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OTPRegexRule implements Rule
{
    public const REGEX = '/^(\+\d{1,3}[- ]?)?\d{10}$/';

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $validateEmail = Validator::make([$attribute => $value], [
            'id' => 'required|email'
        ]);

        return (bool)preg_match(self::REGEX, $value) || $validateEmail->passes();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid mobile or email.';
    }
}
