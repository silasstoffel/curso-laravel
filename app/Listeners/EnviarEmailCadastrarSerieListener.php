<?php

namespace App\Listeners;

use App\Events\SerieCriadaEvent;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EnviarEmailCadastrarSerieListener
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
        $usuarios = User::all();
        foreach ($usuarios as $k => $usuario) {
            $email = new \App\Mail\SerieCriada(
                $event->nome,
                $event->quantidadeTemporadas,
                $event->quantidadeEpsodios
            );

            // A cada X segundos enviar um e-mail
            $aCadaSegundo = 9;
            $horario      = now()->addSeconds(
                $aCadaSegundo * ($k + 1)
            );
            Mail::to($usuario)->later(
                $horario,
                $email
            );
        }
    }
}
