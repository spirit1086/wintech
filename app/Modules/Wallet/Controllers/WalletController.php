<?php

namespace App\Modules\Wallet\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Wallet\Interfaces\WalletServiceInterface;
use App\Modules\Wallet\Requests\CreateWalletValidate;
use App\Modules\Wallet\Resources\WalletResource;

class WalletController extends Controller
{
    private WalletServiceInterface $walletService;

    public function __construct(WalletServiceInterface $walletService)
    {
        $this->walletService = $walletService;
    }

    public function addUserWallet(CreateWalletValidate $request)
    {
        $wallet = $this->walletService->newWallet($request);
        return new WalletResource($wallet);
    }
}
