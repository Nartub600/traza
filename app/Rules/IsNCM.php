<?php

namespace App\Rules;

use App\NCM;
use Illuminate\Contracts\Validation\Rule;

class IsNCM implements Rule
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
        $ncm = NCM::findByCategory($value);

        return !is_null($ncm);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No se reconoce la categoría NCM';
    }
}
