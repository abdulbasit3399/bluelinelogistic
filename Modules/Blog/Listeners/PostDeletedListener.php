<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\PostDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostDeletedListener
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
     * @param  PostDeletedEvent  $event
     * @return void
     */
    public function handle(PostDeletedEvent $event)
    {
        //
    }
}
