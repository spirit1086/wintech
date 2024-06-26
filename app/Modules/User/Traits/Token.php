<?php

namespace App\Modules\User\Traits;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

trait Token
{
   public static function getUserFromToken(Request $request)
   {
       $token = PersonalAccessToken::findToken($request->bearerToken());
       return $token->tokenable;
   }
}
