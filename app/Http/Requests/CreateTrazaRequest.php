<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTrazaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'number' => 'required',
            'user' => 'required',
            'division' => 'required',
            'sector' => 'required',
            'tag' => 'required',
            'validation' => 'required',
            'signature' => 'required',
            'auth_level' => 'required',
        ];
    }
}
