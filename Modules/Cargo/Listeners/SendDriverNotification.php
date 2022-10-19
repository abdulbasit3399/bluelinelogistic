<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\AddDriver;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Driver;

class SendDriverNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(AddDriver $event)
    {
        $users    = get_notification_users('new_driver');
        $gateways = get_notification_gateways();

        $captain = $event->captain;
        $captain = Driver::find($captain->id ?? []);

        $title   = __('cargo::view.There_is_a_new_driver_created');
        $content = __('cargo::messages.check_item');
        $url     = route('drivers.show', $captain->id);

        $users  =   \App\Models\User::whereIn('id',$users)->get();
        foreach($users as $user){
            send_notification($user,$gateways,'new_driver', $title, $content, $url,$captain);
        }
    }

    
}
