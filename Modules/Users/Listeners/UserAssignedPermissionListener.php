<?php

namespace Modules\Users\Listeners;

use Modules\Users\Events\UserAssignedPermissionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAssignedPermissionListener
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
     * @param  UserAssignedPermissionEvent  $event
     * @return void
     */
    public function handle(UserAssignedPermissionEvent $event)
    {
        
    }
}
