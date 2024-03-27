<?php

namespace App\Modules\User\Dto;

use App\Modules\User\Requests\AuthRequest;

class LoginDto
{
    private string $email;
    private string $password;

    public function __construct(AuthRequest $authRequest)
    {
       $this->email = $authRequest->input('email');
       $this->password = $authRequest->input('password');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function toArray()
    {
        return  get_object_vars($this);
    }
}
