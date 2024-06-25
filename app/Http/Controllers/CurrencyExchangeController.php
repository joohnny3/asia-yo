<?php

namespace App\Http\Controllers;

use App\Services\CurrencyExchangeService;
use Illuminate\Http\Request;

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
        $data = $request->validate([
            'amount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/',
            'source' => 'required|string',
            'target' => 'required|string',
        ]);
        $result = $this->currencyExchangeService->convert($data['source'], $data['target'], $data['amount']);

        dd($result);
    }
}
