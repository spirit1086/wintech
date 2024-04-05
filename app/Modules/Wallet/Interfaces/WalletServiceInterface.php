<?php

namespace App\Modules\Wallet\Interfaces;

use App\Modules\Wallet\Models\Wallet;
use Illuminate\Http\Request;

interface WalletServiceInterface
{
  public function newWallet(Request $request): Wallet;
}
