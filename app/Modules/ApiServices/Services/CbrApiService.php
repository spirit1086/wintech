<?php

namespace App\Modules\ApiServices\Services;

use App\Modules\ApiServices\Interfaces\BankRatesServiceInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class CbrApiService implements BankRatesServiceInterface
{
   private string $cbr_root_url;
   public function __construct()
   {
      $this->cbr_root_url = config('app.api.cbr.root_url');
   }

   public function getRates(): array
   {
       try {
           $response = Http::get($this->cbr_root_url . '/latest.js');
           if ($response->ok()) {
               $body = json_decode($response->body(), true);
               return $body['rates'] ?? [];
           } else {
               throw new HttpResponseException(response()->json([
                   'message' => 'Cbr get rates failed'
               ], $response->status()));
           }
       } catch (\Exception $e) {
           throw new HttpResponseException(response()->json([
               'message' => $e->getMessage()
           ], 500));
       }
   }
}
