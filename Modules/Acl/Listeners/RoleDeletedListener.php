<?php

namespace Modules\Acl\Listeners;

use Modules\Acl\Events\RoleDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RoleDeletedListener
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
     * @param  RoleDeletedEvent  $event
     * @return void
     */
    public function handle(RoleDeletedEvent $event)
    {
        
    }
}
