<?php

namespace App\Services;

class CurrencyExchangeService
{
    protected array $exchangeRates;

    public function __construct(array $exchangeRates)
    {
        $this->exchangeRates = $exchangeRates;
    }

}
