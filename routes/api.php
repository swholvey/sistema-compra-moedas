<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

// Rota para listar as moedas disponíveis
Route::get('/moedas', [TransactionController::class, 'listCurrencies']);

// Rota para calcular o total da compra (sem salvar no banco)
Route::post('/calcula-total', [TransactionController::class, 'calculateTotal']);

// Rota para confirmar a compra e salvar no banco
Route::post('/comprar', [TransactionController::class, 'confirmPurchase']);

// Rota para listar o histórico de transações
Route::get('/transacoes', [TransactionController::class, 'listTransactions']);
