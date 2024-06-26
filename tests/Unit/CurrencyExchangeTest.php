<?php

namespace Tests\Unit;

use App\Services\CurrencyExchangeService;
use Tests\TestCase;
use Exception;

class CurrencyExchangeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->service = $this->app->make(CurrencyExchangeService::class);
    }

    public static function amount_data(): array
    {
        $amount = rand(1, 10000);
        return [
            [$amount], //integer
            [$amount / 100] // float
        ];
    }

    /**
     * @dataProvider amount_data
     */
    public function test_happy_path_convert_amount($amount)
    {
        $result = $this->service->convert('USD', 'TWD', (string)$amount);
        $this->assertMatchesRegularExpression('/^\d{1,3}(,\d{3})*(\.\d{2})?$/', $result);
    }

    public static function invalid_data(): array
    {
        return [
            ['sourceInvalid', 'TWD', '100', '目前尚未支援的匯率轉換格式：從 sourceInvalid 到 TWD。'],
            ['TWD', 'targetInvalid', '100', '目前尚未支援的匯率轉換格式：從 TWD 到 targetInvalid。'],
            ['TWD', 'JPY', 'amountInvalid', '金額格式錯誤：amountInvalid，金額必須是有效的數字。'],
        ];
    }

    /**
     * @dataProvider invalid_data
     */
    public function test_sad_path_convert_parameter_invalid($source, $target, $amount, $errorMessage)
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage($errorMessage);
        $this->service->convert($source, $target, $amount);
    }
}
