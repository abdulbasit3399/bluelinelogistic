<?php

namespace Modules\Pages\Listeners;

use Modules\Pages\Events\PageUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PageUpdatedListener
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
     * @param  PageUpdatedEvent  $event
     * @return void
     */
    public function handle(PageUpdatedEvent $event)
    {
        //
    }
}
