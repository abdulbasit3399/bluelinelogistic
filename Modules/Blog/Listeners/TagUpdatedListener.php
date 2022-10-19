<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\TagUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TagUpdatedListener
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
     * @param  TagUpdatedEvent  $event
     * @return void
     */
    public function handle(TagUpdatedEvent $event)
    {
        //
    }
}
