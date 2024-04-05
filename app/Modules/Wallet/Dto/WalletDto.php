<?php

namespace App\Modules\Wallet\Dto;

use App\Modules\Wallet\Requests\CreateWalletValidate;

class WalletDto
{
  private int $user_id;

  public function __construct(CreateWalletValidate $createWalletValidate)
  {
    $this->user_id = $createWalletValidate->input('user_id');
  }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
