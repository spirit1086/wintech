<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Dto\LoginDto;
use App\Modules\User\Interfaces\UserServiceInterface;
use App\Modules\User\Requests\AuthRequest;
use App\Modules\User\Requests\RegistrationRequest;
use App\Modules\User\Resources\UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function registration(RegistrationRequest $registrationRequest): UserResource
    {
        try {
            DB::beginTransaction();
            $createUserDto = new CreateUserDto($registrationRequest);
            $user = $this->userService->createNewUser($createUserDto);
            DB::commit();
            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(response()->json(['message' => $e->getMessage()]));
        }
    }

    public function authentification(AuthRequest $authRequest)
    {
        try {
            DB::beginTransaction();
            $loginDto = new LoginDto($authRequest);

            DB::commit();
        }  catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(response()->json(['message' => $e->getMessage()]));
        }
    }
}
