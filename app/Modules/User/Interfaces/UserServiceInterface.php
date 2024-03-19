<?php

namespace App\Modules\User\Interfaces;

use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Models\User;

interface UserServiceInterface
{
   public function createNewUser(CreateUserDto $createUserDto): User;
}
