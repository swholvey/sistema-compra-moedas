<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\CurrencyService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculate_total()
    {
        // Mock do serviço para retornar uma taxa de câmbio fixa
        $this->mock(CurrencyService::class, function ($mock) {
            $mock->shouldReceive('getExchangeRate')
                ->with('USD')
                ->andReturn(5.25);
        });

        $response = $this->postJson('/api/comprar', [
            'currency' => 'USD',
            'amount' => 100,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['total', 'service_fee', 'rate']);
    }
}
