<?php

namespace App\Rules;

use App\LCM;
use Illuminate\Contracts\Validation\Rule;

class MatchesLCM implements Rule
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
        $lcm = LCM::where('number', $value['lcm'])
            ->where('brand', $value['brand'])
            ->where('model', $value['model'])
            ->where('origin', $value['origin'])
            ->whereNull('cape')
            ->first();

        return !is_null($lcm);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La fila :attribute no coincide con una LCM';
    }
}
