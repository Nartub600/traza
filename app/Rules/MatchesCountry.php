<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MatchesCountry implements Rule
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
        $country = Country::where('name', $value['origin'])->first();

        return !is_null($country);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No se encuentra el país de la fila :attribute';
    }
}
