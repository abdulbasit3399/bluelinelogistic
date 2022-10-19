<?php

namespace Modules\Users\Listeners;

use Modules\Users\Events\UserDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserDeletedListener
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
     * @param  UserDeletedEvent  $event
     * @return void
     */
    public function handle(UserDeletedEvent $event)
    {
        
    }
}
