<?php

namespace App\Modules\Wallet\Interfaces;

use App\Modules\Wallet\Models\Wallet;

interface WalletRepositoryInterface
{
   public function createWallet(int $userId): Wallet;
}
