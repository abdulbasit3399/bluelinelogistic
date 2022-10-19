<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\CommentDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentDeletedListener
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
     * @param  CommentDeletedEvent  $event
     * @return void
     */
    public function handle(CommentDeletedEvent $event)
    {
        //
    }
}
