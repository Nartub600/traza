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
            'number' => 'required|max:20',
            'cuit' => [
                'required',
                'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'
            ],
            'autoparts' => 'required|array',
            'autoparts.*.product_id'    => 'required',
            'autoparts.*.name'          => 'required|string|max:255',
            'autoparts.*.description'   => 'required|string|max:255',
            'autoparts.*.ncm_id'        => 'required|string|max:255',
            'autoparts.*.manufacturer'  => 'required|string|max:255',
            'autoparts.*.importer'      => 'required|string|max:255',
            'autoparts.*.business_name' => 'required|string|max:255',
            'autoparts.*.part_number'   => 'required|string|max:255',
            'autoparts.*.brand'         => 'required|string|max:255',
            'autoparts.*.model'         => 'required|string|max:255',
            'autoparts.*.origin'        => 'required|string|max:100',
            'autoparts.*.size'          => 'required|string|max:255',
            'autoparts.*.formulation'   => 'required|string|max:255',
            'autoparts.*.application'   => 'required|string|max:255',
            'autoparts.*.license'       => 'required|string|max:25',
            'autoparts.*.certified_at'  => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'autoparts.required' => 'Debe cargar al menos una autoparte'
        ];
    }
}
