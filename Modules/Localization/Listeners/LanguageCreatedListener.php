<?php

namespace Modules\Localization\Listeners;

use Modules\Localization\Events\LanguageCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LanguageCreatedListener
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
     * @param  LanguageCreatedEvent  $event
     * @return void
     */
    public function handle(LanguageCreatedEvent $event)
    {
        //
    }
}
