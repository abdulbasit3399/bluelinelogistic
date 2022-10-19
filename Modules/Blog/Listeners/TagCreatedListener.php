<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\TagCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TagCreatedListener
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
     * @param  TagCreatedEvent  $event
     * @return void
     */
    public function handle(TagCreatedEvent $event)
    {
        //
    }
}
