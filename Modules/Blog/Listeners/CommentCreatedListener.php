<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\CommentCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentCreatedListener
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
     * @param  CommentCreatedEvent  $event
     * @return void
     */
    public function handle(CommentCreatedEvent $event)
    {
        //
    }
}
