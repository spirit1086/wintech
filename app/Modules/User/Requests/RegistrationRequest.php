<?php

namespace App\Modules\User\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('User::validation.required'),
            'email.required' => __('User::validation.required'),
            'email.unique' => __('User::validation.unique'),
            'password.required' => __('User::validation.required'),
            'password.min' => __('User::validation.min'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('User::message.name'),
            'email' => __('User::message.email'),
            'password' => __('User::message.password'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message'   => $validator->errors()],400));
    }
}
