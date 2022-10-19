<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\AddShipment;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Shipment;
use Session;

class SendAddShipmenttNotification
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
    public function handle(AddShipment $event)
    {

        $shipment = $event->shipment;
        $shipment = Shipment::find($shipment->id ?? []);

        $users    = get_notification_users('new_shipments',$shipment);
        $gateways = get_notification_gateways();

        $title   = __('cargo::view.There_is_a_new_shipment_created');
        $content = __('cargo::messages.check_item');
        $url     = route('shipments.show', $shipment->id);

        $users   = \App\Models\User::whereIn('id',$users)->get();
        foreach($users as $user){
            send_notification($user,$gateways,'new_shipment', $title, $content, $url, $shipment);
        }   

        // Send public linke for paying
        $title      = __('cargo::view.payment_link');
        $content    = __('cargo::messages.paying_item');
        $url        = route('admin.shipments.pay', $shipment->id);

        $recevier   = \App\Models\User::find($shipment->client->user_id);
        if($recevier){
            send_notification($recevier,$gateways,'new_shipment', $title, $content, $url, $shipment);
        }
    }
}
