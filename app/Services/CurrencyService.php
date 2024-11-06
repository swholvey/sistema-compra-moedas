<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CurrencyService
{
    protected $apiUrl = 'https://economia.awesomeapi.com.br/json/last/';

    public function getExchangeRate($currency)
    {
        return Cache::remember("exchange_rate_{$currency}", 3600, function () use ($currency) {
            $response = Http::get($this->apiUrl . 'BRL-' . $currency);

            if ($response->successful()) {
                $data = $response->json();
                return $data['BRL' . $currency]['bid'] ?? null;
            }

            return null;
        });
    }
}
