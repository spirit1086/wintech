<?php

namespace App\Modules\Rate\Services;

use App\Modules\Rate\Dto\RateDto;
use App\Modules\Rate\Interfaces\RateInterface;
use App\Modules\Rate\Interfaces\RateServiceInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class RateService implements RateServiceInterface
{
   private RateInterface $rateRepository;

   public function __construct(RateInterface $rateRepository)
   {
       $this->rateRepository = $rateRepository;
   }

   public function save(RateDto $rateDto): void
   {
       try{
           $this->rateRepository->setData($rateDto);
       }catch ( \Exception $e) {
           throw new HttpResponseException(response()->json([
               'message' => $e->getMessage()
           ], 500));
       }
   }
}
