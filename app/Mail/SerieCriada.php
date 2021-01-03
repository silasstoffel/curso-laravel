<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SerieCriada extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $quantidadeTemporadas;
    public $quantidadeEpisodios;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $quantidadeTemporadas, $quantidadeEpisodios)
    {
        $this->nome                 = $nome;
        $this->quantidadeTemporadas = $quantidadeTemporadas;
        $this->quantidadeEpisodios  = $quantidadeEpisodios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.criada');
    }
}
