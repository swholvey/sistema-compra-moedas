<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    // Método para calcular o total sem salvar no banco
    public function calculateTotal(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'currency' => 'required|string',
            'amount' => 'required|numeric|min:50', // valor mínimo de compra é 50
        ]);

        // Recupera a taxa de câmbio da moeda solicitada
        $exchangeRate = $this->currencyService->getExchangeRate($request->currency);

        // Calcula o valor total e a taxa de serviço
        $serviceFee = $request->amount * 0.02; // 2% de taxa
        $total = ($request->amount * $exchangeRate) + $serviceFee;

        // Retorna o cálculo sem salvar a transação
        return response()->json([
            'total' => $total,
            'service_fee' => $serviceFee,
            'rate' => $exchangeRate,
        ], 200);
    }

    // Método para confirmar a compra e salvar no banco de dados
    public function confirmPurchase(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'currency' => 'required|string',
            'amount' => 'required|numeric|min:50',
        ]);

        // Recupera a taxa de câmbio e calcula o total
        $exchangeRate = $this->currencyService->getExchangeRate($request->currency);
        $serviceFee = $request->amount * 0.02;
        $total = ($request->amount * $exchangeRate) + $serviceFee;

        // Salva a transação no banco de dados
        $transaction = Transaction::create([
            'currency' => $request->currency,
            'amount' => $request->amount,
            'exchange_rate' => $exchangeRate,
            'service_fee' => $serviceFee,
            'total' => $total,
        ]);

        // Retorna a transação salva para o cliente
        return response()->json([
            'transaction' => $transaction,
        ], 200);
    }

    // Método para listar as moedas disponíveis
    public function listCurrencies()
    {
        return response()->json([
            ['code' => 'USD', 'name' => 'United States Dollar'],
            ['code' => 'EUR', 'name' => 'Euro'],
            ['code' => 'GBP', 'name' => 'British Pound'],
        ]);
    }

    // Método para listar todas as transações
    public function listTransactions()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }
}
