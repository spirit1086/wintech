<?php

namespace App\Modules\User\Interfaces;

use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Models\User;

interface UserRepositoryInterface
{
   public function create(CreateUserDto $createUserDto): User;
}
