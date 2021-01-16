<?php

namespace App\Listeners;

use App\Events\SerieCriadaEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GravarLogSerieCriadaListener implements ShouldQueue
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
     * @param  SerieCriadaEvent  $event
     * @return void
     */
    public function handle(\App\Events\SeriaCriadaEvent $event)
    {
        Log::info(
            sprintf("Serie Criada: %s" , $event->nome)
        );
    }
}
