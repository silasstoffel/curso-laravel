<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemovedorDeSerieTest extends TestCase
{

    use RefreshDatabase;

    /**
     * serie
     *
     * @var Serie
     */
    private $serie;

    protected function setUp(): void
    {
        parent::setUp();
        $criador     = new CriadorDeSerie();
        $this->serie = $criador->criar("Serie.Para.Excluir", 2, 12);
    }

    public function testRemoverUmaSerie()
    {
        // Verifica se a serie está no banco de dados
        $this->assertDatabaseHas('serie', ['id' => $this->serie->id]);

        $removedor = new RemovedorDeSerie();
        $removida      = $removedor->remover($this->serie->id);
        $this->assertNotNull($removida);
        $this->assertEquals('Serie.Para.Excluir', $this->serie->nome);
        // Garantir que registro não existe no banco de dados
        $this->assertDatabaseMissing('serie', ['id' => $this->serie->id]);
    }
}
