<?php

namespace App\Modules\Wallet\Repositories;

use App\Modules\User\Traits\Token;
use App\Modules\Wallet\Interfaces\WalletRepositoryInterface;
use App\Modules\Wallet\Interfaces\WalletServiceInterface;
use App\Modules\Wallet\Models\Wallet;
use Illuminate\Http\Request;

class WalletService implements WalletServiceInterface
{
   use Token;
   private WalletRepositoryInterface $walletRepository;
   public function __construct(WalletRepositoryInterface $walletRepository)
   {
      $this->walletRepository = $walletRepository;
   }

   public function newWallet(Request $request): Wallet
   {
       $user = self::getUserFromToken($request);
       return $this->walletRepository->createWallet($user->id);
   }
}
