<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCertificateRequest extends FormRequest
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
            'number' => 'required_without:certificates|numeric',
            'cuit' => [
                'required_without:certificates',
                'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'
            ],
            'autoparts' => 'required_without:certificates|array',
            'certificates.*.number' => 'required_without:number|numeric',
            'certificates.*.cuit' => [
                'required_without:cuit',
                'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'
            ],
            'certificates.*.autoparts' => 'required_without:autoparts|array'
        ];
    }

    public function attributes()
    {
        return [
            'cuit' => 'CUIT',
            'number' => 'número'
        ];
    }

    public function messages()
    {
        return [
            'autoparts.required' => 'Debe cargar al menos una autoparte'
        ];
    }
}
