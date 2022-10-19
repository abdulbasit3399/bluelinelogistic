<?php

namespace Modules\Localization\Listeners;

use Modules\Localization\Events\LanguageUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LanguageUpdatedListener
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
     * @param  LanguageUpdatedEvent  $event
     * @return void
     */
    public function handle(LanguageUpdatedEvent $event)
    {
        //
    }
}
