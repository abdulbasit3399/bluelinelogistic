<?php

namespace Modules\Acl\Listeners;

use Modules\Acl\Events\RoleUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RoleUpdatedListener
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
     * @param  RoleUpdatedEvent  $event
     * @return void
     */
    public function handle(RoleUpdatedEvent $event)
    {
        
    }
}
