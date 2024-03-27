<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Interfaces\UserRepositoryInterface;
use App\Modules\User\Interfaces\UserServiceInterface;
use App\Modules\User\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
   private UserRepositoryInterface $userRepository;

   public function __construct(UserRepositoryInterface $userRepository)
   {
       $this->userRepository = $userRepository;
   }

   public function createNewUser(CreateUserDto $createUserDto): User
   {
       try {
           DB::beginTransaction();
            $user = $this->userRepository->create($createUserDto);
           DB::commit();
           return $user;
       }  catch (\Exception $e) {
           DB::rollBack();
           throw new HttpResponseException(response()->json(['message' => $e->getMessage()]));
       }
   }
}
