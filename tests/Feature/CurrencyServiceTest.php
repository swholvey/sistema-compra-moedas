<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Http;

class CurrencyServiceTest extends TestCase
{
    public function test_get_exchange_rate()
    {
        Http::fake([
            'https://economia.awesomeapi.com.br/*' => Http::response([
                'BRLUSD' => ['bid' => '5.25']
            ], 200),
        ]);

        $service = new CurrencyService();
        $rate = $service->getExchangeRate('USD');

        $this->assertEquals(5.25, $rate);
    }
}
