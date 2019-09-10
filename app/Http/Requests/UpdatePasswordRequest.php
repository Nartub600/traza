<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
            'password' => 'required|confirmed',
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, User::find(request()->route()->parameters['usuario'])->password)) {
                    $fail('El password actual es incorrecto');
                }
            }],
        ];
    }
}
