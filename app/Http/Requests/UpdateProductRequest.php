<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'    => 'required',
            'family'  => 'required',
            'active'  => 'required',
            'picture' => 'required|url',
        ];
    }

    public function attributes()
    {
        return [
            'picture' => 'foto'
        ];
    }
}
