<?php

namespace App\Modules\User\Interfaces;

use App\Modules\User\Dto\LoginDto;
use Illuminate\Contracts\Auth\Authenticatable;

interface AuthUserServiceInterface
{
   public function login(LoginDto $loginDto): Authenticatable|bool;
}
