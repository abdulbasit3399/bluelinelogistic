<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\PostUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostUpdatedListener
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
     * @param  PostUpdatedEvent  $event
     * @return void
     */
    public function handle(PostUpdatedEvent $event)
    {
        //
    }
}
