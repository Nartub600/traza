<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

            'documents.declaracion_jurada' => 'required_if:type,chas',
            'documents.autopartesNacional' => Rule::requiredIf(function () {
                return request('type') === 'chas' && !isset(request('documents')['autopartesExtranjera']);
            }),
            'documents.autopartesExtranjera' => Rule::requiredIf(function () {
                return request('type') === 'chas' && !isset(request('documents')['autopartesNacional']);
            }),
            'documents.wp29' => 'required_with:documents.autopartesExtranjera',
            'documents.certificado' => 'required_if:type,chas',
            'documents.catalogo' => 'required_if:type,chas',

            'documents.solicitud_cape' => 'required_if:type,cape',
            'documents.lcms' => 'required_if:type,cape',

            'documents.excepcion_chas' => 'required_if:type,excepcion-chas',
            'documents.autopartesExcepcion' => 'required_if:type,excepcion-chas',

            'documents.foto' => 'required',
        ];
    }
}
