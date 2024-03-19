<?php

namespace App\Modules\User\Dto;

use App\Modules\User\Requests\RegistrationRequest;

class CreateUserDto
{
   private string $name;
   private string $email;
   private string $password;

   public function __construct(RegistrationRequest $registrationRequest)
   {
      $this->name = $registrationRequest->input('name');
      $this->email = $registrationRequest->input('email');
      $this->password = $registrationRequest->input('password');
   }

   public function toArray(): array
   {
      return get_object_vars($this);
   }
}
