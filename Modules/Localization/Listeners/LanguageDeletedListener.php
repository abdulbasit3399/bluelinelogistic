<?php

namespace Modules\Localization\Listeners;

use Modules\Localization\Events\LanguageDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LanguageDeletedListener
{
    /**
     * Delete the event listener.
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
     * @param  LanguageDeletedEvent  $event
     * @return void
     */
    public function handle(LanguageDeletedEvent $event)
    {
        //
    }
}
