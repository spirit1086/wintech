<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Interfaces\UserRepositoryInterface;
use App\Modules\User\Interfaces\UserServiceInterface;
use App\Modules\User\Models\User;

class UserService implements UserServiceInterface
{
   private UserRepositoryInterface $userRepository;

   public function __construct(UserRepositoryInterface $userRepository)
   {
       $this->userRepository = $userRepository;
   }

   public function createNewUser(CreateUserDto $createUserDto): User
   {
      return $this->userRepository->create($createUserDto);
   }
}
