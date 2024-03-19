<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Interfaces\UserRepositoryInterface;
use App\Modules\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
   public function create(CreateUserDto $createUserDto): User
   {
       return User::updateOrCreate(['id' => null], $createUserDto->toArray());
   }
}
