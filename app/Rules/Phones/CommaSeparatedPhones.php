<?php

namespace App\Rules\Phones;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CommaSeparatedPhones implements Rule
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
        return !Validator::make(
            [
                "{$attribute}" => explode(',', $value)
            ],
            [
                "{$attribute}.*" => ['required', 'regex:/(09)[0-9]{9}$|(\+63)[0-9]{10}$/']
            ]
        )->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must have valid mobile numbers. Ex: ( +63 + 10 digit number ) OR ( 09 + 9 digit number ).';
    }
}
