<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CurrencyService;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculate_total()
    {
        // Mock do serviço de câmbio para retornar um valor fixo
        $this->mock(CurrencyService::class, function ($mock) {
            $mock->shouldReceive('getExchangeRate')
                ->with('USD')
                ->andReturn(5.25);
        });

        // Faz a solicitação para calcular o total
        $response = $this->postJson('/api/calcula-total', [
            'currency' => 'USD',
            'amount' => 100,
        ]);

        // Verifica se a resposta tem o status 200 e a estrutura correta
        $response->assertStatus(200)
            ->assertJsonStructure(['total', 'service_fee', 'rate']);
    }
}
