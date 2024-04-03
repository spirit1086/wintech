<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Dto\LoginDto;
use App\Modules\User\Interfaces\UserServiceInterface;
use App\Modules\User\Requests\AuthRequest;
use App\Modules\User\Requests\RegistrationRequest;
use App\Modules\User\Resources\AuthResource;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Services\AuthUserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private UserServiceInterface $userService;
    private AuthUserService $authUserService;

    public function __construct(UserServiceInterface $userService, AuthUserService $authUserService)
    {
        $this->userService = $userService;
        $this->authUserService = $authUserService;
    }

    public function registration(RegistrationRequest $registrationRequest): UserResource
    {
        $createUserDto = new CreateUserDto($registrationRequest);
        $user = $this->userService->createNewUser($createUserDto);
        return new UserResource($user);
    }

    public function authentification(AuthRequest $authRequest): AuthResource
    {
        $loginDto = new LoginDto($authRequest);
        $user = $this->authUserService->login($loginDto);
        $tokens = $this->authUserService->newTokens($user);
        return new AuthResource($tokens);
    }

    public function refreshToken(Request $request): AuthResource
    {
        $newTokens = $this->authUserService->refreshTokens($request);
        return new AuthResource($newTokens);
    }
}
