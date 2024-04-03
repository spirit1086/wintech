<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\LoginDto;
use App\Modules\User\Enums\TokenEnum;
use App\Modules\User\Interfaces\AuthUserServiceInterface;
use App\Modules\User\Interfaces\TokenInterface;
use App\Modules\User\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class AuthUserService implements AuthUserServiceInterface, TokenInterface
{
   public function login(LoginDto $loginDto): Authenticatable|bool
   {
       if (Auth::attempt($loginDto->toArray())) {
           return Auth::user();
       }
       throw new HttpResponseException(response()->json(['message' => 'Auth failed']));
   }

   public function refreshTokens(Request $request): array
   {
       try {
           DB::beginTransaction();
           $token = PersonalAccessToken::findToken($request->bearerToken());
           $user = $token->tokenable;
           $user->tokens()->delete();
           $newTokens = $this->newTokens($user);
           DB::commit();
           return $newTokens;
       } catch (\Exception $e) {
           DB::rollBack();
           throw new HttpResponseException(response()->json(['message' => $e->getMessage()]));
       }
   }

    public function newTokens(Authenticatable $user): array
   {
       try {
           DB::beginTransaction();
               $accessToken = $user->createToken('access-token',
                                                       [TokenEnum::ACCESS_TOKEN->value],
                                                       Carbon::now()->addMinutes(config('sanctum.access_expiration')));
               $refreshToken = $user->createToken('refresh-token',
                                                       [TokenEnum::REFRESH_TOKEN->value],
                                                       Carbon::now()->addMinutes(config('sanctum.refresh_expiration')));
           DB::commit();
               return [
                   'access_token' => $accessToken->plainTextToken,
                   'refresh_token' => $refreshToken->plainTextToken,
               ];
       } catch (\Exception $e) {
           DB::rollBack();
           throw new HttpResponseException(response()->json(['message' => $e->getMessage()]));
       }
   }
}
