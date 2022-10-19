<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\CategoryUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CategoryUpdatedListener
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
     * @param  CategoryUpdatedEvent  $event
     * @return void
     */
    public function handle(CategoryUpdatedEvent $event)
    {
        //
    }
}
