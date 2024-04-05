<?php

namespace App\Modules\Wallet\Requests;

use App\Modules\User\Traits\Token;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateWalletValidate extends FormRequest
{
    use Token;

    protected function prepareForValidation()
    {
        $user = self::getUserFromToken(request());
        $this->merge([
            'user_id' => $user->id
        ]);
    }
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|unique:user_wallet'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => __('Wallet::validation.required'),
            'user_id.unique' => __('Wallet::validation.unique')
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => __('Wallet::messages.user_id')
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message'   => $validator->errors()],400));
    }
}
