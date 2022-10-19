<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\UpdateShipment;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Shipment;

class SendUpdateShipmentNotification
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

    public function handle(UpdateShipment $event)
    {
        $shipment = $event->shipment;
        $shipment = Shipment::find($shipment->id ?? []);

        $users    = get_notification_users('update_shipments',$shipment);
        $gateways = get_notification_gateways();

        $title   = __('cargo::view.There_is_an_updated_shipment');
        $content = __('cargo::messages.check_item');
        $url     = route('shipments.show', $shipment->id);

        $users   = \App\Models\User::whereIn('id',$users)->get();
        foreach ($users as $user)
        { 
            send_notification($user,$gateways,'update_shipment', $title, $content, $url, $shipment);
        }
    }
}
