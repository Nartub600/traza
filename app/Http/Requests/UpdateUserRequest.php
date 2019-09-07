<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name'     => 'required',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore(request()->route()->parameters['usuario'])->whereNull('deleted_at')
            ],
            'username' => 'required',
            'password' => 'nullable|confirmed',
            'active'   => 'required',
            'roles'    => 'array',
            'groups'   => 'array',
        ];
    }
}
