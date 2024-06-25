<?php

namespace App\Http\Controllers;

use App\Services\CurrencyExchangeService;
use GuzzleHttp\Psr7\Request;

class CurrencyExchangeController extends Controller
{

    public function __construct
    (
        protected CurrencyExchangeService $currencyExchangeService
    )
    {
    }

    public function convert(Request $request)
    {
    }
}
