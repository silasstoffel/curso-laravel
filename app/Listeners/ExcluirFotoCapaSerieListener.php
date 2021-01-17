<?php

namespace App\Listeners;

use App\Events\SerieExcluidaEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// php artisan make:listener -e SerieExcluidaEvent ExcluirFotoCapaSerieListener

class ExcluirFotoCapaSerieListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SerieExcluidaEvent  $event
     * @return void
     */
    public function handle(SerieExcluidaEvent $event)
    {
        $serie = $event->serie;
        if ($serie->foto_capa) {
            Storage::disk('public')->delete($serie->foto_capa);
        }
    }
}
