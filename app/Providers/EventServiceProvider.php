<?php

namespace App\Providers;

use App\Events\SeriaCriadaEvent;
use App\Events\SerieExcluidaEvent;
use App\Listeners\EnviarEmailCadastrarSerieListener;
use App\Listeners\GravarLogSerieCriadaListener;
use App\Listeners\ExcluirFotoCapaSerieListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class       => [
            SendEmailVerificationNotification::class,
        ],
        SeriaCriadaEvent::class => [
            EnviarEmailCadastrarSerieListener::class,
            GravarLogSerieCriadaListener::class,
        ],
        SerieExcluidaEvent::class => [
            ExcluirFotoCapaSerieListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
