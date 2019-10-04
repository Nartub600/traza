<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLCMRequest extends FormRequest
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
            'type'                => 'required',
            'defeats'             => 'required',
            'number'              => 'required',
            'issued_at'           => 'required',
            'business_name'       => 'required',
            'address'             => 'required',
            'cuit'                => 'required',
            'country'             => 'required',
            'manufacturing_place' => 'required',
            'commercial_name'     => 'required',
            'brand'               => 'required',
            'model'               => 'required',
            'category'            => 'required',
            'version'             => 'required',
        ];
    }
}
