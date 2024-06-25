<?php

namespace App\Providers;

use App\Services\CurrencyExchangeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 使用單例模式注入匯率資料
        $this->app->singleton(CurrencyExchangeService::class, function () {
            $exchangeRates = [
                'TWD' => ['TWD' => 1, 'JPY' => 3.669, 'USD' => 0.03281],
                'JPY' => ['TWD' => 0.26956, 'JPY' => 1, 'USD' => 0.00885],
                'USD' => ['TWD' => 30.444, 'JPY' => 111.801, 'USD' => 1]
            ];

            return new CurrencyExchangeService($exchangeRates);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
