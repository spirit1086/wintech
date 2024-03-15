<?php

namespace App\Console\Commands;

use App\Modules\ApiServices\Interfaces\BankRatesServiceInterface;
use App\Modules\Rate\Dto\RateDto;
use App\Modules\Rate\Interfaces\RateServiceInterface;
use Illuminate\Console\Command;

class CbrRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get rates from cbr';

    private BankRatesServiceInterface $bankRatesService;
    private RateServiceInterface $rateServiceInterface;

    public function __construct(BankRatesServiceInterface $bankRatesService, RateServiceInterface $rateServiceInterface)
    {
       parent::__construct();
       $this->bankRatesService = $bankRatesService;
       $this->rateServiceInterface = $rateServiceInterface;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rates = $this->bankRatesService->getRates();
        $this->rateServiceInterface->save(new RateDto($rates));
    }
}
