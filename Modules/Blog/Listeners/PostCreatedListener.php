<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\PostCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostCreatedListener
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
     * @param  PostCreatedEvent  $event
     * @return void
     */
    public function handle(PostCreatedEvent $event)
    {
        //
    }
}
