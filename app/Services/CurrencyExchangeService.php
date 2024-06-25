<?php

namespace App\Services;

use Exception;

class CurrencyExchangeService
{
    protected array $exchangeRates;

    public function __construct(array $exchangeRates)
    {
        $this->exchangeRates = $exchangeRates;
    }

    public function convert(string $source, string $target, string $amount): ?string
    {
        $amount = str_replace(',', '', $amount);

        if (!isset($this->exchangeRates[$source][$target])) {
            throw new Exception("目前尚未支援的匯率轉換格式：從 {$source} 到 {$target}。");
        }

        $converted = $amount * $this->exchangeRates[$source][$target];
        //四捨五入到小數點第二位
        $rounded = round($converted, 2);
        //加上半形逗點作為千分位表示，每三個位數一點
        return number_format($rounded, 2);
    }
}
