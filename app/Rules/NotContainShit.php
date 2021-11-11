<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotContainShit implements Rule
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
        if (strpos($value, 'SHIT') !== false) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return response()->json(
            [
                'errors' => [
                    'log' => "Bad word! Don't use SHIT. Please!!!"
                ]
            ], 422);
    }
}
