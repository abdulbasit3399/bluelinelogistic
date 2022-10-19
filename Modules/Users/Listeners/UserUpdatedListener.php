<?php

namespace Modules\Users\Listeners;

use Modules\Users\Events\UserUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;

class UserUpdatedListener
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
     * @param  UserUpdatedEvent  $event
     * @return void
     */
    public function handle(UserUpdatedEvent $event)
    {
        //
    }
}
