<?php

namespace App\Modules\Wallet\Repositories;

use App\Modules\Wallet\Interfaces\WalletRepositoryInterface;
use App\Modules\Wallet\Models\Wallet;

class WalletRepository implements WalletRepositoryInterface
{
  public function createWallet(int $userId): Wallet
  {
     return Wallet::create(['user_id' => $userId]);
  }
}
