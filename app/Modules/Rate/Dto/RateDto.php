<?php

namespace App\Modules\Rate\Dto;

class RateDto
{
    private array $response;
    private array $rates;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function getRates(): array
    {
        foreach ($this->response as $key => $value) {
            $this->rates[] = ['code' => $key, 'value' => $value];
        }
        return $this->rates;
    }
}
