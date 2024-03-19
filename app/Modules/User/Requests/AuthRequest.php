<?php

namespace App\Modules\User\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('User::validation.required'),
            'password.required' => __('User::validation.required'),
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('User::message.email'),
            'password' => __('User::message.password'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message'   => $validator->errors()],422));
    }
}
