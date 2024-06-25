<?php

namespace App\Http\Controllers;

use App\Services\CurrencyExchangeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use \Illuminate\Http\JsonResponse;

class CurrencyExchangeController extends Controller
{

    public function __construct
    (
        protected CurrencyExchangeService $currencyExchangeService
    )
    {
    }

    public function convert(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'amount' => 'required|regex:/^\d+(,\d{3})*(\.\d+)?$/',
                'source' => 'required|string',
                'target' => 'required|string',
            ]);

            $result = $this->currencyExchangeService->convert($data['source'], $data['target'], $data['amount']);

            return response()->json([
                'msg' => 'success',
                'amount' => $result
            ]);
        } catch (Throwable $throwable) {
            Log::error('Error:' . $throwable->getMessage() . ' at line:' . $throwable->getLine());
            return response()->json([
                'msg' => 'fail',
                'error' => $throwable->getMessage()
            ], 400);
        }
    }
}
