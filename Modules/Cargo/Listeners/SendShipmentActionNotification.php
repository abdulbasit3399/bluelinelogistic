<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\ShipmentAction;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Shipment;

class SendShipmentActionNotification
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

    public function handle(ShipmentAction $event)
    {
        $gateways = get_notification_gateways();
        $shipments = Shipment::find($event->shipment_ids ?? []);

        foreach ($shipments as $shipment)
        { 
            
            $action = Shipment::getStatusByStatusId($shipment->status_id);

            $title   = 'There is '.$action.' shipment';
            $content = __('cargo::messages.check_item');
            $url     = route('shipments.show', $shipment->id);

            $users   = get_notification_users('shipment_action',$shipment);
            $users   = \App\Models\User::whereIn('id',$users)->get();
            foreach($users as $user){
                send_notification($user,$gateways,'shipment_action', $title, $content, $url, $shipment);
            }
        }
    }
}
