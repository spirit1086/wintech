<?php
namespace App\Modules\Rate\Interfaces;
use App\Modules\Rate\Dto\RateDto;

interface RateInterface
{
  public function setData(RateDto $rateDto): void;
}
