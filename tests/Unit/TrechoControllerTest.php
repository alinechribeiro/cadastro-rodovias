<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrechoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_valid_data_to_create_a_trecho()
    {
        $response = $this->post('/trechos', [
            'data_referencia' => '', // data inválida
            'uf_id' => null, // UF não fornecida
            'rodovia_id' => null, // Rodovia não fornecida
            'quilometragem_inicial' => '', // quilometragem inválida
            'quilometragem_final' => '', // quilometragem inválida
            'geo' => '', // GeoJSON inválido
        ]);

        $response->assertSessionHasErrors([
            'data_referencia',
            'uf_id',
            'rodovia_id',
            'quilometragem_inicial',
            'quilometragem_final',
            'geo',
        ]);
    }

    /** @test */
    public function it_creates_a_trecho_with_valid_data()
    {
        $response = $this->post('/trechos', [
            'data_referencia' => '2024-01-01',
            'uf_id' => 1,
            'rodovia_id' => 1,
            'quilometragem_inicial' => 10,
            'quilometragem_final' => 20,
            'geo' => '{"type":"FeatureCollection","features":[]}', // GeoJSON válido
        ]);

        $response->assertStatus(302); // Redirecion
        $this->assertDatabaseHas('trechos', [
            'data_referencia' => '2024-01-01',
        ]);
    }
}
