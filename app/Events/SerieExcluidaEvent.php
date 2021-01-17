<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Serie;

/*
| Passo a passo para criar um Event
|
| 1. Cria o evento:  php artisan make:event SerieExcluidaEvent
| 2. No fonte emitir o evento, por exemplo: event( new SerieExcluidaEvent(args..) )
| 3. Criar um listener (ouvinte) que fica monitorando o evento:
|    php artisan make:listener -e SerieExcluidaEvent ExcluirFotoCapaSerieListener
| 4. Ir no app/providers/EventServiceProvider.php é configurar qual clasee é
|    evento e quais classe(s) são os ouvintes.
*/

class SerieExcluidaEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * serie
     *
     * @var object
     */
    public $serie;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(object $serie)
    {
        $this->serie = $serie;
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
