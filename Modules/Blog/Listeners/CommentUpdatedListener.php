<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\CommentUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentUpdatedListener
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
     * @param  CommentUpdatedEvent  $event
     * @return void
     */
    public function handle(CommentUpdatedEvent $event)
    {
        //
    }
}
