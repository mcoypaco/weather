<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use League\ISO3166\ISO3166;

class ValidCountryCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            (new ISO3166)->alpha2($value);

            return true;
        } catch (\Throwable$th) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The country code is invalid.';
    }
}
