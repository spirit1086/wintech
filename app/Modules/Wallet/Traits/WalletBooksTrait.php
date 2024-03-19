<?php

namespace App\Modules\Wallet\Traits;

trait WalletBooksTrait
{
    public function transactionTypes(int $key)
    {
        return match ($key) {
            1 => __('Wallet.messages.DEBIT'),
            2 => __('Wallet.messages.CREDIT')
        };
    }

    public function reason(int $reasonKey)
    {
        return match ($reasonKey) {
            1 => __('Wallet.messages.STOCK'),
            2 => __('Wallet.messages.REFUND')
        };
    }
}
