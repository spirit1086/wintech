<?php

namespace App\Modules\Wallet\Dto;

class WalletDto
{
    private int $walletID;
    private int $transactionType;
    private float $amount;
    private string $currency;
    private int $reason;
}
