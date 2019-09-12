<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
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
            'number' => 'required|numeric',
            'cuit' => [
                'required',
                'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'
            ],
            'autoparts' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'autoparts.required' => 'Debe cargar al menos una autoparte'
        ];
    }
}
