<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CriadorSerieTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCriarSerie()
    {
        $servico = new CriadorDeSerie();
        $nome = 'Serie_Unit_Test';
        $criada = $servico->criar($nome, 10, 20);

        $this->assertInstanceOf(Serie::class, $criada);
        $this->assertDatabaseHas('serie', ['nome' => $nome]);
        $this->assertDatabaseHas('temporada', ['serie_id' => $criada->id]);
        $this->assertDatabaseHas('episodio', ['numero' => 1]);
    }
}
