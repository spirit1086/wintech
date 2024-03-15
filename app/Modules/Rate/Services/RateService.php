<?php

namespace App\Modules\Rate\Services;

use App\Modules\Rate\Dto\RateDto;
use App\Modules\Rate\Interfaces\RateInterface;
use App\Modules\Rate\Interfaces\RateServiceInterface;

class RateService implements RateServiceInterface
{
   private RateInterface $rateRepository;

   public function __construct(RateInterface $rateRepository)
   {
       $this->rateRepository = $rateRepository;
   }

   public function save(RateDto $rateDto): void
   {
       $this->rateRepository->setData($rateDto);
   }
}
