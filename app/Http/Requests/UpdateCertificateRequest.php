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
            'documents.licencia'        => 'file|mimetypes:application/pdf',
            'autoparts'                 => 'required|array',
            'autoparts.*.product_id'    => 'required',
            'autoparts.*.description'   => 'required|max:255',
            'autoparts.*.ncm_id'        => 'required|max:255',
            'autoparts.*.manufacturer'  => 'required|max:255',
            'autoparts.*.importer'      => 'required|max:255',
            'autoparts.*.business_name' => 'required|max:255',
            'autoparts.*.part_number'   => 'required|max:255',
            'autoparts.*.brand'         => 'required|max:255',
            'autoparts.*.model'         => 'required|max:255',
            'autoparts.*.origin'        => 'required|max:100',
            'autoparts.*.size'          => 'required|max:255',
            'autoparts.*.formulation'   => 'required|max:255',
            'autoparts.*.application'   => 'required|max:255',
            'autoparts.*.license'       => 'required|max:25',
            'autoparts.*.certified_at'  => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'autoparts.required' => 'Debe cargar al menos una autoparte'
        ];
    }
}
