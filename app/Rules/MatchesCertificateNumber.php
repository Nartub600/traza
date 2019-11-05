<?php

namespace App\Rules;

use App\Certificate;
use Illuminate\Contracts\Validation\Rule;

class MatchesCertificateNumber implements Rule
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
        $certificate = Certificate::where('number', $value['license'])->first();

        return !is_null($certificate);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No existe una licencia para la fila :attribute';
    }
}
