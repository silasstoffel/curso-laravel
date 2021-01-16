<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeriaCriadaEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nome;
    public $quantidadeEpsodios;
    public $quantidadeTemporadas;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($serieNome, $quantidadeTemporadas, $quantidadeEpsodios)
    {
        $this->nome                 = $serieNome;
        $this->quantidadeEpsodios   = $quantidadeEpsodios;
        $this->quantidadeTemporadas = $quantidadeTemporadas;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
