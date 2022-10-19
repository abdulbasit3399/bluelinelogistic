<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\CategoryCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CategoryCreatedListener
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
     * @param  CategoryCreatedEvent  $event
     * @return void
     */
    public function handle(CategoryCreatedEvent $event)
    {
        //
    }
}
