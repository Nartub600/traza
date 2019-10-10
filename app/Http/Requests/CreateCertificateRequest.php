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
            // single
            'number' => 'required_without:certificates|max:20',
            'cuit' => [
                'required_without:certificates',
                'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'
            ],
            'autoparts' => 'required_without:certificates|array',
            'autoparts.*.product_id'    => 'required_without:certificates',
            // 'autoparts.*.name'          => 'required_without:certificates|string|max:255',
            'autoparts.*.description'   => 'required_without:certificates|max:255',
            'autoparts.*.ncm_category'  => 'required_without:certificates|max:255',
            'autoparts.*.manufacturer'  => 'required_without:certificates|max:255',
            'autoparts.*.importer'      => 'required_without:certificates|max:255',
            'autoparts.*.business_name' => 'required_without:certificates|max:255',
            'autoparts.*.part_number'   => 'required_without:certificates|max:255',
            'autoparts.*.brand'         => 'required_without:certificates|max:255',
            'autoparts.*.model'         => 'required_without:certificates|max:255',
            'autoparts.*.origin'        => 'required_without:certificates|max:100',
            'autoparts.*.size'          => 'required_without:certificates|max:255',
            'autoparts.*.formulation'   => 'required_without:certificates|max:255',
            'autoparts.*.application'   => 'required_without:certificates|max:255',
            'autoparts.*.license'       => 'required_without:certificates|max:25',
            'autoparts.*.certified_at'  => 'required_without:certificates|max:255',

            // bulk
            'certificates.*.number' => 'required_without:number|max:20',
            'certificates.*.cuit' => [
                'required_without:cuit',
                'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'
            ],
            'certificates.*.autoparts' => 'required_without:autoparts|array',
            'certificates.*.autoparts.*.product_id'    => 'required_with:certificates',
            // 'certificates.*.autoparts.*.name'          => 'required_with:certificates|string|max:255',
            'certificates.*.autoparts.*.description'   => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.ncm_category'  => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.manufacturer'  => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.importer'      => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.business_name' => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.part_number'   => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.brand'         => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.model'         => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.origin'        => 'required_with:certificates|max:100',
            'certificates.*.autoparts.*.size'          => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.formulation'   => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.application'   => 'required_with:certificates|max:255',
            'certificates.*.autoparts.*.license'       => 'required_with:certificates|max:25',
            'certificates.*.autoparts.*.certified_at'  => 'required_with:certificates|max:255',
        ];
    }

    public function messages()
    {
        return [
            'autoparts.required_without' => 'Debe cargar al menos una autoparte'
        ];
    }
}
