<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\CategoryDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CategoryDeletedListener
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
     * @param  CategoryDeletedEvent  $event
     * @return void
     */
    public function handle(CategoryDeletedEvent $event)
    {
        //
    }
}
