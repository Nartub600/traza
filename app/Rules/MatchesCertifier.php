<?php

namespace App\Rules;

use App\Autopart;
use Illuminate\Contracts\Validation\Rule;

class MatchesCertifier implements Rule
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
        $autopart = Autopart::where('brand', $value['brand'])
            ->where('model', $value['model'])
            ->where('origin', $value['origin'])
            ->whereNull('chas')
            ->first();

        return $autopart->certificate->user->groups->map->name->contains($value['certifier']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No coincide el organismo certificador para la fila :attribute';
    }
}
