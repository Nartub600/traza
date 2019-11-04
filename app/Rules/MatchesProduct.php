<?php

namespace App\Rules;

use App\Product;
use Illuminate\Contracts\Validation\Rule;

class MatchesProduct implements Rule
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
        $category = implode('.', array_filter([$value['product'], $value['family']]));

        $product = Product::findByCategory($category);

        return !is_null($product);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No se reconoce el producto/familia en la fila :attribute';
    }
}
