<?php

namespace Modules\Pages\Listeners;

use Modules\Pages\Events\PageDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PageDeletedListener
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
     * @param  PageDeletedEvent  $event
     * @return void
     */
    public function handle(PageDeletedEvent $event)
    {
        //
    }
}
