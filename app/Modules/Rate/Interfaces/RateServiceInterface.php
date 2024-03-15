<?php

namespace App\Modules\Rate\Interfaces;

use App\Modules\Rate\Dto\RateDto;

interface RateServiceInterface
{
   public function save(RateDto $rateDto): void;
}
