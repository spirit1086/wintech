<?php

namespace App\Modules\User\Interfaces;

use Illuminate\Contracts\Auth\Authenticatable;

interface TokenInterface
{
   public function newTokens(Authenticatable $user): array;
}
