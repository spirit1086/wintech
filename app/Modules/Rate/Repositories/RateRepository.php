<?php
namespace App\Modules\Rate\Repositories;

use App\Modules\Rate\Dto\RateDto;
use App\Modules\Rate\Interfaces\RateInterface;
use App\Modules\Rate\Models\Rate;

class RateRepository implements RateInterface
{
   public function setData(RateDto $rateDto): void
   {
      Rate::upsert($rateDto->getRates(),['code'],['value']);
   }
}
