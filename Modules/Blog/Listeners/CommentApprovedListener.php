<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\CommentApprovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentApprovedListener
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
     * @param  CommentApprovedEvent  $event
     * @return void
     */
    public function handle(CommentApprovedEvent $event)
    {
        //
    }
}
