<?php

namespace App\Modules\User\Interfaces;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

interface TokenInterface
{
   public function newTokens(Authenticatable $user): array;

    public function refreshTokens(Request $request): array;
}
