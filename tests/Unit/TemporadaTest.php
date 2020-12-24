<?php

namespace Tests\Unit;

use App\Models\Episodio;
use App\Models\Temporada;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class TemporadaTest extends TestCase
{

   private Temporada $temporada;

    protected function setUp(): void
    {
        parent::setUp();
        $episodio1            = new Episodio();
        $episodio1->assistido = true;

        $episodio2            = new Episodio();
        $episodio2->assistido = false;

        $episodio3            = new Episodio();
        $episodio3->assistido = true;

        $temporada = new Temporada();
        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBuscarEpisodiosAssistidos(): void
    {
        $assistidos = $this->temporada->getEpisodiosAssistidos();
        $this->assertCount(2, $assistidos);

        foreach ($assistidos as $episodio) {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testBuscarTodosEpisodios(): void
    {
        $this->assertCount(3, $this->temporada->episodios);
    }

}
