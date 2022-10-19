<?php

namespace Modules\Pages\Listeners;

use Modules\Pages\Events\PageCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PageCreatedListener
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
     * @param  PageCreatedEvent  $event
     * @return void
     */
    public function handle(PageCreatedEvent $event)
    {
        //
    }
}
